<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SoftwareRelease;
use App\User;

class Software extends Model
{
    public function releases()
    {
        return $this->hasMany( SoftwareRelease::class, 'software_id' );
    }

    public function author()
    {
        return $this->belongsTo( User::class );
    }
}
