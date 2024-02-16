<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmation_token',
        'confirmed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * このユーザーが持つ予約を取得
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Shop::class, 'favorites', 'user_id', 'shop_id')->withTimestamps();
    }

    public function toggleFavorite($shop_id)
    {
        $existingFavorite = $this->favorites()->where('shop_id', $shop_id)->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
        } else {
            $this->favorites()->create(['shop_id' => $shop_id]);
        }
    }

    public function isFavorite($shop_id)
    {
        return $this->favorites()->where('shop_id', $shop_id)->exists();
    }
}
