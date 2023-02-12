<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'body', 'answer_of', 'degree', 'status',
        'Exam_id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
