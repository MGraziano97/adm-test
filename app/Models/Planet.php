<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $casts = [
        'residents' => 'array',
        'films' => 'array',
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;
}
