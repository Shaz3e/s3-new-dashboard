<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'gender',
        'dob',
        'phone',
        'country',
        'state',
        'city',
        'zipcode',
        'address',
        'id_type',
        'id_number',
        'id_front',
        'id_back',
        'id_address_proof',
        'issue_date',
        'expiry_date',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'date',         // Date of birth
            'issue_date' => 'date',  // Date the document was issued
            'expiry_date' => 'date', // Date the document expires
        ];
    }

    /**
     * The user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
