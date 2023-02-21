<?php

namespace Tests\Feature\Session;

use App\Models\Session;
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
        $mapName = 'SP';
        $sessions = Session::factory()->times(3)->create(['map_name' => $mapName]);

        $data = [
            'map_name' => $mapName,
            'is_record' => true,
        ];

        $this->json('get', route('sessions.index'), $data)
            ->assertOk()
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
