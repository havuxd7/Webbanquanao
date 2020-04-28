<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\order;
class OrderController extends Controller
{
    function GetOrder()
    {
        $data['orders']=order::where('state',2)->orderby('id','DESC')->paginate(3);
        return view("backend.order.order", $data);
    }

    
    function GetDetailOrder($order_id)
    {
        $data['order']=order::find($order_id);
        return view("backend.order.detailorder", $data);
    }


    function GetProcessed()
    {
        $data['orders']=order::where('state',1)->orderby('updated_at','DESC')->paginate(3);
        return view("backend.order.processed", $data);
    }
    function paid($order_id)
    {
        $order=order::find($order_id);
        $order->state=1;
        $order->save();
        return redirect('admin/order/processed');
    }
}
