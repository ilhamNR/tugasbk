<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){

        return view('home');
    }

    public function login(Request $request){
        $patient = Patient::where('no_ktp', $request->no_ktp)->first();
        // dd($patient);
        if (isset($patient)){
            Session::put('patientData', $patient);
            return redirect(route('patient.home'));
        }
        else{
            return back()->with('error','Pasien tidak ditemukan');
        }
    }

    public function register(Request $request){
        $patient = Patient::create([
            'name' => $request->name,
            'address' => $request->address,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
        ]);
        Session::put('patientData', $patient);
        return redirect(route('patient.home'));
    }
}
