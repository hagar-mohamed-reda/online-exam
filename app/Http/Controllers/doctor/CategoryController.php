<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\Category; 
use DB;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("doctor.category.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = Category::where('doctor_id', Auth::user()->fid);
        return DataTables::eloquent($query)
                        ->addColumn('action', function(Category $category) {
                            return view("doctor.category.action", compact("category"));
                        }) 
                        ->rawColumns(['action'])
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
            $data = $request->all();
            $data["doctor_id"] = Auth::user()->fid;
             
            $category = Category::create($data); 
            
            notify(__('add category'), __('add category') . " " . $category->name); 
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
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
    public function edit(Category $category)
    { 
        return $category->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    { 
        try {
            $category->update($request->all()); 
            
            notify(__('edit category'), __('edit category') . " " . $category->name);
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
    public function destroy(Category $category)
    { 
        try { 
            if (!$category->can_delete)
                return Message::error("cant delete this category");
            
            notify(__('remove category'), __('remove category') . " " . $category->name);
            $category->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
