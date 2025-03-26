<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_received', 'branch', 'description', 'quantity',
        'amount', 'total', 'date_release', 'received_by'
    ];
}
