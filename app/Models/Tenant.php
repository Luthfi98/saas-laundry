<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'address',
        'logo',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the tenant's status.
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        return $this->attributes['status'] ?? 'active';
    }

    /**
     * Get the branches for the tenant.
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    /**
     * Get the subscription histories for the tenant.
     */
    public function subscriptionHistories(): HasMany
    {
        return $this->hasMany(SubscriptionHistory::class);
    }
}
