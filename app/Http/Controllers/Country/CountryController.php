<?php

namespace App\Http\Controllers\Country;

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
            return response()->json('Record not found!', 404); // 404 :Data request tidak ditemukan di server
        }
        return response()->json($country, 200); // 200 :OK
    }

    public function countrySave(Request $request)
    {
        $country = CountryModel::create($request->all());
        return response()->json($country, 201); // 201 : Created
    }

    public function countryUpdate(Request $request, $id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json('Record not found!', 404); // 404 :Data request tidak ditemukan di server
        }
        $country->update($request->all());
        return response()->json($country, 200); // 200 :OK
    }

    public function countryDelete(Request $request, $id)
    {
        $country = CountryModel::find($id);
        if (is_null($country)) {
            return response()->json('Record not found!', 404); // 404 :Data request tidak ditemukan di server
        }
        $country->delete();
        return response()->json(null, 204); //204 :Tidak ada data yang dikirim untuk request ini
    }
}
