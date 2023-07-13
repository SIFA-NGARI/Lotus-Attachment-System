<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisations extends Model
{
    use HasFactory;
    protected $table = 'applications';

    protected $fillable = [
        'name',
        'address_address',
        'address_latitude',
        'address_longitude',
        'student_id',
        'org_name',
        'description',
        'date',
        'hours',
        'activities',
        'skills',
        'status',
        'type',
    ];
}
