<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'subscriptions';

    protected $fillable = [
        'code',
        'name',
        'price',
        'branch_limit',
        'user_limit',
        'features',
        'duration_in_days',
        'status',
    ];

    /**
     * Get the subscription histories for the subscription.
     */
    public function subscriptionHistories(): HasMany
    {
        return $this->hasMany(SubscriptionHistory::class);
    }
}
