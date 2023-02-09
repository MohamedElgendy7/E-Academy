<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cash extends Model
{
    protected $table = 'cashs';


    protected $fillable = [
        'month',  'paid', 'super_id', 'student_id',  'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];



    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
