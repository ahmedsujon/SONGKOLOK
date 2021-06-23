<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function employeeWithStatus()
    {
        return $this->employees()->where([
            'status' => 1
        ])
            ->orderBy('created_at', 'DESC');
    }

}
