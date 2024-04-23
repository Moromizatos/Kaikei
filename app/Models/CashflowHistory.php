<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashflowHistory extends Model
{
    use HasFactory;
    public function fromAccount()
    {
        return $this->belongsTo(Accounts::class, 'from_account_id');
    }

    public function toAccount()
    {
        return $this->belongsTo(Accounts::class, 'to_account_id');
    }
}
