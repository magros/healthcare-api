<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
      'tax_id',
      'business_name',
      'address',
      'postal_code',
      'province',
      'email',
      'invoice_reason',
      'payment_method'
    ];

    public function patient()
    {
      return $this->belongsTo(User::class);
    }
}