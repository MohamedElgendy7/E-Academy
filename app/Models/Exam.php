<?php

namespace App\Models;

use App\Observers\ExamObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'name', 'max_degree', 'super_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];
    protected static function boot()
    {
        parent::boot();
        Exam::observe(ExamObserver::class);
    }

    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }

    //relations
    public function degrees()
    {
        return $this->hasMany(Degree::class, 'exam_id', 'id');
    }
}
