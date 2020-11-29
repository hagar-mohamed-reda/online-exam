<?php

namespace App\Http\Controllers\dashboard\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use DB;
use DataTables;

class ProductViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $productViews  = DB::select("SELECT DISTINCT product as p,(select count(ip) FROM `product_view` where p=product  ) as count FROM `product_view` ");
         
        return view("dashboard.report.productview", compact("productViews"));
    }

    
}
