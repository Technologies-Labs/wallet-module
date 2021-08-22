<?php

namespace Modules\WalletModule\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hasBalance($amount) : bool
    {
        return  $this->balance >= $amount;
    }

    public function walletWithdraw($amount)
    {
        $this->balance -= $amount;
        $this->save();
    }

    public function withdraw($amount)
    {
        if (!$this->hasBalance($amount))
        {
            return response()->json([
                'success'       => false,
                'message'       => 'Your Balance is Not Enough',
            ]);
        }
        $this->walletWithdraw($amount);

        return response()->json([
            'success'       => true,
            'message'       => 'Done',
        ]);
    }

    public function deposit($amount)
    {
        $this->balance += $amount;
        return response()->json([
            'success'       => true,
            'message'       => 'Done',
        ]);
    }
}
