<?php

namespace App\Http\Controllers\dashboard\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use DB;
use DataTables;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsPrices = DB::select("SELECT DISTINCT product_id as p,(select sum(price * amount) FROM `order_details` where p=product_id  ) as total FROM `order_details` ");
        $productsAmounts = DB::select("SELECT DISTINCT product_id as p,(select sum(amount) FROM `order_details` where p=product_id  ) as count FROM `order_details` ");
         
        return view("dashboard.report.productorders", compact("productsPrices", "productsAmounts"));
    }

    
}
