<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Nilai;
use Illuminate\Http\Request;

function getTokenQuiz(){
    $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $token = '';

    for ($i=0; $i < 8; $i++){
        $index = rand(0, strlen($char)-1);
        $token .= $char[$index];
    }
    return $token;
}

class ApiQuizController extends Controller
{
    public function get_quiz(){
        $quiz = Quiz::all();
        $data;
        foreach ($quiz as $q){
            $data[] = [
                'token' => $q->token,
                'mata_pelajaran'  => $q->mata_pelajaran,
                'nama_quiz' => $q->nama_quiz,
                'tag_kelas' => $q->tag_kelas,
            ];
        }
        return response()->json([
            'status' => 'success',
            'data'   => $data,
       ], 200);
    }

    public function add_quiz(Request $request){

        if (strlen($request->namaQuiz) >= 4 and strlen($request->mataPelajaran) >= 4){
            $quiz = new Quiz;
            $uniqToken = getTokenQuiz();

            $quiz->token = $uniqToken;
            $quiz->nama_quiz = $request->namaQuiz;
            $quiz->mata_pelajaran = $request->mataPelajaran;
            $quiz->tag_kelas = "";
            $quiz->timestamps = false;
            $saved = $quiz->save();

            $question = new Question;
            $question->token = $uniqToken;
            $question->question_list = "";
            $question->answer_list = "";
            $question->jawaban = "";
            $question->timestamps = false;
            $saved2 = $question->save();

            if ($saved == true and $saved2 == true){
                return response()->json([
                    'status' => 'success',
               ], 200);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message'=> 'gagal menyimpan data',
               ], 404);
            }
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=> 'panjang nama quiz dan mapel harus lebih dari 4',
           ], 404);
        }
    }

    public function delete_quiz($token){
        $saved3 = Nilai::where('tokenQuiz', $token)->delete();
        $saved = Question::where('token', $token)->delete();
        $saved2 = Quiz::destroy($token);
        if ($saved == true and $saved2 == true){
            return response()->json([
                'status' => 'success',
           ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=> 'gagal menghapus data',
           ], 404);
        }
    }
}
