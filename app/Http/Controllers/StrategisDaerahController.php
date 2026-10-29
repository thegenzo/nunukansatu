<?php

namespace App\Http\Controllers;

use App\Models\ProyekStrategisDaerah;
use App\Models\ProyekStrategisDaerahYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrategisDaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'dataTahun' => ProyekStrategisDaerahYear::orderBy('year', 'desc')->get(),
        ];
        return view('web.pages.mall-informasi.strategis-daerah.crud.index', $data);
    }

    public function viewTrans()
    {
        $data = [
            'dataTahun' => ProyekStrategisDaerahYear::orderBy('year', 'desc')->get(),
        ];
        return view('web.pages.mall-informasi.strategis-daerah.landing-page', $data);
    }
    public function viewYear($id)
    {
        $data = [
            'dataProyek' => ProyekStrategisDaerah::where('proyek_strategis_daerah_year_id', $id)->get(),
            'data' => ProyekStrategisDaerahYear::where('id', $id)->first(),
        ];
        return view('web.pages.mall-informasi.strategis-daerah.detail.index', $data);
    }
    public function getData($id)
    {
        $data = ProyekStrategisDaerah::where('proyek_strategis_daerah_year_id', $id)->get();
        return response()->json(['data' => $data]);
    }
    // public function getLampiran($id)
    // {
    //     $data = LampiranData::where('transparansi_data_id', $id)->get();
    //     return response()->json(['data' => $data]);
    // }

    public function create(Request $request)
    {
        try{
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $fileName);
                $path = $fileName;
            }
            $year = ProyekStrategisDaerahYear::create([
                'year' => $request->year,
                'file' => $path ?? null,
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
    
    
    public function createData(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'opd' => 'required',
            'pagu' => 'required',
            'metode' => 'required',
            'rencana_pelaksanaan' => 'required',
            'sumber_dana' => 'required',
            'file' => 'file|mimes:pdf,doc,docx,jpg,png|max:1024000',  // Customize your file validation here
        ]);

        try{
            if(isset($request->id) && $request->id != 'create'){
                $trans = ProyekStrategisDaerah::where('id', $request->id)->first();
                $path = $trans->file;
            }
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $fileName);
                $path = $fileName;
            }
            if($request->id == 'create'){
                ProyekStrategisDaerah::create([
                    'proyek_strategis_daerah_year_id' => $request->proyek_strategis_daerah_year_id,
                    'nama' => $request->nama,
                    'opd' => $request->opd,
                    'pagu' => $request->pagu,
                    'metode' => $request->metode,
                    'rencana_pelaksanaan' => $request->rencana_pelaksanaan,
                    'sumber_dana' => $request->sumber_dana,
                    'file' => $path ?? null,
                ]);
            }else{
                ProyekStrategisDaerah::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'opd' => $request->opd,
                    'pagu' => $request->pagu,
                    'metode' => $request->metode,
                    'rencana_pelaksanaan' => $request->rencana_pelaksanaan,
                    'sumber_dana' => $request->sumber_dana,
                    'file' => $path ?? null,
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
                $trans = ProyekStrategisDaerahYear::where('id', $request->id)->first();
                $path = $trans->file ?? null;

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $fileName);
                $path = $fileName;
            }
            ProyekStrategisDaerahYear::where('id', $request->id)->update([
                'year' => $request->year,
                'file' => $path,
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
            ProyekStrategisDaerah::where('proyek_strategis_daerah_year_id', $id)->delete();
            ProyekStrategisDaerahYear::where('id', $id)->delete();
            return redirect()->route('web.mall-informasi.strategis-index');
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }
    public function destroyData(string $id)
    {
        try{
            ProyekStrategisDaerah::where('id', $id)->delete();
            return redirect()->back();
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }
    // public function deleteLampiran(string $id)
    // {
    //     try{
    //         LampiranData::where('id', $id)->delete();
    //         return redirect()->back();
    //     }catch(\Exception $e){
    //         return response()->json([
    //             'message' => $e->getMessage(),
    //         ],500);
    //     }
    // }

    public function detail(Request $request){
        if(!isset($request->id)){
            return view('404');
        }

        $data = [
            'dataTransparan' => ProyekStrategisDaerah::where('proyek_strategis_daerah_year_id', $request->id)->get(),
            'id' => $request->id ?? '',
        ];
        return view('web.pages.mall-informasi.strategis-daerah.crud.detail', $data);
    }
}
