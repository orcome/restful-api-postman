<?php

namespace App\Http\Controllers\Country;

use App\Models\CountryModel;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function country()
    {
        return response()->json(CountryModel::get(), 200);
    }
}
