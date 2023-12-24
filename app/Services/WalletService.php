<?php
namespace App\Services;

use App\Models\User;
use App\Models\Transaction;

class WalletService {
    
    public function getBalance($user_id){
        $user = User::findOrFail($user_id);
        $wallet = $user->wallet;
        
        return $wallet->balance;
    }
}