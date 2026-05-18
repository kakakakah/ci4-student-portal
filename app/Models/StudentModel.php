<?php


namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table      = 'students';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'bio', 'photo',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ── Validation rules (also tested in ValidationTest.php) ──
    protected $validationRules = [
        'name'  => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|max_length[100]|is_unique[students.email]',
        'bio'   => 'permit_empty|max_length[500]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'That email address is already registered.',
        ],
    ];

    /**
     * Return a paginated + optionally-searched result set.
     *
     * @param  string $search  Search term (empty = all students)
     * @param  int    $perPage Records per page (brief requires 5+)
     * @return array
     */
    public function getStudentsPaginated(string $search = '', int $perPage = 5): array
    {
        $builder = $this->select('id, name, email, bio, photo, created_at');

        if ($search !== '') {
            $builder->groupStart()
                        ->like('name',  $search)
                        ->orLike('email', $search)
                    ->groupEnd();
        }

        $builder->orderBy('created_at', 'DESC');

        $students  = $builder->paginate($perPage);
        $pager     = $this->pager;          // used in view: $pager->links()
        $totalRows = $this->countAllResults(false); // preserves the WHERE clause

        return compact('students', 'pager', 'totalRows');
    }

    /**

     *
     * @param  int $id
     * @return array|null
     */
    public function getStudent(int $id): ?array
    {
        return $this->select('id, name, email, bio, photo, created_at')
                    ->find($id);
    }

    /**
     * Check whether a student record is considered "active".
     * (Placeholder logic: every saved record is active.)
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return true;
    }
}
