<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Doc extends Model
{
    protected $table = 'docs';

    protected $fillable = [
        'link', 'name', 'grade_id', 'super_id',  'active', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function getActive()
    {
        return    $this->active == 1 ? 'مفعل' : 'غير مفعل';
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
}
