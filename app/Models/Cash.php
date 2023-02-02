<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $table = 'cashs';


    protected $fillable = [
        'month',  'paid', 'student_id',  'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
