<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Role;
use Symfony\Component\HttpFoundation\Response;

class DashboardTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function admins_can_visit_the_admin_dashboard()
  {
    $superAdminRole = factory(Role::class)
                        ->create(['name' => 'Super Administrador'])
                        ->id;
    $adminRole = factory(Role::class)
                  ->create(['name' => 'Administrador'])
                  ->id;
    $assistantRole = factory(Role::class)
                      ->create(['name' => 'Asistente'])
                      ->id;
    $salesRole = factory(Role::class)
                  ->create(['name' => 'Ventas'])
                  ->id;
    $internRole = factory(Role::class)
                    ->create(['name' => 'Pasante'])
                    ->id;
    $clientRole = factory(Role::class)
                    ->create(['name' => 'Cliente'])
                    ->id;

    $admin = factory(User::class)->create(['role_id' => $adminRole]);

    $this->actingAs($admin)
         ->get(route('dashboard'))
         ->assertStatus(Response::HTTP_OK)
         ->assertSee('Dashboard');
  }

  /** @test */
  public function non_registered_users_cannot_visit_the_admin_dashboard()
  {
    $this->get(route('dashboard'))
         ->assertStatus(Response::HTTP_FOUND);
  }
}
