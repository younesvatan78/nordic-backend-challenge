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
}
