<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //proses validasi
        $validator = Validator::make($request->all(), [
            'name'      => 'required|min:5',
            'gender'    => 'required|in:male, female',
            'phone'     => 'required|numeric',
            'email'     => 'required|email',
        ]);

        if ($validator->fails()) {
            //return terdapat validasi error
            return response()->json(['status' => FALSE, 'error'=>$validator->errors()], 400);            
        }
        
        $data = new Data;
        $data->id = \Str::uuid();
        $data->name = $request->name;
        $data->gender = $request->gender;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();

        //return berhasil
        return response()->json(array('status' => TRUE, 'msg' => "Berhasil"),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json(Data::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id=null)
    {
        $data = Data::find($id);
        if($data)
        {
            //proses validasi
            $validator = Validator::make($request->all(), [
                'name'      => 'required|min:5',
                'gender'    => 'required|in:male, female',
                'phone'     => 'required|numeric',
                'email'     => 'required|email',
            ]);
    
            if ($validator->fails()) {
                //return terdapat validasi error
                return response()->json(['status' => FALSE, 'error'=>$validator->errors()], 400);            
            }

            //proses update
            $data->name = $request->name;
            $data->gender = $request->gender;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->save();

            //return berhasil
            return response()->json(array('status' => TRUE, 'msg' => "Berhasil"),200);

        }else{
            // return data tidak ditemukan
            return response()->json(['status' => FALSE, 'msg'=> 'Data tidak ditemukan'], 400);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null)
    {
        //cek apakah ada
        $data = Data::find($id);
        if($data)
        {
            // data ditemukan, lanjut hapus
            Data::destroy($id);
            //return berhasil
            return response()->json(array('status' => TRUE, 'msg' => "Berhasil"),200);
        }else{
            // return data tidak ditemukan
            return response()->json(['status' => FALSE, 'msg'=> 'Data tidak ditemukan'], 400);            
        }
    }
}
