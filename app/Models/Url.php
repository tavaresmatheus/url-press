<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $original_url
 * @property string $slug
 * @property int $accesses
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
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
