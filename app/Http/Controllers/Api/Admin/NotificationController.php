<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {

        try{
            $notifications = Notification::orderBy('id','DESC') -> paginate(50);
            return responseJson(1, 'Success', $notifications);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete($id)
    {

        try{
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return responseJson(1, 'Success Deleted');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
