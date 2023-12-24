<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WalletService;


class WalletController extends Controller
{
    protected $WService;

    public function __construct(WalletService $walletService)
    {
        $this->WService = $walletService;
    }

    public function getBalance($user_id)
    {
        try {
            $balance = $this->WService->getBalance($user_id);
            return response()->json(['balance' => $balance]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }



    public function addMoney(Request $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|integer',
                'amount' => 'required|numeric',
            ]);

            $user_id = $request->input('user_id');
            $amount = $request->input('amount');

            $referenceId = $this->WService->addMoney($user_id, $amount);

            return response()->json(['reference_id' => $referenceId]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
