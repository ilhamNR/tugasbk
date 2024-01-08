<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        return view('home');
    }

    public function login(Request $request)
    {
        $patient = Patient::where('no_ktp', $request->no_ktp)->first();
        // dd($patient);
        if (isset($patient)) {
            Session::put('patientData', $patient);
            return redirect(route('patient.home'));
        } else {
            return back()->with('error', 'Pasien tidak ditemukan');
        }
    }

    public function register(Request $request)
    {
        // No. RM stuff
        // Get the current year and month
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->format('m'); // 'm' gives two-digit month representation
        $patients = Patient::all();
        // Define your variable (e.g., 101)
        $definedVariable = collect($patients)
        ->map(function ($patient) {
            // Extract the last three characters of the 'no_rm' attribute
            return substr($patient->no_rm, -3);
        })
        ->max();

        // Create the formatted string
        $formattedString = $currentYear . $currentMonth . '-' . $definedVariable+1;
        $patient = Patient::create([
            'name' => $request->name,
            'address' => $request->address,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $formattedString
        ]);
        Session::put('patientData', $patient);
        return redirect(route('patient.home'));
    }
}
