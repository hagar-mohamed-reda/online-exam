<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

use App\helper\Message;
use App\helper\Helper;
use App\Product;
use App\OrderDetail;
use App\Role;
use DataTables;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.product.index");
    }

    /**
     * return json data
     */
    public function getData() {
        return DataTables::eloquent(Product::query())
                        ->addColumn('action', function(Product $product) {
                            return view("dashboard.product.action", compact("product"));
                        }) 
                        ->editColumn('category_id', function(Product $product) {
                            return optional($product->category)->name;
                        })   
                        ->editColumn('active', function(Product $product) {
                            $label = $product->active == 1? 'success' : 'danger';
                            $text = $product->active == 1? __('on') : __('off');
                            
                            return "<span class='label label-$label' >$text</span>";
                        })  
                        ->rawColumns(['action', 'active'])
                        ->toJson();
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
        try {
            $product = Product::create($request->all());  
            
            // upload product photo
            Helper::uploadImg($request->file("photo"), "/product", function($filename) use ($product){
                $product->update([
                    "photo" => $filename
                ]);
            });
            
            notify(__('add product'), __('add product') . " " . $product->name);
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
    
    /**
     * import products from excel file
     * 
     * @param Request $request
     * @return type
     */
    public function import(Request $request) { 
        return Message::success(Message::$DONE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    { 
//        dump($product);
//        return;
        return view("dashboard.product.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    { 
        try {   
            $product->update($request->all()); 
            
            // upload product photo
            Helper::uploadImg($request->file("photo"), "/product", function($filename) use ($product){
                $product->update([
                    "photo" => $filename
                ]);
            });
            notify(__('edit product'), __('edit product') . " " . $product->name);
            return Message::success(Message::$EDIT);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    { 
        try { 
            notify(__('remove product'), __('remove product') . " " . $product->name);
            $product->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
