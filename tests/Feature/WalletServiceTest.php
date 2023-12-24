<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletServiceTest extends TestCase
{
    use RefreshDatabase;

    protected WalletService $WService;

    protected function setUp(): void{
        parent:setUp();
        $this->WService = app(WalletService::class);

    }
    public function test_Get_Balance_For_User()
    {
        $user = User::factory()->create(['id' => 1]);
        $user->wallet()->create(['balance' => 500]);

        $balance = $this->WService->getBalance($user->id);

        $this->assertEquals(500, $balance);
    }
    
    public function test_Add_Money_To_User_Wallet(){
        $user = User::factory()->create(['id'=>2]);
        $refrenceId = $this->WService->addMoney($user->id, 1000);
        $balance = $this->WService->getBalance($user->id);
    }
    
}
