<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasUuids;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'original_url',
        'slug',
        'accesses',
    ];
}
