<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Role;
use Symfony\Component\HttpFoundation\Response;

class CallTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function super_admin_can_visit_the_call_section()
  {
    $superAdminRole = factory(Role::class)
                        ->create(['name' => 'Super Administrador'])
                        ->id; // id 1
    $adminRole = factory(Role::class)
                  ->create(['name' => 'Administrador'])
                  ->id; // id 2
    $assistantRole = factory(Role::class)
                      ->create(['name' => 'Asistente'])
                      ->id; // id 3
    $salesRole = factory(Role::class)
                  ->create(['name' => 'Ventas'])
                  ->id; // id 4
    $internRole = factory(Role::class)
                    ->create(['name' => 'Pasante'])
                    ->id; // id 5
    $clientRole = factory(Role::class)
                    ->create(['name' => 'Cliente'])
                    ->id; // id 6

    $superAdmin = factory(User::class)
                    ->create(['role_id' => $superAdminRole]);

    $this->actingAs($superAdmin)
         ->get(route('call_trackings'))
         ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function admins_can_visit_the_call_section()
  {
    $superAdminRole = factory(Role::class)
                        ->create(['name' => 'Super Administrador'])
                        ->id; // id 1
    $adminRole = factory(Role::class)
                  ->create(['name' => 'Administrador'])
                  ->id; // id 2
    $assistantRole = factory(Role::class)
                      ->create(['name' => 'Asistente'])
                      ->id; // id 3
    $salesRole = factory(Role::class)
                  ->create(['name' => 'Ventas'])
                  ->id; // id 4
    $internRole = factory(Role::class)
                    ->create(['name' => 'Pasante'])
                    ->id; // id 5
    $clientRole = factory(Role::class)
                    ->create(['name' => 'Cliente'])
                    ->id; // id 6

    $admin = factory(User::class)
                    ->create(['role_id' => $adminRole]);

    $this->actingAs($admin)
         ->get(route('call_trackings'))
         ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function assistants_can_visit_the_call_section()
  {
    $superAdminRole = factory(Role::class)
                        ->create(['name' => 'Super Administrador'])
                        ->id; // id 1
    $adminRole = factory(Role::class)
                  ->create(['name' => 'Administrador'])
                  ->id; // id 2
    $assistantRole = factory(Role::class)
                      ->create(['name' => 'Asistente'])
                      ->id; // id 3
    $salesRole = factory(Role::class)
                  ->create(['name' => 'Ventas'])
                  ->id; // id 4
    $internRole = factory(Role::class)
                    ->create(['name' => 'Pasante'])
                    ->id; // id 5
    $clientRole = factory(Role::class)
                    ->create(['name' => 'Cliente'])
                    ->id; // id 6

    $assistant = factory(User::class)
                    ->create(['role_id' => $assistantRole]);

    $this->actingAs($assistant)
         ->get(route('call_trackings'))
         ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function sales_cannot_visit_the_call_section()
  {
    $superAdminRole = factory(Role::class)
                        ->create(['name' => 'Super Administrador'])
                        ->id; // id 1
    $adminRole = factory(Role::class)
                  ->create(['name' => 'Administrador'])
                  ->id; // id 2
    $assistantRole = factory(Role::class)
                      ->create(['name' => 'Asistente'])
                      ->id; // id 3
    $salesRole = factory(Role::class)
                  ->create(['name' => 'Ventas'])
                  ->id; // id 4
    $internRole = factory(Role::class)
                    ->create(['name' => 'Pasante'])
                    ->id; // id 5
    $clientRole = factory(Role::class)
                    ->create(['name' => 'Cliente'])
                    ->id; // id 6

    $sales = factory(User::class)
              ->create(['role_id' => $salesRole]);

    $this->actingAs($sales)
         ->get(route('call_trackings'))
         ->assertStatus(Response::HTTP_FORBIDDEN)
         ->assertDontSee('Seguimiento de llamadas');
  }
}
