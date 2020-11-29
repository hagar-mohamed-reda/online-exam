<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
 
use App\helper\Message;
use App\imports\CustomerImporter;
use App\helper\Helper;
use App\Customer; 
use DB;
use DataTables;
use Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.customer.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = Customer::query();
        
        if (request()->city_id) {
            $query->where("city_id", request()->city_id);
        }
        
        if (request()->area_id) {
            $query->where("area_id", request()->area_id);
        }
        
        if (request()->class) {
            $query->where("class", request()->class);
        }
        
        if (Auth::user()->_can('user customer')) {
            $query->where("user_id", Auth::user()->id);
        }
        
        return DataTables::eloquent($query)
                        ->addColumn('action', function(Customer $customer) {
                            return view("dashboard.customer.action", compact("customer"));
                        })->editColumn('photo', function(Customer $customer) {
                            return "<img src='" . $customer->url . "' height='30px' />";
                        })->editColumn('city_id', function(Customer $customer) {
                            return optional($customer->city)->name;
                        })->editColumn('area_id', function(Customer $customer) {
                            return optional($customer->area)->name;
                        })  
                        ->rawColumns(['action', 'photo'])
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
            $customer = Customer::create($request->all());
            
            // upload customer photo
            Helper::uploadImg($request->file("card_photo"), "/customer", function($filename) use ($customer){
                $customer->update([
                    "card_photo" => $filename
                ]);
            });
            Helper::uploadImg($request->file("shop_photo"), "/customer", function($filename) use ($customer){
                $customer->update([
                    "shop_photo" => $filename
                ]);
            });
            
            notify(__('add customer'), __('add customer') . " " . $customer->name);
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view("dashboard.customer.show", compact("customer"));
    }

    
    /**
     * import customer from excel file
     * 
     * @param Request $request
     * @return type
     */
    public function import(Request $request) {
        Excel::import(new CustomerImporter, $request->file('customers'));
        
        notify(__('import customer'), __('import customer'));
        return Message::success(Message::$DONE);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sheet(Customer $customer)
    {
        return view("dashboard.customer.sheet", compact("customer"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    { 
        return view("dashboard.customer.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    { 
        try {
            $customer->update($request->all());
            
            // upload customer photo
            Helper::uploadImg($request->file("card_photo"), "/customer", function($filename) use ($customer){
                $customer->update([
                    "card_photo" => $filename
                ]);
            });
            Helper::uploadImg($request->file("shop_photo"), "/customer", function($filename) use ($customer){
                $customer->update([
                    "shop_photo" => $filename
                ]);
            });
            
            notify(__('edit customer'), __('edit customer') . " " . $customer->name);
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
    public function destroy(Customer $customer)
    { 
        try { 
            notify(__('remove customer'), __('remove customer') . " " . $customer->name);
            $customer->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
