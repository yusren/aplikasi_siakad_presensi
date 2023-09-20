<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatakuliahRequest;
use App\Imports\MatakuliahImport;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MatakuliahController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'dosen') {
            return view('matakuliah.index', [
                'matakuliah' => Matakuliah::where('user_id', auth()->id())->get(),
            ]);
        }

        return view('matakuliah.index', [
            'matakuliah' => Matakuliah::get(),
        ]);
    }

    public function create()
    {
        return view('matakuliah.create', [
            'users' => User::where('role', 'dosen')->get(),
            'prodi' => Prodi::get(),
        ]);
    }

    public function store(MatakuliahRequest $request)
    {
        $data = $request->validated();
        Matakuliah::create($data);

        return redirect(route('matakuliah.index'))->with('toast_success', 'Berhasil Menyimpan Data!');

    }

    public function show(Matakuliah $matakuliah)
    {
        dd($matakuliah);
    }

    public function edit(Matakuliah $matakuliah)
    {
        return view('matakuliah.edit', [
            'matakuliah' => $matakuliah,
            'users' => User::where('role', 'dosen')->get(),
            'prodi' => Prodi::get(),
        ]);
    }

    public function update(MatakuliahRequest $request, Matakuliah $matakuliah)
    {
        $data = $request->validated();
        $matakuliah->update($data);

        return redirect(route('matakuliah.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect(route('matakuliah.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:2048',
        ]);

        $file = $request->file('file');
        Excel::import(new MatakuliahImport, $file);

        return back()->with('success', 'Matakuliah imported successfully.');
    }
}
