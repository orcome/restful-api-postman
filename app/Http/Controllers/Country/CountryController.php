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
        return response()->json(CountryModel::find($id), 200); // 200 :OK
    }

    public function countrySave(Request $request)
    {
        $country = CountryModel::create($request->all());
        return response()->json($country, 201); // 201 : Created
    }
}
