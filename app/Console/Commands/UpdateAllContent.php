<?php
/**
 * Created by PhpStorm.
 * User: wpf
 * Date: 19-3-21
 * Time: 下午9:26
 */

namespace App\Console\Commands;

use App\Models\Sudoku;
use App\Services\SudokuService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateAllContent extends Command
{
    /**
     * @var string
     */
    protected $signature = 'auto:update-all-content';

    /**
     * @var string
     */
    protected $description = '更新所有题目及答案';

    /**
     * @var SudokuService
     */
    private $sudokuService;

    /**
     * Create a new command instance.
     * @param SudokuService $sudokuService
     */
    public function __construct(SudokuService $sudokuService)
    {

        $this->sudokuService = $sudokuService;
        parent::__construct();
    }

    /**
     * 定时任务执行逻辑
     */
    public function handle()
    {

        $start_at = '2008-01-01';
        $date = date("Y-m-d");
        while ($start_at != $date){
            $this->sudokuService->updateContent($start_at);
            $start_at = date('Y-m-d',strtotime($date) + 3600*24);
        }


        return true;
    }







}
