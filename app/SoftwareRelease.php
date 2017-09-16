<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Software;

class SoftwareRelease extends Model
{
    public function release()
    {
        return $this->belongsTo( Software::class );
    }
}
