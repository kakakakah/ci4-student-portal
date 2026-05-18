<?php

namespace Tests\App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class HomeTest extends CIUnitTestCase
{
    // FeatureTestTrait provides $this->get(), $this->post(), etc.
    use FeatureTestTrait;


    public function testHomePage(): void
    {
        $result = $this->get('/');

        $result->assertStatus(200);

        $result->assertSee('CI4 Student Portal');
    }


    public function testRegisterPageLoads(): void
    {
        $result = $this->get('/register');

        $result->assertStatus(200);

        // The form must contain a CSRF hidden field (Week 11)
        $result->assertSee('csrf');
        $result->assertSee('Register');
    }


    public function testStudentsPageLoads(): void
    {
        $result = $this->get('/students');

        // Week 14 required assertion: assertEquals($a, $b)
        $this->assertEquals(200, $result->response()->getStatusCode());
    }


    public function testUploadPageLoads(): void
    {
        $result = $this->get('/upload');

        $result->assertStatus(200);

        $this->assertNotNull($result->response());

        $result->assertSee('Upload');
    }


    public function testMissingRouteReturns404(): void
    {
        $result = $this->get('/this-route-does-not-exist');

        // Week 14 required assertion: assertTrue($x)
        $this->assertTrue($result->response()->getStatusCode() === 404);
    }
}
