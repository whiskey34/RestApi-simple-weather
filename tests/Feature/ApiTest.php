<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

use App\Models\Weather;
use App\Models\Location;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_can_get_weather()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', '/api/weather');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody()->getContents());
    }


    public function test_can_create_weather()
    {
        $location = Location::factory()->create();
        $data = [
            // 'location_id' => $this->faker->numberBetween(4, 6),
            'location_id' => $location->id,
            'humidity' => $this->faker->numberBetween(0, 100),
            'wind_speed' => $this->faker->numberBetween(0, 50),
            'temperature' => $this->faker->numberBetween(-20, 40),
            'description' => $this->faker->sentence,
        ];


        $response = $this->postJson('/api/weather', $data);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson($data);
    }

    public function test_can_update_weather()
    {
        $weather = Weather::factory()->create();

        $data = [
            'location_id' => $this->faker->numberBetween(4, 6),
            'humidity' => $this->faker->numberBetween(0, 100),
            'wind_speed' => $this->faker->numberBetween(0, 50),
            'temperature' => $this->faker->numberBetween(-20, 40),
            'description' => $this->faker->sentence,
        ];

        $response = $this->putJson('/api/weather/' . $weather->id, $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($data);
    }

    public function test_can_delete_weather()
    {
        $weather = Weather::factory()->create();

        $response = $this->deleteJson('/api/weather/' . $weather->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
