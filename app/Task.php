<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// TasksテーブルにはTaskモデルでアクセスする（1対1）
class Task extends Model
{
    protected $fillable = ['content', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
