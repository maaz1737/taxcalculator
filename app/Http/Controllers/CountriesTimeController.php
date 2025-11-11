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
    public function bhutan_time()
    {
        return view('countriesTime.bhutan_time');
    }
    public function india_time()
    {
        return view('countriesTime.india_time');
    }
    public function uae_time()
    {
        return view('countriesTime.uae_time');
    }
    public function pakistan_time()
    {
        return view('countriesTime.pakistan_time');
    }
    public function saudia_arabia_time()
    {
        return view('countriesTime.saudia_arabia_time');
    }
    public function bangladesh_time()
    {
        return view('countriesTime.bangladesh_time');
    }
    public function california_time()
    {
        return view('countriesTime.california_time');
    }
}
