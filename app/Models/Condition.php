<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    /** @use HasFactory<\Database\Factories\ConditionFactory> */
    use HasFactory;
    // この3つのフィールドは変更を許可する、という意味
    protected $fillable = [
        'recorded_date',  // 記録日
        'is_high',       // 高まっているかどうか
        'condition'      // 体調状態
    ];
}
