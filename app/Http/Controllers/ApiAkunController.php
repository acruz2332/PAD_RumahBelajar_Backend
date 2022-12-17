<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Guru;
use App\Models\Murid;
use DB;

function getTokenGuru(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';

    for ($i=0; $i < 6; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
};

function getTokenMurid(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';

    for ($i=0; $i < 5; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
};

class ApiAkunController extends Controller
{
    public function get_password($usr, $pwd){
        
        // $data = Akun::find($usr);
        // $data = DB::select("select * from akun where username='$usr'");
        // return response()->json(['data' => $data], 200);
        
        $check = Akun::firstWhere('username', $usr);
        if($check){
        //     return response()->json([
        //     'status' => 'success',
        //     'data' => Akun::find($usr)
        // ], 200);
            $data = Akun::find($usr);
            if ($pwd == $data->password){
                return response()->json([
                     'status' => 'success'
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 'failed',
                ], 200);
            }
        }
        else{
            return response()->json([
                'status' => 'not found',
            ], 200);
        }
        
    }


    public function get_login(Request $request){
        $check = Akun::firstWhere('username', $request->username);
        if($check){
            $data = Akun::find($request->username);
            if ($request->password == $data->password){
                if ($data->role == 'guru'){
                    $datauser = DB::select("select * from guru where username='".$request->username."'");
                    return response()->json([
                         'status' => 'success',
                         'username'=> $data->username,
                         'role'   => $data->role,
                         'token'  => $datauser[0]->token,
                         'nama'   => $datauser[0]->nama,
                    ], 200);
                }
                elseif($data->role == 'murid'){
                    $datauser = DB::select("select * from murid where username='".$request->username."'");
                    return response()->json([
                        'status' => 'success',
                        'username'=> $data->username,
                        'role'   => $data->role,
                        'token'  => $datauser[0]->token,
                        'nama'   => $datauser[0]->nama,
                   ], 200);
                }
            }
            else{
                return response()->json([
                    'status' => 'failed',
                    'message'=> 'wrong password',
                ], 200);
            }
        }
        else{
            return response()->json([
                'status' => 'not found',
                'message'=> 'username not found',
            ], 200);
        }
    }

    public function register(Request $request){
        if ($request->password1 == $request->password2){
            $check = Akun::firstWhere('username', $request->username);
            if ($check){
                return response()->json([
                    'status' => 'not found',
                    'message' => 'username already exist',
                ], 200);
            }else{    
                if ($request->role == 'guru'){
                    $data = new Akun;
                    $data->username = $request->username;
                    $data->password = $request->password1;
                    $data->role = $request->role;
                    $data->email = $request->email;
                    $data->timestamps = false;
                    $data->save();

                    $datauser = new Guru;
                    $datauser->token = getTokenGuru();
                    $datauser->username = $request->username;
                    $datauser->nama = $request->nama;
                    $datauser->tag_kelas = ' ';
                    $datauser->timestamps = false;
                    $datauser->save();
                }
                elseif($request->role == 'murid'){
                    $data = new Akun;
                    $data->username = $request->username;
                    $data->password = $request->password1;
                    $data->role = $request->role;
                    $data->email = $request->email;
                    $data->timestamps = false;
                    $data->save();

                    $datauser = new Murid;
                    $datauser->token = getTokenMurid();
                    $datauser->username = $request->username;
                    $datauser->nama = $request->nama;
                    $datauser->tag_kelas = ' ';
                    $datauser->nilai_quiz = ' ';
                    $datauser->timestamps = false;
                    $datauser->save();
                }
                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=> 'password does not match!',
            ], 200);
        }
    }
}
