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

class UpdateContent extends Command
{
    /**
     * @var string
     */
    protected $signature = 'auto:update-content';

    /**
     * @var string
     */
    protected $description = '更新题目及答案';

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


        $date = date("Y-m-d");
        $this->sudokuService->updateContent($date);
        return true;
    }







}
