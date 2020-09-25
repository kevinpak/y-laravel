<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];


    // category of employee
    public function category(){
        return $this->belongsTo("App\Models\EmployeeCategorie", "employee_categorie_id");
    }
}
