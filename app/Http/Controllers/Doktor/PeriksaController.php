<?php

namespace App\Http\Controllers\Doktor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeriksaController extends Controller
{
    public function index(){
        return view('doctor.periksa');
    }
}
