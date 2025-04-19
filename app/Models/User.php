<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',         // User's unique username
        'first_name',       // User's first name
        'last_name',        // User's last name
        'name',             // Full name of the user
        'email',            // User's email address
        'password',         // User's hashed password
        'email_verified_at', // Timestamp of email verification
        'is_locked',        // Whether the user's account is locked
        'is_active',        // Whether the user's account is active
        'is_suspended',     // Whether the user's account is suspended
        'is_admin',         // Whether the user has admin privileges
        'verification_code', // Code for email verification
    ];

    protected $dates = ['deleted_at'];

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

    /**
     * Sort the user entries by their id.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortedBy(Builder $query)
    {
        // Sort the user entries by their id. The Failed id is given priority
        return $query
            ->orderBy('created_at', 'asc');
    }

    /**
     * Determine if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->is_admin == 1;
    }

    /**
     * Determine if the user is a client.
     */
    public function isClient()
    {
        return $this->is_admin == 0;
    }

    /**
     * Set first_name attribute as capitalized.
     *
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    /**
     * Set last_name attribute as capitalized.
     *
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    /**
     * Get the profile associated with this user.
     *
     * @return HasOne<Profile>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
