<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'number', 'expire_month', 'expire_year', 'cvv', 'type'];
}
