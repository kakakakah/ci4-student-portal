<?php



namespace Tests\App;

use App\Models\StudentModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class StudentModelTest extends CIUnitTestCase
{
    // DatabaseTestTrait resets the DB between tests using
    // $refresh = true, so tests don't pollute each other.
    use DatabaseTestTrait;

    protected $refresh  = true;
    protected $seed     = 'StudentSeeder';   // seeds writable test DB

    protected StudentModel $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new StudentModel();
    }


    public function testFindReturnsStudent(): void
    {
        // Insert a test record first
        $id = $this->model->insert([
            'name'  => 'Test Student',
            'email' => 'test@example.com',
            'bio'   => 'Test bio',
        ]);

        $student = $this->model->find($id);

        $this->assertNotNull($student);
        $this->assertEquals('Test Student', $student['name']);
        $this->assertEquals('test@example.com', $student['email']);
    }


    public function testIsActiveReturnsTrue(): void
    {
        $this->assertTrue($this->model->isActive());
    }


    public function testInsertAndCountStudents(): void
    {
        $this->model->insert(['name' => 'Alice', 'email' => 'alice@test.com']);
        $this->model->insert(['name' => 'Bob',   'email' => 'bob@test.com']);

        $count = $this->model->countAllResults();

        $this->assertEquals(2, $count);
    }


    public function testGetStudentsPaginatedReturnsArray(): void
    {
        $result = $this->model->getStudentsPaginated('', 5);

        $this->assertArrayHasKey('students',  $result);
        $this->assertArrayHasKey('pager',     $result);
        $this->assertArrayHasKey('totalRows', $result);
    }

    public function testGetStudentReturnsNullForMissingId(): void
    {
        $result = $this->model->getStudent(99999);

        $this->assertNull($result);
    }


}
