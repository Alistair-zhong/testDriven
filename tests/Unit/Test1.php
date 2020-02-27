<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class Test1 extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $au = new Author();
        $response->assertStatus(200);

        $this->assertTrue(true);
    }
}
