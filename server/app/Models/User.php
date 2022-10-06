<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{
 
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    protected $fillable = ['name', 'email', 'password', 'is_email_verified'];
    public $timestamps = true;

    protected $hidden = [
        'password',
        'remember_token'
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function todo(){
        return $this->hasOne(Todo::class)->latestOfMany();
    }
}
