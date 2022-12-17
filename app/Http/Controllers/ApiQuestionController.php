<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use DB;
class ApiQuestionController extends Controller
{
    public function get_question($token){
        $q_dump = DB::table('question')->where('token', $token)->get();
        $question = $q_dump[0];

        $q_split = explode(",?>",$question->question_list);
        $ans_split = explode(",?>", $question->answer_list);
        $jwb_split = explode(",?>", $question->jawaban);
        
        $data;
        for ($x = 0; $x < count($q_split); $x++){
                $data[] = [
                    "question" => $q_split[$x],
                    "answer" => explode(";;;", $ans_split[$x]),
                    "jawaban" => $jwb_split[$x],
                ]; 
        }
        
        return response()->json([
            'status' => 'success',
            'data'   => $data,
       ], 200);
        
    }

    public function add_question(Request $request){
        // $question = Question::find($request->token);
        $q_dump = DB::table('question')->where('token', $request->token)->get();
        $question = $q_dump[0];
        $answer_list = $request->a.';;;'.$request->b.';;;'.$request->c.';;;'.$request->d.';;;'.$request->e;
        if (strlen($question->question_list) > 1){
            Question::where('token', $request->token)->update(['question_list' => $question->question_list.',?>'.$request->question]);
            Question::where('token', $request->token)->update(['answer_list' => $question->answer_list.',?>'.$answer_list]);
            Question::where('token', $request->token)->update(['jawaban' => $question->jawaban.',?>'.$request->jawaban]);
        }else{
            Question::where('token', $request->token)->update(['question_list' => $request->question]);
            Question::where('token', $request->token)->update(['answer_list' => $answer_list]);
            Question::where('token', $request->token)->update(['jawaban' => $request->jawaban]);
        }
        return response()->json([
            'status' => 'success',
       ], 200);
    }

    public function delete_question(Request $request){
        $q_dump = DB::table('question')->where('token', $request->token)->get();
        $question = $q_dump[0];

        $q_split = explode(",?>",$question->question_list);
        $ans_split = explode(",?>", $question->answer_list);
        $jwb_split = explode(",?>", $question->jawaban);
        
        $data;
        for ($x = 0; $x < count($q_split); $x++){
                $data[] = [
                    "question" => $q_split[$x],
                    "answer" => explode(";;;", $ans_split[$x]),
                    "jawaban" => $jwb_split[$x],
                ]; 
        }
        
        array_splice($data, $request->num,1);

        $q_fix = "";
        $ans_fix = "";
        $jwb_fix = "";
        for ($x = 0; $x < count($data); $x++){
            $q_fix .=  $data[$x]["question"].",?>";
            for ($y = 0; $y < 5; $y++){
                $ans_fix .= $data[$x]["answer"][$y].";;;";
                if ($y == 4){
                    $ans_fix = substr($ans_fix, 0, strlen($ans_fix)-3);
                }
            }
            $ans_fix .= ",?>";
            $jwb_fix .= $data[$x]["jawaban"].",?>";
        }
        $q_fix = substr($q_fix, 0, strlen($q_fix)-3);
        $ans_fix = substr($ans_fix, 0, strlen($ans_fix)-3);
        $jwb_fix = substr($jwb_fix, 0, strlen($jwb_fix)-3);

        Question::where('token', $request->token)->update(['question_list' => $q_fix]);
        Question::where('token', $request->token)->update(['answer_list' => $ans_fix]);
        Question::where('token', $request->token)->update(['jawaban' => $jwb_fix]);

        return response()->json([
            'status' => 'success',
       ], 200);
    }
}
