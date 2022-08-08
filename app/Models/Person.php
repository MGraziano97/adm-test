<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $casts = [
        'films' => 'array',
        'species' => 'array',
        'vehicles' => 'array',
        'starships' => 'array'
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;

    public function planet() {
        return $this->hasOne(Planet::class,'url','homeworld');
    }
}
