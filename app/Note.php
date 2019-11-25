<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    public const STATUS = [
        1 => 'open', // Something needs to be done
        2 => 'pending', // Waiting for the customer to do something
        3 => 'solved' // No action required
    ];
    protected $guarded = [];
    protected $casts = [
        'time' => 'integer',
        'status' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function path()
    {
        return url('/contacts/' . $this->id);
    }

    public function getStatusId($status)
    {
        return array_search($status, self::STATUS);
    }

    public function getStatusAttribute()
    {
        return self::STATUS[$this->attributes['status']];
    }
    public function setStatusAttribute($value)
    {
        $statusId = self::getStatusId($value);

        if ($statusId) {
            $this->attributes['status'] = $statusId;
        }
    }

    public function getStatusIdAttribute()
    {
        return $this->attributes['status'];
    }

}
