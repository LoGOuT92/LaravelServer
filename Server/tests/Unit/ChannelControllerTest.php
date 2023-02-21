<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Channel;

class ChannelControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method of ChannelController.
     *
     * @return void
     */
    public function testIndex()
    {
        $channel1 = Channel::factory()->create();
        $channel2 = Channel::factory()->create();

        $response = $this->get('http://localhost:8080/api/channels');

        $response->assertStatus(200);

        $response->assertJsonFragment(['name' => $channel1->name]);
        $response->assertJsonFragment(['name' => $channel2->name]);
    }

    /**
     * Test the store method of ChannelController.
     *
     * @return void
     */
    public function testStore()
    {
        $data = ['name' => 'Test Channel', 'value' => 5];

        $response = $this->post('http://localhost:8080/api/channels', $data);

        $response->assertStatus(201);

        $response->assertJsonFragment(['name' => $data['name']]);
        $response->assertJsonFragment(['value' => $data['value']]);
    }

    /**
     * Test the update method of ChannelController.
     *
     * @return void
     */
    public function testUpdate()
    {
        $channel = Channel::factory()->create();

        $data = ['value' => 10];

        $response = $this->put('http://localhost:8080/api/channels/' . $channel->id, $data);

        $response->assertStatus(200);

        $response->assertJsonFragment(['value' => $data['value']]);
    }

    /**
     * Test the destroy method of ChannelController.
     *
     * @return void
     */
    public function testDestroy()
    {
        $channel = Channel::factory()->create();

        $response = $this->delete('http://localhost:8080/api/channels/' . $channel->id);
        $response->assertStatus(200);

        $this->assertNull(Channel::find($channel->id));
    }
}
