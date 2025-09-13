<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ActorService;
use App\Models\Actor;

class ActorServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $actorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actorService = new ActorService();
    }

    /**
     * Test form validation with valid data
     */
    public function test_validate_form_data_with_valid_data(): void
    {
        $data = [
            'email' => 'test@example.com',
            'description' => 'This is a valid description with enough characters.'
        ];

        $validator = $this->actorService->validateFormData($data);

        $this->assertFalse($validator->fails());
    }

    /**
     * Test form validation with invalid data
     */
    public function test_validate_form_data_with_invalid_data(): void
    {
        $data = [
            'email' => 'invalid-email',
            'description' => 'Short'
        ];

        $validator = $this->actorService->validateFormData($data);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
    }

    /**
     * Test validate extracted data with valid data
     */
    public function test_validate_extracted_data_with_valid_data(): void
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => 'New York City',
            'height' => '6 feet',
            'weight' => '180 lbs',
            'gender' => 'Male',
            'age' => 30
        ];

        $result = $this->actorService->validateExtractedData($data);

        $this->assertTrue($result);
    }

    /**
     * Test validate extracted data with missing required fields
     */
    public function test_validate_extracted_data_with_missing_required_fields(): void
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '', // Empty address
            'height' => '6 feet'
        ];

        $result = $this->actorService->validateExtractedData($data);

        $this->assertFalse($result);
    }

    /**
     * Test validate extracted data with null data
     */
    public function test_validate_extracted_data_with_null_data(): void
    {
        $result = $this->actorService->validateExtractedData(null);

        $this->assertFalse($result);
    }

    /**
     * Test get all actors
     */
    public function test_get_all_actors(): void
    {
        // Create test actors
        Actor::create([
            'email' => 'actor1@example.com',
            'description' => 'First actor description',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => 'New York'
        ]);

        Actor::create([
            'email' => 'actor2@example.com',
            'description' => 'Second actor description',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'address' => 'Los Angeles'
        ]);

        $actors = $this->actorService->getAllActors();

        $this->assertCount(2, $actors);
        
        // Check that both actors are present (order may vary due to timing)
        $firstNames = $actors->pluck('first_name')->toArray();
        $this->assertContains('John', $firstNames);
        $this->assertContains('Jane', $firstNames);
    }

    /**
     * Test get actor by email
     */
    public function test_get_actor_by_email(): void
    {
        Actor::create([
            'email' => 'test@example.com',
            'description' => 'Test actor description',
            'first_name' => 'Test',
            'last_name' => 'Actor',
            'address' => 'Test City'
        ]);

        $actor = $this->actorService->getActorByEmail('test@example.com');

        $this->assertNotNull($actor);
        $this->assertEquals('Test', $actor->first_name);
    }

    /**
     * Test get actor by email when not found
     */
    public function test_get_actor_by_email_when_not_found(): void
    {
        $actor = $this->actorService->getActorByEmail('nonexistent@example.com');

        $this->assertNull($actor);
    }

    /**
     * Test get actor by ID
     */
    public function test_get_actor_by_id(): void
    {
        $createdActor = Actor::create([
            'email' => 'test@example.com',
            'description' => 'Test actor description',
            'first_name' => 'Test',
            'last_name' => 'Actor',
            'address' => 'Test City'
        ]);

        $actor = $this->actorService->getActorById($createdActor->id);

        $this->assertNotNull($actor);
        $this->assertEquals($createdActor->id, $actor->id);
    }
}
