<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
    ];

    public function department()
    {
        return $this->hasOne(Department::class);
    }
}
