<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'description',
        'category',
        'ras',
        'status',
        'photo'
    ];

    protected $attributes = [
        'status' => 'available'
    ];

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
