<?php

namespace App\Models;

use App\Observers\StudentObserver;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Students';

    protected $fillable = [
        'name', 'number', 'active', 'group_id', 'Parentnumber', 'main_category_id',  'grade_id', 'created_at', 'updated_at',
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();
        Student::observe(StudentObserver::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSame($query, $grade_id, $mainCategory_id, $group_id)
    {
        return $query->where('grade_id', $grade_id)->where('main_category_id', $mainCategory_id)->where('group_id', $group_id);
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'number', 'active', 'group_id', 'main_category_id',  'grade_id',);
    }

    public function scopeParents($query, $mainCategory_id, $grade_id, $group_id)
    {
        return $query->where('main_category_id', $mainCategory_id)->where('grade_id', $grade_id)->where('group_id', $group_id);
    }

    public function getActive()
    {
        return    $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    //relation

    //get main_category of sub category
    public function mainCategory()
    {
        return $this->belongsTo(mainCategory::class, 'main_category_id', 'id');
    }

    public function groups()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function absent()
    {
        return $this->hasMany(Absent::class, 'student_id', 'id');
    }

    public function degree()
    {
        return $this->hasMany(Degree::class, 'student_id', 'id');
    }

    public function cash()
    {
        return $this->hasMany(Cash::class, 'student_id', 'id');
    }
}
