<?php

namespace App\Models;

use App\Observers\GradeObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'name',  'active', 'super_id', 'main_category_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];



    //observer link
    protected static function boot()
    {
        parent::boot();
        Grade::observe(GradeObserver::class);
    }



    public function getActive()
    {
        return    $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }


    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'active', 'main_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }

    public function scopeStudent($query, $student_id)
    {
        return $query->where('super_id', Student::find($student_id)->super_id);
    }




    //relations
    public function main_category()
    {
        return $this->belongsTo(mainCategory::class, 'main_category_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'grade_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'grade_id', 'id');
    }
}
