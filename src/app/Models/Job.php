<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'active',
        'type',
        'salary',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function apllicants(): BelongsToMany
    {
        return $this->belongsToMany(Applicant::class);
    }
}
