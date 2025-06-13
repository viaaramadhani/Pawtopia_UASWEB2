<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'user_id',
        'adopter_name',
        'adopter_email',
        'adopter_phone',
        'adopter_address',
        'adopter_description',
        'adopter_instagram',
        'adopted_at',
        'status',
        'certificate_generated'
    ];

    protected $dates = [
        'adopted_at',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
