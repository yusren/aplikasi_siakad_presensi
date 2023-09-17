<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Jadwal;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use App\Services\NilaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $nilaiService;

    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

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
        $dosen = User::where('role', 'dosen')->get();
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
        switch ($request->role) {
            case 'mahasiswa':
                return view('users.mahasiswa.create', ['prodi' => $prodi, 'agama' => $agama, 'dosen' => $dosen]);
            case 'dosen':
                return view('users.dosen.create', ['prodi' => $prodi, 'agama' => $agama]);
            default:
                abort(404);
        }
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
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
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $tahunAjaran = TahunAjaran::orderBy('name')->get();
        if ($request->role == 'mahasiswa') {
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
                'tahunAjaran' => $tahunAjaran,
                'bobot_tugas' => $bobot['bobot_tugas'],
                'bobot_uts' => $bobot['bobot_uts'],
                'bobot_uas' => $bobot['bobot_uas'],
                'bobot_keaktifan' => $bobot['bobot_keaktifan'],
            ]);
        } else {
            $userid = $user->id;
            $jadwal = Jadwal::where('user_id', $userid)->where('tahun_ajaran_id', $tahunAjaranId)->whereHas('matakuliah.user', function ($query) use ($userid) {
                $query->where('id', $userid);
            })->get();

            return view('users.dosen.show', [
                'user' => $user,
                'jadwal' => $jadwal,
                'tahunAjaranAktif' => $tahunAjaranAktif,
                'tahunAjaran' => $tahunAjaran,
            ]);
        }
    }

    public function edit(Request $request, User $user)
    {
        $prodi = Prodi::get();
        $dosen = User::where('role', 'dosen')->get();
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];

        switch ($request->role) {
            case 'mahasiswa':
                if (auth()->user()->role == 'mahasiswa') {
                    return view('users.mahasiswa.profile', ['user' => $user, 'prodi' => $prodi, 'dosen' => $dosen, 'agama' => $agama]);
                }

                return view('users.mahasiswa.edit', ['user' => $user, 'prodi' => $prodi, 'dosen' => $dosen, 'agama' => $agama]);
            case 'dosen':
                return view('users.dosen.edit', ['user' => $user, 'prodi' => $prodi, 'agama' => $agama]);
            default:
                abort(404);
        }
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
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

            return redirect()->back()->with('toast_warning', 'Berhasil Merubah Data!');
        }

        return redirect(route('user.index', ['role' => $request->role]))->with('toast_warning', 'Berhasil Merubah Data!');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect(route('user.index', ['role' => $request->role]))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
