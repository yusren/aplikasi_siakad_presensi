<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::where('role', 'dosen')->orWhere('role', 'mahasiswa')->get(),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'roles' => [
                'dosen',
                'mahasiswa',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required_if:role,mahasiswa',
            'photo' => 'nullable',
            // 'username' => 'required',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'same:confirm-password',
        ]);
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/photos', $fileName);
            $data['photo'] = 'storage/photos/'.$fileName;
        }
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect(route('user.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Request $request, User $user)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $krs = $user->krs->where('tahun_ajaran_id', $tahunAjaranId);
        $matakuliahIds = $krs->pluck('matakuliah_id')->toArray();
        $jadwal = Jadwal::where('tahun_ajaran_id', $tahunAjaranId)
            ->whereHas('kelas.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->whereIn('matakuliah_id', $matakuliahIds)
            ->get();

        return view('users.show', [
            'user' => $user,
            'krs' => $krs,
            'jadwal' => $jadwal,
            'tahunAjaranAktif' => $tahunAjaranAktif,
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => [
                'dosen',
                'mahasiswa',
            ],
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required_if:role,mahasiswa',
            'photo' => 'nullable',
            // 'username' => 'required',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
        ]);
        $data = $request->all();
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete(str_replace('storage', 'public', $user->photo));
            }
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/photos', $fileName);
            $data['photo'] = 'storage/photos/'.$fileName;
        }
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $user->update($data);

        return redirect(route('user.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('user.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
