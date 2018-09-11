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
  public function test_super_admin_can_visit_the_call_section()
  {
    $superAdminRole = factory(Role::class)
                        ->create(['name' => 'Super Administrador'])
                        ->id;

    $superAdmin = factory(User::class)
                    ->create(['role_id' => $superAdminRole]);

    $this->actingAs($superAdmin)
         ->get(route('call.index'))
         ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function test_admins_can_visit_the_call_section()
  {
    $adminRole = factory(Role::class)
                  ->create(['name' => 'Administrador'])
                  ->id;

    $admin = factory(User::class)
                    ->create(['role_id' => $adminRole]);

    $this->actingAs($admin)
         ->get(route('call.index'))
         // ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function test_assistants_can_visit_the_call_section()
  {
    $assistantRole = factory(Role::class)
                      ->create([
                        'name' => 'Asistente'
                      ])->id;

    $assistant = factory(User::class)
                    ->create([
                      'role_id' => $assistantRole
                    ]);

    $this->actingAs($assistant)
         ->get(route('call.index'))
         // ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function test_sales_can_visit_the_call_section()
  {
    $salesRole = factory(Role::class)
                  ->create([
                    'name' => 'Ventas'
                  ])
                  ->id;

    $sales = factory(User::class)
              ->create([
                'role_id' => $salesRole
              ]);

    $this->actingAs($sales)
         ->get(route('call.index'))
         // ->assertSuccessful()
         ->assertSee('Seguimiento de llamadas');
  }

  /** @test */
  public function test_interns_cannot_visit_the_call_section()
  {
    $internRole = factory(Role::class)
                    ->create(['name' => 'Pasante'])
                    ->id;

    $intern = factory(User::class)
                ->create(['role_id' => $internRole]);

    $this->actingAs($intern)
         ->get(route('call.index'))
         ->assertDontSeeText('Seguimiento de llamadas');
  }

  /** @test */
  public function test_client_cannot_visit_the_call_section()
  {
    $clientRole = factory(Role::class)
                    ->create(['name' => 'Cliente'])
                    ->id;

    $client = factory(User::class)
              ->create(['role_id' => $clientRole]);

    $this->actingAs($client)
         ->get(route('call.index'))
         ->assertDontSeeText('Seguimiento de llamadas');
  }
}
