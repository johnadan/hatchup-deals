<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'display_name',
        'phone_number',
        'category_id',
        'profile_picture',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function deals(): BelongsToMany
    // {
    //     return $this->belongsToMany(Deal::class, 'customer_deal')->withPivot('purchase_date', 'quantity'); // Access pivot data
    // }

    // public function businesses(): HasMany
    // {
    //     return $this->hasMany(Business::class);
    // }

    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }

    // public function claimedDeals(): HasMany
    public function dealClaims(): HasMany
    {
        return $this->hasMany(ClaimedDeal::class);
        // return $this->hasMany(DealClaim::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
}
