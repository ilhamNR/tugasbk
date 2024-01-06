<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Medicine;
use GrahamCampbell\ResultType\Success;

class ObatController extends Controller
{
    public function index()
    {
        return view('admin.obat');
    }

    public function create(Request $request)
    {
        Medicine::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price
        ]);
        return back()->with('success', 'Data telah ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = Medicine::where('id', $id)->first;
        $data->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price
        ]);
        return back()->with('success', 'Data telah diupdate');
    }
    public function destroy($id)
    {
        $data = Medicine::where('id', $id)->first;
        $data->destroy();
        return back()->with('success', 'Data telah dihapus');
    }
}
