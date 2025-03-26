<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['date_received', 'branch', 'description', 'quantity', 'amount', 'total', 'date_release', 'received_by'];

}
