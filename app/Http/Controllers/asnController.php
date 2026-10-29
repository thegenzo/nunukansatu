<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class asnController extends Controller
{
    public function asnGet ($nip = null)
    {
        try {
            if (!$nip) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'NIP kosong',
                ], 400);
            }

            $query = DB::table('asns')->where('nip', $nip);

            $response = $query->get();

            if ($response->isEmpty()) {
                throw new Exception('NIP not found');
            }

            $response = $response->map(function ($item){
                return [
                    'nip' => $item->nip,
                    'response' => json_decode($item->data),
                ];
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Data ASN berhasil diambil',
                'data' => $response
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
