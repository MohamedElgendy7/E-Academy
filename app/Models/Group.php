<?php

namespace App\Models;

use App\Observers\GroupObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',  'active', 'super_id', 'main_category_id', 'grade_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];


    //observer link
    protected static function boot()
    {
        parent::boot();
        Group::observe(GroupObserver::class);
    }






    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'active', 'main_category_id', 'grade_id');
    }

    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }

    public function scopeSame($query, $grade_id, $main_category_id)
    {
        return $query->where('grade_id', $grade_id)->where('main_category_id', $main_category_id);
    }


    public function getActive()
    {
        return    $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }



    //relation

    public function main_category()
    {
        return $this->belongsTo(mainCategory::class, 'main_category_id', 'id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'group_id', 'id');
    }

    public function abesnt()
    {
        return $this->hasMany(Absent::class, 'group_id', 'id');
    }
}
