<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testExample(): void
    {
        $this->assertTrue(true);
    }
}
