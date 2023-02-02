<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';

    protected $fillable = [
        'name', 'active', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
