<?php

namespace App\Http\Controllers;

use App\Models\Rps;
use App\Models\RpsDetail;
use Illuminate\Http\Request;

class TestRpsController extends Controller
{
    public function index(Request $request)
    {
        $rps = Rps::get();

        return view('inputrps.index', [
            'rps' => $rps,
        ]);
    }

    public function show($id)
    {
        $rps = Rps::find($id);

        return view('inputrps.show', ['rps' => $rps, 'hasilRps' => auth()->user()->hasilRps->where('rps_id', $rps->id)->first()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        $rps = Rps::find($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/files', $fileName);
            $filePath = 'storage/files/'.$fileName;
        }

        RpsDetail::updateOrCreate(
            ['user_id' => auth()->id(), 'rps_id' => $rps->id],
            ['file' => $filePath]
        );

        return redirect()->route('inputrps.show', $rps->id)->with('toast_success', 'Berhasil Menyimpan Data!');
    }
}
