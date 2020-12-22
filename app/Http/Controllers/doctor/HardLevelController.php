<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\HardLevel; 
use DB;
use DataTables;

class HardLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("doctor.hardlevel.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = null;
        if (Auth::user()->type == 'admin')
            $query = HardLevel::query();
        else
            $query = HardLevel::where('doctor_id', Auth::user()->fid);
        
        
        return DataTables::eloquent($query->latest())
                        ->addColumn('action', function(HardLevel $hardlevel) {
                            return view("doctor.hardlevel.action", compact("hardlevel"));
                        }) 
                        ->editColumn('doctor_id', function(HardLevel $hardlevel) {
                            return optional($hardlevel->doctor)->name;
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
             
            $hardlevel = HardLevel::create($data); 
            
            notify(__('add hardlevel'), __('add hardlevel') . " " . $hardlevel->name); 
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
    public function edit(HardLevel $hardlevel)
    { 
        return $hardlevel->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HardLevel $hardlevel)
    { 
        try {
            $hardlevel->update($request->all()); 
            
            notify(__('edit hardlevel'), __('edit hardlevel') . " " . $hardlevel->name);
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
    public function destroy(HardLevel $hardlevel)
    { 
        try { 
            if (!$hardlevel->can_delete)
                return Message::error("cant delete this hardlevel");
            
            notify(__('remove hardlevel'), __('remove hardlevel') . " " . $hardlevel->name);
            $hardlevel->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
