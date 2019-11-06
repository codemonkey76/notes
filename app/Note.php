<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    protected $guarded = [];
    protected $casts = [
        'time' => 'integer',
        'status' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return url('/contacts/' . $this->id);
    }

}
