<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Month extends Model
{
    protected $table = 'months';

    protected $fillable = [
        'name', 'active', 'super_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }
}
