<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Medicine;
use GrahamCampbell\ResultType\Success;
use Yajra\DataTables\DataTables;
class ObatController extends Controller
{
    public function index(Request $request)
    {
        $data = Medicine::get();
        if ($request->ajax()) {
            return DataTables::of($data)->toJson();
        }

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

    public function edit($id){
        $data = Medicine::where('id', $id)->first();
        return json_encode($data);
    }

    public function update(Request $request, $id)
    {
        $data = Medicine::where('id', $id)->first();
        $data->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price
        ]);
        return back()->with('success', 'Data telah diupdate');
    }
    public function destroy(Request $request, $id)
    {
        $data = Medicine::find($id);

        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        $data->delete();

        return response()->json(['success' => 'Data has been deleted']);
    }
}
