<?php

// tests/app/HomeTest.php

namespace Tests\App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class HomeTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    // Test 1 – Home page returns 200
    public function testHomePage(): void
    {
        $result = $this->get('/');
        $result->assertStatus(200);
        $result->assertSee('CI4 Student Portal');
    }

    // Test 2 – Register page loads
    public function testRegisterPageLoads(): void
    {
        $result = $this->get('/register');
        $result->assertStatus(200);
        $result->assertSee('Register');
    }

    // Test 3 – Upload page loads
    public function testUploadPageLoads(): void
    {
        $result = $this->get('/upload');
        $result->assertStatus(200);
        $this->assertNotNull($result->response());
        $result->assertSee('Upload');
    }

    // Test 4 – assertEquals on status code
    public function testHomeReturns200WithAssertEquals(): void
    {
        $result = $this->get('/');
        $this->assertEquals(200, $result->response()->getStatusCode());
    }

    // Test 5 – assertTrue on status check
    public function testHomeStatusIsTwoHundred(): void
    {
        $result = $this->get('/');
        $this->assertTrue($result->response()->getStatusCode() === 200);
    }
}