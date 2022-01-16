<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private $userType = [
        '1' => 'QA',
        '2' => 'RD',
        '3' => 'PM',
        '4' => 'Administrator',
    ];

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'group_id',
        'verify',
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

    public function getToken()
    {
        return Group::find($this->group_id)->token;
    }

    public function getUserType()
    {
        return $this->userType[$this->type];
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function canCreateBug()
    {
        $type = $this->type;
        if ($type == '1' || $type == '4') {
            return true;
        }
        return false;
    }

    public function canEditBug()
    {
        $type = $this->type;
        if ($type == '1' || $type == '4') {
            return true;
        }
        return false;
    }

    public function canDeleteBug()
    {
        $type = $this->type;
        if ($type == '1' || $type == '4') {
            Log::debug('yes');
            return true;
        }
        Log::debug('no');
        return false;
    }

    public function canResolveBug()
    {
        $type = $this->type;
        if ($type == '2' || $type == '4') {
            return true;
        }
        return false;
    }

    public function canCreateTestCase()
    {
        $type = $this->type;
        if ($type == '1' || $type == '4') {
            return true;
        }
        return false;
    }

    public function canResolveTestCase()
    {
        $type = $this->type;
        if ($type == '1' || $type == '4') {
            return true;
        }
        return false;
    }

    public function canCreateFeatureRequest()
    {
        $type = $this->type;
        if ($type == '3' || $type == '4') {
            return true;
        }
        return false;
    }

    public function canResolveFeatureRequest()
    {
        $type = $this->type;
        if ($type == '2' || $type == '4') {
            return true;
        }
        return false;
    }
}
