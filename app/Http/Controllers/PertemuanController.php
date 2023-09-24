<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Pertemuan;
use App\Models\TahunAjaran;
use App\Models\UploadTugas;
use App\Models\User;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $tahunAjaran = TahunAjaran::orderBy('name')->get();
        $matakuliah = Matakuliah::where('user_id', auth()->id())->get();
        $matakuliahId = $request->input('matakuliah_id', Matakuliah::where('user_id', auth()->id())->first()->id);
        $matakuliahAktif = Matakuliah::where('user_id', auth()->id())->find($matakuliahId);

        $pertemuan = Pertemuan::with('jadwal.matakuliah')->whereHas('jadwal', function ($query) use ($tahunAjaranId, $matakuliahId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId)->where('matakuliah_id', $matakuliahId);
        })->get();

        // $pertemuanGrouped = $pertemuan->groupBy(function ($item, $key) {
        //     return $item['jadwal']['matakuliah']['name'];
        // });

        // $students = User::where('role', 'mahasiswa')->get();
        // $attendanceData = [];
        // foreach ($students as $student) {
        //     $studentAttendance = [];
        //     $studentAttendance['Nama Mahasiswa'] = $student->name;
        //     foreach ($pertemuan as $meeting) {
        //         $attended = $meeting->presensi->contains('user_id', $student->id) ? 'Hadir' : 'Tidak Hadir';
        //         $studentAttendance["Pertemuan {$meeting->id}"] = $attended;
        //     }
        //     $attendanceData[] = $studentAttendance;
        // }
        $students = collect();
        foreach ($pertemuan as $meeting) {
            $students = $students->concat($meeting->jadwal->kelas->users);
        }
        $students = $students->unique('id');

        $attendanceData = [];
        foreach ($students as $student) {
            $studentAttendance = [];
            $studentAttendance['Nama Mahasiswa'] = $student->name;
            $studentAttendance['Kelas'] = $student->kelas[0]->name;
            for ($i = 1; $i <= 16; $i++) {
                if (isset($pertemuan[$i - 1])) {
                    $attended = $pertemuan[$i - 1]->presensi->contains('user_id', $student->id) ? "<i class='fa fa-solid fa-check' style='color: #1dc33e;'></i>" : "<i class='fa fa-times' style='color: red;'></i>";
                } else {
                    $attended = "<i class='fa fa-circle' style='color: #367fa9;'></i>";
                }
                $studentAttendance["Pertemuan {$i}"] = $attended;
            }
            $attendanceData[] = $studentAttendance;
        }

        return view('pertemuan.index', [
            'pertemuan' => $pertemuan,
            'tahunAjaranAktif' => $tahunAjaranAktif,
            'tahunAjaran' => $tahunAjaran,
            'matakuliah' => $matakuliah,
            'matakuliahAktif' => $matakuliahAktif,
            'attendanceData' => $attendanceData,
        ]);
    }

    public function create(Request $request)
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        $pertemuan = Pertemuan::where('user_id', auth()->user()->id)->where('jadwal_id', $jadwal->id)->count();
        $nama = 'Pertemuan '.($pertemuan + 1);

        return view('pertemuan.create', ['jadwal' => $jadwal, 'nama' => $nama]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'jadwal_id' => 'required',
            'topic' => 'nullable',
            'sub_topic' => 'nullable',
            'dosen_pengganti' => 'nullable',
        ]);

        $data['user_id'] = auth()->user()->id;

        $pertemuan = Pertemuan::create($data);

        return redirect(route('pertemuan.show', $pertemuan->id))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Pertemuan $pertemuan)
    {
        $records = $pertemuan->jadwal->kelas->users->map(function ($user) use ($pertemuan) {
            $presensi = $pertemuan->presensi->where('user_id', $user->id)->first();

            return [
                'nomor' => $user->nomor,
                'name' => $user->name,
                'created_at' => optional($presensi)->created_at,
                'id' => optional($presensi)->id,
            ];
        });

        switch (auth()->user()->role) {
            case 'mahasiswa':
                return view('pertemuan.user.show', [
                    'pertemuan' => $pertemuan,
                ]);
            case 'dosen':
                return view('pertemuan.show', [
                    'pertemuan' => $pertemuan,
                    'records' => $records,
                ]);
            default:
                return '404';
        }
    }

    public function uploadtugas(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:png,jpg,doc,docx,pdf,xls,xlsx',
        ]);
        $file = $request->file('file');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/files', $fileName);
        $filePath = 'storage/files/'.$fileName;

        UploadTugas::create([
            'pertemuan_id' => $request->pertemuan_id,
            'user_id' => auth()->id(),
            'file' => $filePath,
        ]);

        return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }
}
