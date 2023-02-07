<?php

namespace App\Models;

use App\Observers\ExamObserver;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'max_degree', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];
    protected static function boot()
    {
        parent::boot();
        Exam::observe(ExamObserver::class);
    }

    //relations
    public function degrees()
    {
        return $this->hasMany(Degree::class, 'exam_id', 'id');
    }
}
