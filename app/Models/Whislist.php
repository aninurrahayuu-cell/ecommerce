<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Wishlist;
use App\Models\Order;

class User extends Authenticatable
{
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}

