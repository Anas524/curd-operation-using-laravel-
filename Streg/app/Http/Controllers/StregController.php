<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Streg;

class StregController extends Controller
{
    public function viewPage() {
        $ModifyDatas = Streg::all();
        return view('streg', compact('ModifyDatas'));
    }

    public function addData(Request $request) {
        // dd($request->all());
        Streg::create($request->all());
        return redirect()->route('home')->with('status', 'User register successfully!');
    }

    public function edit($id) {
        $ModifyDatas = Streg::find($id);
        if (!$ModifyDatas) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($ModifyDatas);
    }

    public function updateData(Request $request, $id) {
        $ModifyDatas = Streg::findOrFail($id);
        $ModifyDatas->update($request->only(['name', 'email']));
        return redirect()->route('home')->with('status', 'Data updated successfully!');
    }

    public function delete($id) {
        $ModifyDatas = Streg::find($id);
        $ModifyDatas->delete();
        return redirect()->route('home')->with('status', 'Data deleted successfully!');
    }
}
