<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function trash()
    {
        return $this->hasMany(Trash::class);
    }
    public function calenderalert()
    {
        return $this->hasMany(CalenderAlert::class);
    }
    public function messages()
    {
        return $this->hasMany(Enquiry::class, 'user_id');
    }
    public function getLastMessage()
    {
        $userId = $this->id;

        return Enquiry::where(function ($query) use ($userId) {
            $query->where('receiver_id', $userId)
                ->orWhere('sender_id', $userId);
        })->latest()->first();
    }
}
