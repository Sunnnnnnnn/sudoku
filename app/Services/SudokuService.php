<?php

namespace App\Services;

use App\Models\Sudoku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class SudokuService extends Model
{

    /**
     * @var mixed
     */

    public function __construct()
    {
        parent::__construct();
    }
    public function updateContent($date)
    {
        try {
            $arr = [Sudoku::LEVEL_EASY,Sudoku::LEVEL_NORMAL,Sudoku::LEVEL_HARD,Sudoku::LEVEL_EXPERT,Sudoku::LEVEL_EXTREME];
            foreach ($arr as $level){
                $condition = [
                    'date'          => $date,
                    'level' => $level
                ];
                $sudoku = Sudoku::query()
                    ->where($condition)
                    ->first();
                if ($sudoku != false){
                    continue;
                }
                $data = $this->getContent($date,$level);
                Sudoku::insertData($data);
            }

            Log::error($date.'更新成功---');
        } catch (\Exception $e) {
            Log::error('更新失败---' . $e->getMessage());
        }
    }
    public function detail($date,$level){

    }
    public function getContent($date ='2008-01-01',$level= Sudoku::LEVEL_NORMAL)
    {
        $date_arr = explode('-',$date);
        if (count($date_arr) != 3){
            return false;
        }
        $url = 'https://www.sudokupuzzle.org/online2.php?nd='.$level.'&y='.$date_arr[0].'&m='.$date_arr['1'].'&d='.$date_arr['2'];
        $content = $this->curl_get_https($url);
        [$content,$answer,$key] = $this->decrypt($content);

        return [
            'content' =>$content,
            'answer' =>$answer,
            'key' =>$key,
            'level' => $level,
            'date' =>$date,
        ];
    }

    public function decrypt($html)
    {
        $str = substr($html,stripos($html,'tmda=\'')+6,168);

        return [substr($str,0,81),substr($str,81,81),str_replace("'",'',substr($str,-6))];
    }

    public function encryption()
    {

    }

    public function curl_get_https($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        return $tmpInfo;   //返回json对象
    }
}
