<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Actor;

class ActorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the form page loads correctly.
     */
    public function test_form_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Actor Information Submission');
        $response->assertSee('Email Address');
        $response->assertSee('Actor Description');
    }

    /**
     * Test that the submissions page loads correctly.
     */
    public function test_submissions_page_loads(): void
    {
        $response = $this->get('/actors');

        $response->assertStatus(200);
        $response->assertSee('Actor Submissions');
    }

    /**
     * Test form validation for required fields.
     */
    public function test_form_validation_requires_email_and_description(): void
    {
        $response = $this->post('/actors', []);

        $response->assertSessionHasErrors(['email', 'description']);
    }

    /**
     * Test email validation.
     */
    public function test_email_must_be_valid(): void
    {
        $response = $this->post('/actors', [
            'email' => 'invalid-email',
            'description' => 'This is a valid description with enough characters.'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test description minimum length validation.
     */
    public function test_description_must_be_minimum_length(): void
    {
        $response = $this->post('/actors', [
            'email' => 'test@example.com',
            'description' => 'Short'
        ]);

        $response->assertSessionHasErrors(['description']);
    }

    /**
     * Test API endpoint returns correct response.
     */
    public function test_prompt_validation_api_endpoint(): void
    {
        $response = $this->get('/api/actors/prompt-validation');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'text_prompt'
        ]);
    }

    /**
     * Test that actor can be created with valid data.
     */
    public function test_actor_can_be_created(): void
    {
        $actorData = [
            'email' => 'test@example.com',
            'description' => 'John Doe is a 30-year-old actor from New York City.',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => 'New York City',
            'height' => '6 feet',
            'weight' => '180 lbs',
            'gender' => 'Male',
            'age' => 30
        ];

        $actor = Actor::create($actorData);

        $this->assertDatabaseHas('actors', [
            'email' => 'test@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);
    }

    /**
     * Test email uniqueness validation.
     */
    public function test_email_must_be_unique(): void
    {
        Actor::create([
            'email' => 'test@example.com',
            'description' => 'First actor description',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => 'New York'
        ]);

        $response = $this->post('/actors', [
            'email' => 'test@example.com',
            'description' => 'Second actor description with enough characters.'
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
