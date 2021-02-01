<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sudoku extends Model
{
    const LEVEL_EASY = 0;
    const LEVEL_NORMAL = 1;
    const LEVEL_HARD = 2;
    const LEVEL_EXPERT = 3;
    const LEVEL_EXTREME = 4;


    /**
     * 设置日期时间格式
     *
     * @var string
     */
    public $dateFormat = 'U';

    /**
     * 需要被转换日期时间格式的字段
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * 序列化
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'integer',
        'updated_at' => 'integer',
        'deleted_at' => 'integer'
    ];

    /**
     * 表名称
     *
     * @var string
     */
    protected $table = 'sudoku';


    protected $fillable = [
        'id',
        'content',
        'answer',
        'level',
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
        'key',
    ];

    /**
     * 下单错误记录
     *
     * @param $data
     */
    public static function insertData($data)
    {
        $insert_data = [
            'content' => $data['content'],
            'answer' => $data['answer'],
            'level' => $data['level'],
            'date' => $data['date'],
            'key' => $data['key'],
        ];
        return self::query()->create($insert_data);
    }

}
