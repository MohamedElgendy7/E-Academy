<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    protected $table = 'absents';

    protected $fillable = [
        'day',  'status', 'student_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function getActive()
    {
        return    $this->status == 1 ? 'حاضر' : 'غائب';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    //scopes

    // public function scopeMarked($query, $student_id, $day)
    // {
    //     return $query->where('student_id', $student_id)->where('day', $day)->where('status', 1);
    // }

    //relations
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
