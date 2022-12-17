<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Murid;
use DB;
use Image;

function getTokenKelas(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $token = '';

    for ($i=0; $i < 7; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
};

class ApiKelasController extends Controller
{
    public function get_all_class(){
        $kelas = Kelas::all();
        $data;
        foreach ($kelas as $k){
            $data[] = [
                'token' => $k->token,
                'ikon'  => $k->ikon,
                'nama_kelas' => $k->nama_kelas,
            ];
        }
        return response()->json([
            'status' => 'success',
            'data'   => $data,
       ], 200);
        
    }
    public function create_class(Request $request){
        $kelas = new Kelas;
        
        $kelas->token = getTokenKelas();
        
        if ($request->ikon != null){
            $foto = $request->ikon;
            $namafile = time().'.'. $foto->getClientOriginalExtension();
            Image::make($foto)->resize(50,50)->encode('jpg')->save(storage_path().'\app\public/'.$namafile);
            $kelas->ikon = $namafile;
        }

        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->list_murid = ' ';
        $kelas->timestamps = false;
        $saved = $kelas->save();
        
        $guru = Guru::find($request->token);
        Guru::where('token', $request->token)->update(['tag_kelas' => $guru->tag_kelas.','.$kelas->token]);

        if ($saved){
            return response()->json([
                'status' => 'success',
           ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=> 'kesalahan di sisi pengguna',
           ], 404);
        }
    }

    public function delete_class(Request $request){
        Kelas::destroy($request->tokenKelas);
        $guru = Guru::find($request->tokenGuru);
        
        $str = explode(",", $guru->tag_kelas);
        
        for ($x = 0; $x < count($str); $x++){
            if ($str[$x] == $request->tokenKelas){
                unset($str[$x]);
                $str = join(",", $str);
                Guru::where('token', $request->tokenGuru)->update(['tag_kelas' => $str]);
                break;
            }
        }

        return response()->json([
            'status' => 'success',
            'message'=> 'berhasil dihapus',
       ], 200);
    }

    public function add_student(Request $request){
        $check = Murid::firstWhere('token', $request->tokenMurid);
        if($check){
            $kelas = Kelas::find($request->tokenKelas);
            Kelas::where('token', $request->tokenKelas)->update(['list_murid' => $kelas->list_murid.','.$request->tokenMurid]);
            return response()->json([
                'status' => 'success',
                'message'=> 'siswa berhasil ditambahkan',
           ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=> 'token siswa tidak ditemukan',
           ], 200);
        }
    }

    public function remove_student(Request $request){
        $murid = Murid::find($request->tokenMurid);
        
        $str = explode(",", $murid->tag_kelas);
     
        for ($x = 0; $x < count($str); $x++){
            if ($str[$x] == $request->tokenKelas){
                unset($str[$x]);
                $str = join(",", $str);
                Murid::where('token', $request->tokenMurid)->update(['tag_kelas' => $str]);
                break;
            }
        }
    
        return response()->json([
            'status' => 'success',
            'message'=> 'siswa berhasil dihapus',
       ], 200);
    }

    public function join_class(Request $request){
        $check = Kelas::firstWhere('token', $request->tokenKelas);
        if ($check){
            $murid = Murid::find($request->tokenMurid);
            Murid::where('token', $request->tokenMurid)->update(['tag_kelas' => $murid->tag_kelas.','.$request->tokenKelas]);
            
            return response()->json([
                'status' => 'success',
                'message'=> 'berhasil masuk kelas',
           ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=> 'kelas tidak ditemukan',
           ], 404);
        }        
    }

}


