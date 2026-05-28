<?php

// tests/app/StudentModelTest.php

namespace Tests\App;

use App\Models\StudentModel;
use CodeIgniter\Test\CIUnitTestCase;

class StudentModelTest extends CIUnitTestCase
{
    // No DatabaseTestTrait — uses your live DB directly
    // so no test database setup is needed

    protected StudentModel $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new StudentModel();
    }

    // Test 1 – assertNotNull: find() returns a real student
    // Uses existing seeded data (Ana Reyes = id 1)
    public function testFindReturnsStudent(): void
    {
        $student = $this->model->first();   // gets first record in DB

        $this->assertNotNull($student);
    }

    // Test 2 – assertTrue: isActive() returns true
    public function testIsActiveReturnsTrue(): void
    {
        // Week 14 required assertion: assertTrue($x)
        $this->assertTrue($this->model->isActive());
    }

    // Test 3 – assertEquals: record count is at least 1
    public function testStudentCountIsAtLeastOne(): void
    {
        $count = $this->model->countAllResults();

        //assertEquals($a, $b)
        $this->assertTrue($count >= 1);
        $this->assertNotNull($count);
    }

    // Test 4 – getStudentsPaginated returns correct array keys
    public function testGetStudentsPaginatedReturnsArray(): void
    {
        $result = $this->model->getStudentsPaginated('', 5);

        $this->assertArrayHasKey('students',  $result);
        $this->assertArrayHasKey('pager',     $result);
        $this->assertArrayHasKey('totalRows', $result);
    }

    // Test 5 – getStudent() returns null for non-existent ID
    public function testGetStudentReturnsNullForMissingId(): void
    {
        $result = $this->model->getStudent(99999);

        $this->assertNull($result);
    }
}