<?php
namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use \Illuminate\Support\Str;

class WalletService {
        
    /**
     * getBalance
     *
     * @param  int $user_id
     * @return int balance 
     */
    public function getBalance($user_id){
        $user = User::findOrFail($user_id);
        $wallet = $user->wallet;
        
        return $wallet->balance;
    }


        
    /**
     * addMoney
     *
     * @param  int $user_id
     * @param  int $amount
     * @return int refrence id 
     */
    public function addMoney($user_id, $amount)
    {
        $user = User::findOrFail($user_id);

        if (!$user->wallet) {
            $user->wallet()->create(['balance' => 0]);
        }

        $transaction = new Transaction([
            'user_id' => $user_id,
            'amount' => $amount,
            'reference_id' => $this->generateReferenceId(),
        ]);

        $transaction->save();

        $wallet = $user->wallet;
        $wallet->balance += $amount;
        $wallet->save();

        return $transaction->reference_id;
    } 

    /**
     * generateReferenceId
     *
     * @return mix $uuid as RefrenceId
     */
    protected function generateReferenceId()
    {
        return Str::uuid()->toString();
    }

}