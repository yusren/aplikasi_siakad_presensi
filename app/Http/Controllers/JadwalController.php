<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Fakultas;
use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $tahunAjaran = TahunAjaran::orderBy('name')->get();

        switch (auth()->user()->role) {
            case 'mahasiswa':
                $krs = auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId);
                $matakuliahIds = $krs->pluck('matakuliah_id')->toArray();
                $jadwal = Jadwal::where('tahun_ajaran_id', $tahunAjaranId)
                    ->whereHas('kelas.users', function ($query) {
                        $query->where('users.id', auth()->id());
                    })
                    ->whereIn('matakuliah_id', $matakuliahIds)
                    ->get();

                return view('jadwal.user.index', ['jadwal' => $jadwal, 'tahunAjaranAktif' => $tahunAjaranAktif, 'tahunAjaran' => $tahunAjaran]);
            case 'dosen':
                $jadwal = Jadwal::where('user_id', auth()->id())->where('tahun_ajaran_id', $tahunAjaranId)->whereHas('matakuliah.user', function ($query) {
                    $query->where('id', auth()->id());
                })->get();

                return view('jadwal.dosen.index', ['jadwal' => $jadwal, 'tahunAjaranAktif' => $tahunAjaranAktif, 'tahunAjaran' => $tahunAjaran]);
            default:
                return view('jadwal.index', ['jadwal' => Jadwal::get()]);
        }
    }

    public function indexDetailprodi(Request $request)
    {
        return $this->indexDetail($request, 'prodi');
    }

    public function indexDetailkelas(Request $request)
    {
        return $this->indexDetail($request, 'kelas');
    }

    public function indexDetailmatakuliah(Request $request)
    {
        return $this->indexDetail($request, 'matakuliah');
    }

    public function indexDetailpertemuan(Request $request)
    {
        $matakuliahId = $request->matakuliah;
        $kelasId = $request->kelas;
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);

        $jadwal = Jadwal::where('tahun_ajaran_id', $tahunAjaranId)
            ->where('kelas_id', $kelasId)
            ->whereHas('matakuliah', function ($query) use ($matakuliahId) {
                $query->where('id', $matakuliahId);
            })
            ->with('pertemuan')
            ->get();

        return view('jadwal.dosen.pertemuan.index', ['jadwal' => $jadwal, 'tahunAjaranAktif' => $tahunAjaranAktif]);
    }

    private function indexDetail(Request $request, ?string $groupKey)
    {
        $filters = [
            'prodi' => fn ($query, $value) => $query->whereHas('kelas.prodi', fn ($q) => $q->where('id', $value)),
            'kelas' => fn ($query, $value) => $query->whereHas('kelas', fn ($q) => $q->where('id', $value)),
            'matakuliah' => fn ($query, $value) => $query->whereHas('matakuliah', fn ($q) => $q->where('id', $value)),
        ];

        if ($groupKey && ! isset($filters[$groupKey])) {
            abort(404);
        }

        $tahunAjaranId = $request->get('tahun_ajaran_id', TahunAjaran::where('is_active', true)->latest()->first()->id);

        return view("jadwal.dosen.{$groupKey}.index", [
            'jadwal' => Jadwal::where(['user_id' => auth()->id(), 'tahun_ajaran_id' => $tahunAjaranId])
                ->when($request->$groupKey, ($filters[$groupKey] ?? null))
                ->with(['pertemuan'])
                ->get()
                ->when(
                    $groupKey,
                    fn ($results) => $results->groupBy(
                        fn ($item) => data_get($item, "{$groupKey}.name")
                    )
                ),
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('jadwal.create', [
            'tahunAjaran' => TahunAjaran::get(),
            'fakultas' => Fakultas::get(),
            'dosen' => User::where('role', 'dosen')->get(),
            'ruangan' => Ruang::get(),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        ]);
    }

    public function store(JadwalRequest $request)
    {
        $data = $request->validated();
        Jadwal::create($data);

        return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Jadwal $jadwal)
    {
        dd($jadwal);
    }

    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', [
            'jadwal' => $jadwal,
            'tahunAjaran' => TahunAjaran::get(),
            'fakultas' => Fakultas::get(),
            'dosen' => User::where('role', 'dosen')->get(),
            'ruangan' => Ruang::get(),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        ]);
    }

    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        $data = $request->validated();
        $jadwal->update($data);

        return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect(route('jadwal.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
