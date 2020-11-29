<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\helper\Message;
use App\helper\Helper;
use App\Sheet;
use App\SheetDetail;
use App\Customer;
use App\Gift;
use App\GiftOrderDetail;
use DB;
use DataTables;

class SheetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view("dashboard.sheet.index");
    }

    /**
     * return json data
     */
    
    public function getData() {
        return DataTables::eloquent(Sheet::query())
                        ->addColumn('action', function(Sheet $sheet) {
                            return view("dashboard.sheet.action", compact("sheet"));
                        })->editColumn('photo', function(Sheet $sheet) {
                            return "<img src='" . $sheet->url . "' height='30px' onclick='viewImage(this)' />";
                        })->editColumn('customer_id', function(Sheet $sheet) {
                            return optional($sheet->customer)->name;
                        })->editColumn('user_id', function(Sheet $sheet) {
                            return optional($sheet->user)->name;
                        })->editColumn('is_receive_gifts', function(Sheet $sheet) {
                            return "<span class='label label-" . (($sheet->is_receive_gifts)? 'success' : 'danger') . "' >" . (($sheet->is_receive_gifts)? __('on') : __('off')) .  "</span>";
                        })->editColumn('class', function(Sheet $sheet) {
                            $html = "";
                            if ($sheet->class == 'A')
                                $html = "<b class='w3-text-green' >A</b>";
                            
                            else if ($sheet->class == 'B')
                                $html = "<b class='w3-text-orange' >B</b>";
                            
                            else if ($sheet->class == 'C')
                                $html = "<b class='w3-text-deep-orange' >C</b>";
                            
                            else if ($sheet->class == 'D')
                                $html = "<b class='w3-text-red' >D</b>";
                            
                            return $html;
                        })
                        ->rawColumns(['action', 'photo', 'is_receive_gifts', 'class'])
                        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $sheet = Sheet::create($request->all());

            for ($index = 0; $index < count($request->product_id); $index ++) {
                SheetDetail::create([
                    "sheet_id" => $sheet->id,
                    "product_id" => $request->product_id[$index],
                    "amount" => $request->amount[$index],
                    "price" => $request->price[$index],
                    "additional_value" => $request->additional_value[$index],
                    "total" => $request->totals[$index],
                ]);
            }

            // upload sheet photo
            Helper::uploadImg($request->file("photo"), "/sheet", function($filename) use ($sheet) {
                $sheet->update([
                    "photo" => $filename
                ]);
            });

            // update class of customer
            if ($request->class) {
                $customer = Customer::find($request->customer_id);
                if ($customer) {
                    $customer->update([
                        "class" => $request->class
                    ]);
                }
            }
            
            // decrease the amount of gift if the customer receive the gifts
            if ($request->is_receive_gifts) {
                $this->decreaseAmountOfGiftBasedOnClass($request->class, $sheet->id);
            }

            notify(__('add sheet'), __('add sheet') . " " . $sheet->date);
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * create amount of gift in store based on the class
     * 
     * @param type $class
     * @param type $sheetId
     */
    public function decreaseAmountOfGiftBasedOnClass($class, $sheetId) {
        if (!$class)
            return;
        
        foreach (Gift::all() as $gift) {
            $amount = 0;
            
            if ($class == 'A')
                $amount = $gift->class_a_amount;
            
            if ($class == 'B')
                $amount = $gift->class_b_amount;
            
            if ($class == 'C')
                $amount = $gift->class_c_amount;
            
            if ($class == 'D')
                $amount = $gift->class_d_amount;
            
            if ($amount > 0 && $gift->amount > 0) {
                GiftOrderDetail::create([
                    "sheet_id" => $sheetId,
                    "gift_id" => $gift->id,
                    "amount" => $amount,
                ]);

                // decreate the amount
                $gift->update([
                    "amount" => ($gift->amount - $amount)
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet) {
        return view("dashboard.sheet.show", compact("sheet"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sheet(Sheet $sheet) {
        return view("dashboard.sheet.sheet", compact("sheet"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sheet $sheet) {
        return view("dashboard.sheet.edit", compact("sheet"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sheet $sheet) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet) {
        try {
            notify(__('remove sheet'), __('remove sheet') . " " . $sheet->date);
            $sheet->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
