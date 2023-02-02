<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degrees';

    protected $fillable = [
        'degree', 'exam_id', 'group_id', 'student_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeSelection($query, $student_id, $exam_id)
    {
        return $query->where('student_id', $student_id)->where('exam_id', $exam_id);
    }


    //relations 
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
