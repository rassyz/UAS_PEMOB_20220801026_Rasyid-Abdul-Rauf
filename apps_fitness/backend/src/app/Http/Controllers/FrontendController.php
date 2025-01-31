<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Layanan;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        // $abouts = About::all();
        // $layanans = Layanan::all();
        $pelatihans = Pelatihan::all();
        return view('frontend.index', compact('pelatihans'));
    }
}
