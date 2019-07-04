<?php

namespace App\Http\Controllers\Country;

use Validator;
use App\Models\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryResController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CountryModel::get(), 200); // 200 :OK
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
        $rules = [
            'name' => 'required|min:3',
            'iso'  => 'required|min:2|max:2',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); //400 :Server tidak mengerti perintah karena data tidak valid
        }

        $country = CountryModel::create($request->all());
        return response()->json($country, 201); // 201 : Created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404); // 404 :Data request tidak ditemukan di server
        }
        return response()->json($country, 200); // 200 :OK
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
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404); // 404 :Data request tidak ditemukan di server
        }
        $country->update($request->all());
        return response()->json($country, 200); // 200 :OK
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404); // 404 :Data request tidak ditemukan di server
        }
        $country->delete();
        return response()->json(null, 204); //204 :Tidak ada data yang dikirim untuk request ini
    }
}
