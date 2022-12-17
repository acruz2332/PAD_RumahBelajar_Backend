<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Nilai;
use Illuminate\Http\Request;
use DB;

class ApiNilaiController extends Controller
{
    public function get_nilai($tokenQuiz){
        $quiz = DB::table('nilai')->where('tokenQuiz', $tokenQuiz)->get();
        $nama;
        $temp;
        $data;
        if (count($quiz) > 0){
            for ($x = 0; $x < count($quiz); $x++){
                $temp[$x] = DB::table('murid')->where('token', $quiz[$x]->tokenMurid)->get();
                $data[] = [
                    "token" => $quiz[$x]->tokenMurid,
                    "nama" => $temp[$x][0]->nama,
                    "benar" => $quiz[$x]->benar,
                    "salah" => $quiz[$x]->salah,
                    "kosong" => $quiz[$x]->kosong,
                    "percobaanKe" => $quiz[$x]->count,
                    "nilai" => $quiz[$x]->nilai,
                    ];
            }
            return response()->json([
            'status' => 'success',
            'data'   => $data,
       ], 200);
        }else{
            return response()->json([
            'status' => 'failed',
       ], 404);
        }
    }
    public function store_nilai(Request $request){
        $tokenMurid = $request->tokenMurid;
        $tokenQuiz = $request->tokenQuiz;

        $question = DB::table('question')->where('token', $tokenQuiz)->get();
        $question = $question[0];

        $actualAnswer = explode(",?>", $question->jawaban);
        $studentAnswer = explode(",", $request->studentAnswer);

        $benar = 0;
        $salah = 0;
        $kosong = 0;
        for ($x = 0; $x < count($actualAnswer) ; $x++){
            if ($actualAnswer[$x] == $studentAnswer[$x]){
                $benar += 1;
            }else{
                if ($studentAnswer[$x] == 'null'){
                    $kosong += 1;
                    continue;
                }else{
                    $salah += 1;
                }
            }
        }

        $nilainya = round(($benar * 100)/count($actualAnswer));

        $checker = DB::table('nilai')
            ->where('tokenMurid', $tokenMurid)
            ->where('tokenQuiz', $tokenQuiz)
            ->get();
        
        $nilai = new Nilai;
        $nilai->tokenMurid = $tokenMurid;
        $nilai->tokenQuiz = $tokenQuiz;
        $nilai->count = count($checker)+1; 
        $nilai->benar = $benar;
        $nilai->salah = $salah;
        $nilai->kosong = $kosong;
        $nilai->nilai = $nilainya;
        $nilai->save();

        return response()->json([
            'status' => 'success',
            'percobaanKe' => count($checker)+1,
            'benar'=> $benar,
            'salah'   => $salah,
            'kosong'  => $kosong,
            'nilai'   => $nilainya,
       ], 200);
    }
}
