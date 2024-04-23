<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;
    public function incomingCashflows()
    {
        return $this->hasMany(Cashflow::class, 'to_account_id');
    }

    public function outgoingCashflows()
    {
        return $this->hasMany(Cashflow::class, 'from_account_id');
    }
}
