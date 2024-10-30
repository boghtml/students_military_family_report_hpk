<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'military_unit',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_relative')
                    ->withPivot('relationship_type')
                    ->withTimestamps();
    }
}
