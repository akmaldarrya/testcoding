<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'location',
        'category'
    ];

    /**
     * Get the contacts for the customer.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
