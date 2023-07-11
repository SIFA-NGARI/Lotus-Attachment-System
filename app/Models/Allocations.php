<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocations extends Model
{
    use HasFactory;
    protected $table = 'supervisor_allocations';
    public $fillable = ['student_id', 'supervisor_id'];
}
