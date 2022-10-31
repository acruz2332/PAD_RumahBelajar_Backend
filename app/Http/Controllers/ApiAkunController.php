<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
class ApiAkunController extends Controller
{
    public function get_password($usr){
        $check = Akun::firstWhere('username', $usr);
        if($check){
            return response()->json([
                'status' => 'success',
                'data' => Akun::find($usr)->toArray(),
            ], 200);
        }
        else{
            return response()->json([
                'status' => 'not found',
                'message' => 'tidak ada username terkait',
            ], 404);
        }
    }
}
