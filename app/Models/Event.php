<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Category;


class Event extends Model
{
    protected $fillable = ['title', 'description', 'date', 'location', 'organizer_id', 'category_id'];
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id')
                    ->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
