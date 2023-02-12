<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'link', 'cap', 'active', 'super_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = Str::after(Str::limit($value, 43, ''), 'watch?v=');
    }

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
