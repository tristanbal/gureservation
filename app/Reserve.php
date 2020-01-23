<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    //

    //protected $fillable = ['roomPerSetupID','reserveStartDate','reserveEndDate','pax'];
    protected $table = 'reservations';
}
