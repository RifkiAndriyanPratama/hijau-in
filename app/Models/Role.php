<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_role'
    ];

    public function setNamaRoleAttribute($value): void
    {
        $this->attributes['nama_role'] = ucfirst(strtolower(trim($value)));
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
