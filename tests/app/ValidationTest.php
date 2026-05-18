<?php


namespace Tests\App;

use CodeIgniter\Test\CIUnitTestCase;

class ValidationTest extends CIUnitTestCase
{
    protected $validation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Helper: run rules against given data and return pass/fail.
     */
    private function runRules(array $rules, array $data): bool
    {
        $this->validation->reset();
        $this->validation->setRules($rules);
        return $this->validation->run($data);
    }


    public function testValidStudentDataPassesValidation(): void
    {
        $rules = [
            'name'  => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email',
            'bio'   => 'permit_empty|max_length[500]',
        ];

        $data = [
            'name'  => 'Ana Reyes',
            'email' => 'ana@example.com',
            'bio'   => 'A short bio.',
        ];

        $passes = $this->runRules($rules, $data);

        $this->assertTrue($passes);
    }


    public function testMissingNameFailsValidation(): void
    {
        $rules = ['name' => 'required|min_length[2]'];
        $data  = ['name' => ''];

        $passes = $this->runRules($rules, $data);

        // assertFalse: invalid data must NOT pass
        $this->assertFalse($passes);

        $error = $this->validation->getError('name');
        $this->assertNotNull($error);
        $this->assertEquals(
            'The name field is required.',
            $error
        );
    }


    public function testInvalidEmailFailsValidation(): void
    {
        $rules = ['email' => 'required|valid_email'];
        $data  = ['email' => 'not-an-email'];

        $passes = $this->runRules($rules, $data);

        $this->assertFalse($passes);

        $error = $this->validation->getError('email');
        // Week 14: assertNotNull($x)
        $this->assertNotNull($error);
    }

    public function testNameTooShortFailsValidation(): void
    {
        $rules = ['name' => 'required|min_length[2]'];
        $data  = ['name' => 'A'];  // only 1 character

        $passes = $this->runRules($rules, $data);

        $this->assertFalse($passes);
    }

    public function testBioTooLongFailsValidation(): void
    {
        $rules = ['bio' => 'permit_empty|max_length[500]'];
        $data  = ['bio' => str_repeat('x', 501)];  // 501 chars

        $passes = $this->runRules($rules, $data);

        $this->assertFalse($passes);

        $this->assertEquals(
            'The bio field cannot exceed 500 characters in length.',
            $this->validation->getError('bio')
        );
    }
}
