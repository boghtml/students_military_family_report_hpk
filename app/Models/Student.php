<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'group_name',
        'military_relation',
    ];

    public function relatives()
    {
        return $this->belongsToMany(Relative::class, 'student_relative')
                    ->withPivot('relationship_type')
                    ->withTimestamps();
    }
}
