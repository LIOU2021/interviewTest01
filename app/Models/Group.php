<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'token',
    ];

    public static function getToken()
    {
        list($ms, $timestamp) = explode(" ", microtime());
        $token = $timestamp . $ms . substr(random_int(0, 99), -2);
        return Hash::make($token);
    }

    public function users(){
        return $this->HasMany(User::class);
    }

    public function tickets(){
        return $this->hasManyThrough(Ticket::class,User::class);
    }
}
