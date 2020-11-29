<?php

namespace App\Http\Controllers\dashboard\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use DB;
use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $orders = []; 
        $ordersTotal = 0;
        if ($request->has("datefrom")) {
            $orders = Order::whereBetween("created_at", [$request->datefrom, $request->dateto])->get(); 
            $ordersTotal = $this->getTotalOfOrder($orders); 
        } else {
            $orders = Order::all();
            $ordersTotal = $this->getTotalOfOrder($orders); 
        }
        return view("dashboard.report.orders", compact("orders", "ordersTotal"));
    }

    /**
     * get total of the orders
     * @param type $orders
     * @return type
     */
    public function getTotalOfOrder($orders) {
        $total = 0;
        foreach ($orders as $order) {
            $total += $order->getTotal();
        }
        
        return $total;
    }
    
}
