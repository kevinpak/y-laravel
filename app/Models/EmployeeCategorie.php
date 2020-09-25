<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCategorie extends Model
{
    use HasFactory;

    protected $guarded = [];


    // all employee by category
    public function employees() {
        return $this->belongsToMany("App\Models\Employee");
    }
}
