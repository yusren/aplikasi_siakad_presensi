<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', $request->role)->get();
        abort_if(! isset($users), 404);
        switch ($request->role) {
            case 'mahasiswa':
                return view('users.mahasiswa.index', ['users' => $users]);
            case 'dosen':
                return view('users.dosen.index', ['users' => $users]);
            default:
                abort(404);
        }
    }

    public function create(Request $request)
    {
        $prodi = Prodi::get();
        switch ($request->role) {
            case 'mahasiswa':
                return view('users.mahasiswa.create', ['prodi' => $prodi]);
            case 'dosen':
                return view('users.dosen.create', ['prodi' => $prodi]);
            default:
                abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'prodi_id' => 'required',
            'name' => 'required',
            'nomor' => 'required_if:role,mahasiswa',
            'photo' => 'nullable',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'same:confirm-password',
            'agama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
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

        return redirect(route('user.index', ['role' => $request->role]))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Request $request, User $user)
    {
        if ($request->role == 'mahasiswa') {
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

            return view('users.mahasiswa.show', [
                'user' => $user,
                'krs' => $krs,
                'jadwal' => $jadwal,
                'tahunAjaranAktif' => $tahunAjaranAktif,
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        } else {
            dd($user->toArray());

            return view('users.non-mahasiswa.show', []);
        }
    }

    public function edit(Request $request, User $user)
    {
        $prodi = Prodi::get();
        $dosen = User::where('role', 'dosen')->get();

        switch ($request->role) {
            case 'mahasiswa':
                return view('users.mahasiswa.edit', ['user' => $user, 'prodi' => $prodi, 'dosen' => $dosen]);
            case 'dosen':
                return view('users.dosen.edit', ['user' => $user, 'prodi' => $prodi]);
            default:
                abort(404);
        }
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'user_id' => 'nullable',
            'prodi_id' => 'nullable',
            'name' => 'required',
            'nomor' => 'required_if:role,mahasiswa',
            'photo' => 'nullable',
            // 'username' => 'required',
            'role' => 'required_if:role, !=, mahasiswa',
            'jenis_kelamin' => 'required',
            'status' => 'required_if:role, !=, mahasiswa',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
            'agama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
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

        if (auth()->user()->role == 'mahasiswa') {
            $user->keluarga()->updateOrCreate([], [
                'ayah' => $request->ayah,
                'ibu' => $request->ibu,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'penghasilan_ibu' => $request->penghasilan_ibu,
            ]);
        }

        return redirect(route('user.index', ['role' => $request->role]))->with('toast_warning', 'Berhasil Merubah Data!');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect(route('user.index', ['role' => $request->role]))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
