<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountriesTimeController extends Controller
{
    public function index()
    {
        return view('countriesTime.index');
    }
    public function newYork_time()
    {
        return view('countriesTime.newyork_time');
    }
    public function australia_time()
    {
        return view('countriesTime.australia_time');
    }
    public function japan_time()
    {
        return view('countriesTime.japan_time');
    }
    public function nepal_time()
    {
        return view('countriesTime.nepal_time');
    }
}
