<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Symfony\Component\HttpFoundation\Response;

class DashboardTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function admins_can_visit_the_admin_dashboard()
  {
    $admin = factory(App\User::class)->create([
      'name' => 'Admin',
      'email' => 'test@rolveinmobiliaria.com.mx',
      'password' => 'root',
      'role_id' => 1,
    ]);

    $this->actionAs($admin)
         ->get(route('dashboard'))
         ->assertStatus(HTTP_OK)
         ->assertSee('Dashboard');
  }

  /** @test */
  public function non_registered_users_cannot_visit_the_admin_dashboard()
  {
    $this->get(route('dashboard'))
         ->assertStatus(HTTP_FORBIDDEN)
         ->assertSee('Dashboard');
  }
}
