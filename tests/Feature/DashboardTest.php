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
    factory(Role::class)->create(['name' => 'Super Administrador']);

    $admin = factory(User::class)->create();

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
