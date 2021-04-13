<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Cart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Mail;
use App\Mail\Order\NewOrder;

class PaymentController extends Controller 
{
    private $base_url;
    private $request_client;
    private $token;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('MYFATOORAHBASEURL');
        $this->token = env('MYFATOORAHTOKEN');
    }

    public function processPayment(Request $request)
    {

        try {
            $error = '';

            //best practice as we do sperate validation on request form file
            $validator = Validator::make($request->all(), [
                'ccNum' => 'required', // cridt card number
                'ccExp' => 'required', // Expiration date
                'ccCvv' => 'required|numeric', // Security code
                'PaymentMethodId' => 'required',
                'products.*.product_id' =>'required|exists:products,id',
                'products.*.vendor_id' =>'required|exists:vendors,id',
                'products.*.quantity' =>'required',
                'address' => 'required'
            ]);

            if ($validator->fails()) {
                return responseJson(0, 'Error', $validator->errors()->first());
            }

            foreach($request->products as $p){
                $ids[] = $p['vendor_id'];
            }
            // dd($ids);
            $vendor_ids = array_unique($ids);            
            
            foreach($vendor_ids as $vendor_id){

                $vendor = Vendor::find($vendor_id);
                $cost = [];
                
                foreach($request->products as $p){
                        
                    $product = $vendor->productHas($p['product_id']);
                    // dd($product);
                    if(is_null($product)){
                        continue;
                    }
                    // dd($product->id);
                    if( $product->in_stock < $p['quantity'] ){
                        return responseJson(0, 'This Product Not Avilable Now');
                    }
                    
                    if($vendor->state == 'close' && $vendor->is_activate == 0){
                        return responseJson(0, 'This Seller Not Avilable Now , Please Try Agane At a Later Time');
                    }
                    // get product cost
                    $price = $product->special_price == null ? $product->price : $product->special_price;
                    $cost [] = ($price * $p['quantity']);
                }
                $subTotel = array_sum($cost);
                $amount = $subTotel + $vendor->delivery_cost;
                // dd($amount);
                if($amount < $vendor->minimum_order){
                    return responseJson(0, 'The Request Cant Be Less Than ' . $vendor->minimum_order . ' Pound');
                }

                $ccNum = str_replace(' ', '', $request->ccNum);
                $ccExp = $request->ccExp;
                $ccCvv = $request->ccCvv;
                $amount = $amount;
                $customerName = auth()->guard('user-api')->user()->name;
                $customerEmail = 'demo@gmail.com';
                $phone = substr(auth()->guard('user-api')->user()->phone, 4);
                $ccExp = (explode('/', $ccExp));
                $ccMon = $ccExp[0];
                $ccYear = $ccExp[1];
                $customerMobile = strlen($phone) <= 11 ? $phone : '123456';
                $data['Language'] = 'en';
                $PaymentMethodId = $request->PaymentMethodId;
                $token = $this->token;
                $basURL = $this->base_url;
                $curl = curl_init();

                // you can use laravel http or Guzzl and you my create an object to encode that oject direct on requrest
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$basURL/v2/ExecutePayment",
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"PaymentMethodId\":\"$PaymentMethodId\",
                        \"CustomerName\": \"$customerName\",
                        \"DisplayCurrencyIso\": \"SAR\",
                        \"MobileCountryCode\":\"+965\",
                        \"CustomerMobile\": \"$customerMobile\",
                        \"CustomerEmail\": \"$customerEmail\",
                        \"InvoiceValue\": $amount,
                        \"CallBackUrl\": \"https://dieera.com\",
                        \"ErrorUrl\": \"https://dieera.com\",
                        \"Language\": \"en\",
                        \"CustomerReference\" :\"ref 1\",
                        \"CustomerCivilId\":12345678,
                        \"UserDefinedField\": \"Custom field\",
                        \"ExpireDate\": \"\",
                        \"CustomerAddress\" :{\"Block\":\"\",
                        \"Street\":\"\",
                        \"HouseBuildingNo\":\"\",
                        \"Address\":\"\",
                        \"AddressInstructions\":\"\"},
                    \"InvoiceItems\": []}",
                    CURLOPT_HTTPHEADER => array("Authorization: Bearer $token", "Content-Type: application/json"),
                ));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    return [
                        'payment_success' => false,
                        'status' => 'faild',
                        'error' => $err
                    ];
                }
                // dd($response);
                $json = json_decode((string)$response, true);
                //echo "json  json: $json '<br />'";

                // dd($json["Data"]);
                $payment_url = $json["Data"]["PaymentURL"];

                $card = new \stdClass();
                $card->Number = $ccNum;
                $card->expiryMonth = trim($ccMon);
                $card->expiryYear = trim($ccYear);
                $card->securityCode = trim($ccCvv);
                $card_data = json_encode($card);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$payment_url",
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"paymentType\": \"card\",\"card\":$card_data,\"saveToken\": false}",
                    CURLOPT_HTTPHEADER => array("Authorization: Bearer $token", "Content-Type: application/json"),
                ));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return [
                        'paymemt_success' => false,
                        'status' => 'faild',
                        'error' => $err
                    ];
                }

                $json = json_decode((string)$response, true);
                //echo "json  json: $json '<br />'";

                $PaymentId = $json["Data"]["PaymentId"];
                // dd($PaymentId); 
                
                DB::beginTransaction();
                // if success payment save order
                $commission = Setting::first()->commission * $amount;
                $net = $amount - $commission;
                $order = Order::create([
                    'vendor_id' => $vendor->id,
                    'delivery_cost' => $vendor->delivery_cost,
                    'payment_method_id' => $PaymentMethodId,  // you can use enumeration here as we use before for best practices for constants.
                    'user_id' => auth()->guard('user-api')->user()->id,
                    'user_phone' => auth()->guard('user-api')->user()->phone,
                    'user_name' => auth()->guard('user-api')->user()->name,
                    'cost' => $amount - $vendor->delivery_cost,
                    'total_cost' => $amount,
                    'commission' => $commission,
                    'net_cost' => $net,
                    'address' => $request->address,
                    'locale' => 'en',
                    'status' => Order::PAID,
                ]);

                // save in paivot table order products
                foreach ($request->products as $p) {
                    $product = $vendor->productHas($p['product_id']);
                    if(is_null($product)){
                        continue;
                    }
                    // update product quantity in stock
                    $product->update([
                        'in_stock' => $product->in_stock - $p['quantity'],
                    ]);
                    // delete product from carts
                    if(auth('user-api')->user()->cartHas($p['product_id'])){
                        auth('user-api')->user()->carts()->detach($p['product_id']);
                    }
                    // attach product in paivot table
                    $readyProduct = [ 
                        $p['product_id'] => [
                            'quantity' => $p['quantity'],
                            'price' => $product->price,
                        ]
                    ];
                    $order->products()->attach($readyProduct);
                }

                // save tranaction in database
                $transaction = Transaction::create([
                    'order_id' => $order->id,
                    'transaction_id' => $PaymentId,
                    'payment_method_id' =>  $PaymentMethodId,
                ]);

                // data send in notification 
                $data = [
                    'Order_Id' => $order->id,
                    'client_Name' => $order->user_name,
                    'client_Phone' => $order->user_phone,
                    'address' => $order->address,
                    'total_cost' => $order->total_cost,
                ]; 

                // fire event on order complete success for notification
                if($order){
                    Mail::to($vendor->email)
                        ->bcc("amrhuusien99@gmail.com")
                        ->send(New NewOrder($data));
                    DB::commit();
                }
            }
            return responseJson(1, 'Order Is Created');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }
    }

}
