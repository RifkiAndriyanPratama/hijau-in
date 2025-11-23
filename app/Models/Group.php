<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','description','created_by'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Group $group) {
            if (empty($group->slug) && !empty($group->name)) {
                $group->slug = str_replace(' ', '-', strtolower(trim($group->name)));
            }
            if (empty($group->created_by) && auth()->check()) {
                $group->created_by = auth()->id();
            }
        });

        static::created(function (Group $group) {
            // Attach creator as admin of the group if exists and not already attached
            if ($group->created_by) {
                $creatorId = $group->created_by;
                if (! $group->users()->where('user_id', $creatorId)->exists()) {
                    $group->users()->attach($creatorId, ['is_admin' => true]);
                } else {
                    // Ensure pivot is_admin true
                    $group->users()->updateExistingPivot($creatorId, ['is_admin' => true]);
                }
            }
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('is_admin');
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('is_admin')->wherePivot('is_admin', true);
    }

    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class);
    }
}
