<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'google_id',
        'phone',
        'address',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // User memiliki satu keranjang aktif.

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // User memiliki banyak item wishlist.
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // User memiliki banyak pesanan.
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //Relasi many-to-many ke products melalui wishlists.
    public function wishlistProducts()
    {
        return $this->belongsToMany(Product::class, 'wishlists')
                    ->withTimestamps();
    }



    //Cek apakah user adalah admin.
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Cek apakah user adalah customer.
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    // Cek apakah produk ada di wishlist user.
    public function hasInWishlist(Product $product): bool
    {
        return $this->wishlists()
                    ->where('product_id', $product->id)
                    ->exists();
    }
}
