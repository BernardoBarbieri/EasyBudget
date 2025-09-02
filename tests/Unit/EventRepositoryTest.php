<?php
namespace Tests\Unit;

use Tests\TestCase; use Illuminate\Foundation\Testing\RefreshDatabase; use App\Repositories\Eloquent\EloquentEventRepository; use App\Models\User;

class EventRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_and_find_event(): void{
        $repo = new EloquentEventRepository();
        $user = User::factory()->create();
        $event = $repo->create(['user_id'=>$user->id,'title'=>'Teste','date'=>now()->toDateString(),'location'=>'BH','guests'=>10]);
        $found = $repo->find($event->id);
        $this->assertNotNull($found);
        $this->assertEquals('Teste',$found->title);
    }
}
