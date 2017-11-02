<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Role;
use Symfony\Component\HttpFoundation\Response;

class SaleTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function super_admin_can_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $superAdmin = factory(User::class)
                    ->create(['role_id' => $superAdminRole]);

    $this->actingAs($superAdmin)
         ->get(route('for_sales'))
         ->assertSuccessful()
         ->assertSee('Compra venta');
  }

  /** @test */
  public function admins_can_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $admin = factory(User::class)
                    ->create(['role_id' => $adminRole]);

    $this->actingAs($admin)
         ->get(route('for_sales'))
         ->assertSuccessful()
         ->assertSee('Compra venta');
  }

  /** @test */
  public function assistants_can_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $assistant = factory(User::class)
                    ->create(['role_id' => $assistantRole]);

    $this->actingAs($assistant)
         ->get(route('for_sales'))
         ->assertSuccessful()
         ->assertSee('Compra venta');
  }

  /** @test */
  public function trackings_cannot_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $tracking = factory(User::class)
                  ->create(['role_id' => $trackingRole]);

    $this->actingAs($tracking)
         ->get(route('for_sales'))
         ->assertStatus(Response::HTTP_FORBIDDEN)
         ->assertDontSee('Compra venta');
  }

  /** @test */
  public function sales_can_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $sales = factory(User::class)
              ->create(['role_id' => $salesRole]);

    $this->actingAs($sales)
         ->get(route('for_sales'))
         ->assertSuccessful()
         ->assertSee('Compra venta');
  }

  /** @test */
  public function interns_cannot_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $intern = factory(User::class)
              ->create(['role_id' => $internRole]);

    $this->actingAs($intern)
         ->get(route('for_sales'))
         ->assertStatus(Response::HTTP_FORBIDDEN)
         ->assertDontSee('Compra venta');
  }

  /** @test */
  public function client_cannot_visit_the_sale_section()
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
    $trackingRole = factory(Role::class)
                      ->create(['name' => 'Seguimiento'])
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

    $client = factory(User::class)
              ->create(['role_id' => $clientRole]);

    $this->actingAs($client)
         ->get(route('for_sales'))
         ->assertStatus(Response::HTTP_FORBIDDEN)
         ->assertDontSee('Compra venta');
  }
}
