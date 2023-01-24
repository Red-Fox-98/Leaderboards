<?php

namespace Tests\Feature\Session;

use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOutputOfSessionsWasSuccessful()
    {
        /** @var Session $sessions*/
        $sessions = Session::factory()->times(100)->create();
        $map_name = $sessions[0];

        $data = [
            'map_name' => $map_name['map_name'],
            'is_record' => true,
        ];

        $this->json('get', route('sessions.index'), $data)
            ->assertJsonStructure([
                'status', 'success',
                'data' => [
                    '*' => [
                        'nickname',
                        'map_name',
                        'score']
                ],
            ]);
    }
}
