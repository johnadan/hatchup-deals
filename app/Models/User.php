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
        'business_id',
        'profile_picture',
        'role',
        'status',
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

    // public function business(): HasOne
    // {
    //     return $this->hasOne(Business::class);
    // }

    // public function claimedDeals(): HasMany
    // public function dealClaims(): HasMany
    // {
    //     return $this->hasMany(ClaimedDeal::class);
    //     // return $this->hasMany(DealClaim::class);
    // }

    // Relationship: A user can favorite businesses and deals
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

     // Relationship: A user (business) can have featured deals
     public function featuredDeals()
     {
         return $this->hasMany(FeaturedDeal::class, 'business_id');
     }

    // Relationship: A user can have many deals (if they are a business)
    public function deals()
    {
        return $this->hasMany(Deal::class, 'business_id');
    }

    // Relationship: A user can have many orders (if they are a customer)
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

     // Relationship: A user belongs to a business (if they are a business user)
     public function business()
     {
         return $this->belongsTo(Business::class);
     }

     // Check if the user is a business owner or manager
     public function isBusinessUser()
     {
         return $this->role === 'business' && $this->business_id !== null;
     }

     // Relationship: A user (business) has a business profile
    // public function businessProfile()
    // {
    //     return $this->hasOne(BusinessProfile::class);
    // }

    // Check if the user is a business
    // public function isBusiness()
    // {
    //     // return $this->role === 'business';
    //     return $this->role === 'business' && $this->business_id !== null;
    // }
}
