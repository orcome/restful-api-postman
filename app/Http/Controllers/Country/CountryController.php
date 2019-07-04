<?php

namespace App\Http\Controllers\Country;

use Validator;
use App\Models\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function country()
    {
        return response()->json(CountryModel::get(), 200); // 200 :OK
    }

    public function countryByID($id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404); // 404 :Data request tidak ditemukan di server
        }
        return response()->json($country, 200); // 200 :OK
    }

    public function countrySave(Request $request)
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

    public function countryUpdate(Request $request, $id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404); // 404 :Data request tidak ditemukan di server
        }
        $country->update($request->all());
        return response()->json($country, 200); // 200 :OK
    }

    public function countryDelete(Request $request, $id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record not found!"], 404); // 404 :Data request tidak ditemukan di server
        }
        $country->delete();
        return response()->json(null, 204); //204 :Tidak ada data yang dikirim untuk request ini
    }
}
