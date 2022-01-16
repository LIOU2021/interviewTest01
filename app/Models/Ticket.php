<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    private $_status = ["1" => "not resolve", "2" => "resolve",];
    private $_type = ["1" => "bug", "2" => "feature request", "3" => "test case",];
    private $_severity= ["1" => "一般", "2" => "嚴重", "3" => "極為嚴重",];
    private $_priority= ["1" => "普通", "2" => "次要", "3" => "優先",];
    
    protected $fillable = [
        'user_id',
        'summary',
        'description',
        'status',
        'severity',
        'priority',
        'type',
        'group_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    public function getStatus()
    {
        return $this->_status[$this->status];
    }

    public function getType()
    {
        return $this->_type[$this->type];
    }
    
    public function getSeverity()
    {
        return $this->_severity[$this->severity];
    }

    public function getPriority()
    {
        return $this->_priority[$this->priority];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(group::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
