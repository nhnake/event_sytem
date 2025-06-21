<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens; // ✅ Correct
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function joinedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'event_id')
                ->withTimestamps();
    }

    public function participants(){
    return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['joined_at']);
    }

}
