<?php

namespace App\Http\Controllers;

use App\Models\TransparansiData;
use App\Models\TransparansiYear;
use App\Models\LampiranData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaparansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'dataTransparan' => TransparansiYear::orderBy('year', 'desc')->get(),
        ];
        return view('web.pages.mall-informasi.tranparansi-anggaran.crud.index', $data);
    }

    public function viewTrans()
    {
        $data = [
            'dataTransparan' => TransparansiYear::orderBy('year', 'desc')->get(),
        ];
        return view('web.pages.mall-informasi.tranparansi-anggaran.landing-page', $data);
    }
    public function viewYear($id)
    {
        $data = [
            'dataTransparan' => TransparansiData::where('transparansi_year_id', $id)->get(),
            'data' => TransparansiYear::where('id', $id)->first(),
        ];
        return view('web.pages.mall-informasi.tranparansi-anggaran.detail.index', $data);
    }
    public function getData($id)
    {
        $data = TransparansiData::where('transparansi_year_id', $id)->get();
        return response()->json(['data' => $data]);
    }
    public function getLampiran($id)
    {
        $data = LampiranData::where('transparansi_data_id', $id)->get();
        return response()->json(['data' => $data]);
    }

    public function create(Request $request)
    {
        try{
            $year = TransparansiYear::create([
                'year' => $request->year,
            ]);

            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Peraturan Daerah (PERDA) APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Peraturan Daerah (PERDA) Perubahan APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Dokumen RKPD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Kebijakan Umum Anggaran', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Dokumen Prioritas & Plafon Anggaran', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Dokumen RKA SKPD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Dokumen RKA PPKD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Rancangan PERDA APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan DPA SKPD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'DPA PPKD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Realisasi Pendapatan Daerah', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Realisasi Belanja Daerah', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Realisasi Pembiayaan Daerah', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan Dokumen Rancangan Perubahan APBD', 'docs' => null,]);
            Data::create(['transparansi_year_id' => $year->id, 'title' => 'Peraturan Kepala Daerah Penjabaran Perubahan APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Ringkasan RKA Perubahan APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Rencana Umum Pengadaan', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'SK Pejabat Pengelola Keuangan Daerah', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Peraturan Kepala Daerah Tentang Kebijakan Akuntansi', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Laporan Arus Kas', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Laporan Realisasi Anggaran SKPD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Laporan Realisasi Anggaran PPKD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Neraca', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'CaLK Pemerintah Daerah', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Laporan Keuangan BUMD/Perusda', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Laporan Akuntabilitas dan Kinerja Tahunan Pemerintah Daerah', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Penetapan Perda Pertanggungjawaban Pelaksanaan APBD', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Informasi Opini BPK', 'docs' => null,]);
            TransparansiData::create(['transparansi_year_id' => $year->id, 'title' => 'Laporan Penyelenggaraan Pemerintahan Daerah (LPPD)', 'docs' => null,]);

            return response()->json([
                'message' => 'berhasil',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }
    
    public function lampiranCreate(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:255', // Validasi ID
            'files' => 'required|array', // Validasi array files
            'files.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:1024000', // Validasi setiap file
            'title' => 'required|array', // Validasi array title
            'title.*' => 'required', // Validasi setiap file
        ]);
    
        try {
            // dd($request->id);
            $filePaths = []; 
            if ($request->hasFile('files')) {
                // Proses setiap file yang diunggah
                foreach ($request->file('files') as $key => $file) {
                    // Validasi file secara individual
                    if ($file->isValid()) {
                        // Buat nama file yang unik untuk menghindari duplikasi
                        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    
                        // Menyimpan file ke public directory atau storage
                        $file->move(public_path('files'), $fileName); // Atau menggunakan Storage::putFile
                        $filePaths[] = $fileName; 
    
                        LampiranData::create([
                            'transparansi_data_id' => $request->id, 
                            'title' => $request->title[$key], 
                            'file' => $fileName,
                        ]);
                    } else {
                        throw new \Exception("File tidak valid."); // Jika file tidak valid, lempar exception
                    }
                }
    
                // Mengembalikan response jika sukses
                return response()->json([
                    'message' => 'File berhasil diunggah',
                    'files' => $filePaths // Mengembalikan array nama file yang telah diunggah
                ]);
            } else {
                throw new \Exception("Tidak ada file yang diunggah."); // Menangani jika tidak ada file yang dikirim
            }
    
        } catch (\Exception $e) {
            // Menangani kesalahan
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function createData(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'docs' => 'file|mimes:pdf,doc,docx,jpg,png|max:1024000',  // Customize your file validation here
        ]);

        try{
            if(isset($request->id) && $request->id != 'create'){
                $trans = TransparansiData::where('id', $request->id)->first();
                $path = $trans->docs;
            }
            if ($request->hasFile('docs') && $request->file('docs')->isValid()) {
                $file = $request->file('docs');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $fileName);
                $path = $fileName;
            }
            if($request->id == 'create'){
                TransparansiData::create([
                    'transparansi_year_id' => $request->transparansi_year_id,
                    'title' => $request->title,
                    'date_publish' => $request->date_publish ?? null,
                    'docs' => $path ?? null,
                ]);
            }else{
                TransparansiData::where('id', $request->id)->update([
                    'title' => $request->title,
                    'date_publish' => $request->date_publish ?? null,
                    'docs' => $path ?? null,
                ]);
            }
            // return response()->json([
            //     'message' => 'berhasil',
            // ],200);
            return redirect()->back();
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }

    public function update(Request $request)
    {
        try{
            TransparansiYear::where('id', $request->id)->update([
                'year' => $request->year,
            ]);
            return response()->json([
                'message' => 'berhasil',
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }

    public function destroy(string $id)
    {
        try{
            LampiranData::whereHas('transparansiData', function ($query) use ($id) {
                $query->where('transparansi_year_id', $id);
            })->delete();            
            TransparansiData::where('transparansi_year_id', $id)->delete();
            TransparansiYear::where('id', $id)->delete();
            return redirect()->route('web.mall-informasi.transparansi-index');
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }
    public function destroyData(string $id)
    {
        try{
            LampiranData::with(['transparansiData'])->where('transparansi_data_id', $id)->delete();
            TransparansiData::where('id', $id)->delete();
            return redirect()->back();
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }
    public function deleteLampiran(string $id)
    {
        try{
            LampiranData::where('id', $id)->delete();
            return redirect()->back();
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }

    public function detail(Request $request){
        if(!isset($request->id)){
            return view('404');
        }

        $data = [
            'dataTransparan' => TransparansiData::where('transparansi_year_id', $request->id)->get(),
            'id' => $request->id ?? '',
        ];
        return view('web.pages.mall-informasi.tranparansi-anggaran.crud.detail', $data);
    }
}
