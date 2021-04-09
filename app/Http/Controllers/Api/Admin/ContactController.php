<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {

        try{
            $contacts = Contact::orderBy('id', 'DESC')->paginate(30);
            return responseJson(1, 'Success', $contacts);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete($id)
    {

        try{
            $contact = Contact::findOrFail($id);
            $contact->delete();
            return responseJson(1, 'Success Deleted');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
