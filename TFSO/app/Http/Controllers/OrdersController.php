<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function create(OrderRequest $req){
    	$order = new Orders();
    	$order->surname = $req->input('surname');
    	$order->name = $req->input('name');
    	$order->middle_name = $req->input('middle_name');
    	$order->status = 'В обработке';
    	$order->payment = 'В ожидании';
    	$order->phone_number = $req->input('phone_number');
    	$order->sum = $req->input('sum');
    	$order->ttn = $req->input('ttn');
    	$order->message = $req->input('message');
    	$order->save();

    	return redirect()->route('orders')->with('success', 'Заказ отправлен');
    }
    public function loadAll(){
    	return view('orders', ['data' => Orders::orderBy('id')->get()]);
    }
    public function search(Request $req){
    	$s = $req->s;
    	return view('orders', ['data' => Orders::where('name', 'LIKE', "%{$s}%")->get()]);
    }
    public function loadOne($id){
    	$order = new Orders;
        return view('ordersOne', ['data' => $order->find($id)]);
    }
    public function deleteOne($id){
    	Orders::find($id)->delete();
    	return redirect()->route('orders')->with('success', 'Заказ удален');
    }
    

}
