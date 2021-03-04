<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Orders::latest()->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test = $request->get('product');
        $order = new Orders();
        $order->surname = $request->get('surname');
        $order->name = $request->get('name');
        $order->middle_name = $request->get('middle_name');
        $order->status = 'В обработке';
        $order->payment = 'Выключено';
        $order->phone_number = $request->get('phone_number');
        $order->sum_price = $request->get('sum_price');
        $order->sum_purchase_price = $request->get('sum_purchase_price');
        $order->ttn = 'test';
        $order->message = $request->get('message');
        $order->product = (string)$test;
        $order->save();

        return redirect('/orders')->with('success', 'Заказ отправлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = new Orders;
        return ['data' => $order->find($id)];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
