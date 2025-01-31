<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Layanan;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $trainers = Trainer::all();
        // $layanans = Layanan::all();
        $pelatihans = Pelatihan::all();
        return view('frontend.index', compact('pelatihans', 'trainers'));
    }
}
