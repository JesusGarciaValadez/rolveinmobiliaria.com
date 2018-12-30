<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\RoleType;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_visit_the_client_section(): void
    {
        $superAdminRole = factory(Role::class)
        ->create(['name' => RoleType::SUPER_ADMIN])
        ->id;

        $superAdmin = factory(User::class)
        ->create(['role_id' => $superAdminRole]);

        $this->actingAs($superAdmin)
        ->get(route('client.index'))
        ->assertSuccessful()
        ->assertSee('Clientes');
    }

    /** @test */
    public function test_admins_can_visit_the_client_section(): void
    {
        $adminRole = factory(Role::class)
        ->create(['name' => RoleType::ADMIN])
        ->id;

        $admin = factory(User::class)
        ->create(['role_id' => $adminRole]);

        $this->actingAs($admin)
        ->get(route('client.index'))
         // ->assertSuccessful()
        ->assertSee('Clientes');
    }

    /** @test */
    public function test_assistants_can_visit_the_client_section(): void
    {
        $assistantRole = factory(Role::class)
        ->create(['name' => RoleType::ASSISTANT])
        ->id;

        $assistant = factory(User::class)
        ->create(['role_id' => $assistantRole]);

        $this->actingAs($assistant)
        ->get(route('client.index'))
         // ->assertSuccessful()
        ->assertSee('Clientes');
    }

    /** @test */
    public function test_sales_can_visit_the_client_section(): void
    {
        $salesRole = factory(Role::class)
        ->create(['name' => RoleType::SALES])
        ->id;

        $sales = factory(User::class)
        ->create(['role_id' => $salesRole]);

        $this->actingAs($sales)
        ->get(route('client.index'))
         // ->assertSuccessful()
        ->assertSee('Clientes');
    }

    /** @test */
    public function test_interns_cannot_visit_the_client_section(): void
    {
        $internRole = factory(Role::class)
        ->create(['name' => RoleType::INTERN])
        ->id;

        $intern = factory(User::class)
        ->create(['role_id' => $internRole]);

        $this->actingAs($intern)
        ->get(route('client.index'))
         // ->assertStatus(Response::HTTP_FORBIDDEN)
        ->assertDontSeeText('Clientes');
    }

    /** @test */
    public function test_client_cannot_visit_the_client_section(): void
    {
        $clientRole = factory(Role::class)
        ->create(['name' => RoleType::CLIENT])
        ->id;

        $client = factory(User::class)
        ->create(['role_id' => $clientRole]);

        $this->actingAs($client)
        ->get(route('client.index'))
         // ->assertStatus(Response::HTTP_FORBIDDEN)
        ->assertDontSeeText('Clientes');
    }
}
