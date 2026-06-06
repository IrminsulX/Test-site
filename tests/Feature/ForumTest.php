<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ForumThread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForumTest extends TestCase
{
    use RefreshDatabase;

    public function test_forum_index_loads(): void
    {
        $response = $this->get('/forum');
        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_create_thread(): void
    {
        $response = $this->post('/forum', [
            'title' => 'Test Thread',
            'body' => 'Test body',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_thread(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/forum', [
            'title' => 'Test Thread',
            'body' => 'Test body content',
            'category' => 'general',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('forum_threads', [
            'title' => 'Test Thread',
            'user_id' => $user->id,
        ]);
    }

    public function test_thread_owner_can_delete_thread(): void
    {
        $user = User::factory()->create();
        $thread = ForumThread::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/forum/{$thread->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('forum_threads', ['id' => $thread->id]);
    }

    public function test_non_owner_cannot_delete_thread(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $thread = ForumThread::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($other)->delete("/forum/{$thread->id}");
        $response->assertStatus(403);
    }
}
