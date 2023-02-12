<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'superRole', 'ExamRole',
        'payRole', 'EditRole', 'DeleteRole', 'videoRole',
        'docRole', 'addRole', 'addStudentRole', 'owner',
        'super_id', 'addQuarterRole', 'addGradeRole', 'addGroupRole',
        'password', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }
}
