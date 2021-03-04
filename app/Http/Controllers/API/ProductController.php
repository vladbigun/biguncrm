<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->sizes = Product::find($product->id)->size;
        }
         return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          // Имя и расширение файла
        $filenameWithExt = $request->file('main_image')->getClientOriginalName();
          // Только оригинальное имя файла
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          // Расширение
        $extention = $request->file('main_image')->getClientOriginalExtension();
          // Путь для сохранения
        $fileNameToStore = "product_images/". $request->get('teg') .".jpeg";
          // Сохраняем файл
        $path = $request->file('main_image')->storeAs('public/', $fileNameToStore);

        $product = new Product();
        $product->teg = $request->get('teg');
        $product->title = $request->get('title');
        $product->purchase_price = $request->get('purchase_price');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        $product->category_id = $request->get('category');
        $product->save();


        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = new Product;
        return ['data' => $product->find($id)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
