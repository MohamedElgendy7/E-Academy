<?php

namespace App\Models;

use App\Observers\ExamObserver;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    //relations
    public function degrees()
    {
        return $this->hasMany(Degree::class, 'exam_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        Exam::observe(ExamObserver::class);
    }
}
