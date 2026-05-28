<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class Students extends BaseController
{
    protected StudentModel $model;

    public function __construct()
    {
        $this->model = new StudentModel();
    }

    // ── GET /students ─────────────────────────────────────────
    public function index(): string
    {


        // dd($this->model);   // ← UNCOMMENT THIS FOR THE SCREENSHOT

 
        $search = trim((string) $this->request->getGet('search'));

        $data = $this->model->getStudentsPaginated($search, 5);

        return view('students/index', [
            'title'      => 'Student Directory',
            'students'   => $data['students'],
            'pager'      => $data['pager'],
            'totalRows'  => $data['totalRows'],
            'search'     => $search,
            // Current page number for "Page X of Y" display
            'currentPage'=> (int) ($this->request->getGet('page') ?? 1),
        ]);
    }

    // ── GET /students/:id ─────────────────────────────────────
    /**
     * Single student profile view.
     */
    public function show(int $id): string
    {
        $student = $this->model->getStudent($id);

        if ($student === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Student #{$id} not found."
            );
        }

        return view('students/show', [
            'title'   => esc($student['name']),
            'student' => $student,
        ]);
    }
}
