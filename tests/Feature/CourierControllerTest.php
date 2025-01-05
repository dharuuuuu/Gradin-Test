<?php

namespace Tests\Feature;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_couriers()
    {
        Courier::factory()->create(['name' => 'John Doe', 'level' => 2]);

        $response = $this->get('/couriers');

        $response->assertStatus(200);
        $response->assertSee('John Doe');
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/couriers/create');

        $response->assertStatus(200);
        $response->assertSee('Add New Courier');
    }

    // Test: Data kurir berhasil disimpan
    public function test_store_saves_courier()
    {
        $data = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '1234567890',
            'level' => 3,
        ];

        $response = $this->post('/couriers', $data);

        $response->assertRedirect('/couriers');
        $this->assertDatabaseHas('couriers', $data);
    }

    public function test_show_displays_courier_details()
    {
        $courier = Courier::factory()->create(['name' => 'John Doe']);

        $response = $this->get('/couriers/' . $courier->id);

        $response->assertStatus(200);
        $response->assertSee('John Doe');
    }

    public function test_edit_displays_form()
    {
        $courier = Courier::factory()->create(['name' => 'John Doe']);

        $response = $this->get('/couriers/' . $courier->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit Courier');
        $response->assertSee($courier->name);
    }

    public function test_update_edits_courier()
    {
        $courier = Courier::factory()->create();

        $data = [
            'name' => 'Updated Courier',
            'email' => 'updated@example.com',
            'phone' => '0987654321',
            'level' => 4,
        ];

        $response = $this->put('/couriers/' . $courier->id, $data);

        $response->assertRedirect('/couriers');
        $this->assertDatabaseHas('couriers', $data);
    }

    public function test_destroy_deletes_courier()
    {
        $courier = Courier::factory()->create();

        $response = $this->delete('/couriers/' . $courier->id);

        $response->assertRedirect('/couriers');
        $this->assertDatabaseMissing('couriers', ['id' => $courier->id]);
    }

    public function test_store_shows_error_for_duplicate_email()
    {
        Courier::factory()->create(['email' => 'existing@example.com']);

        $response = $this->post('/couriers', [
            'name' => 'Duplicate Email',
            'email' => 'existing@example.com',
            'phone' => '1234567890',
            'level' => 2,
        ]);

        $response->assertSessionHasErrors(['email' => 'The email address is already in use. Please use a different email.']);
    }
}
