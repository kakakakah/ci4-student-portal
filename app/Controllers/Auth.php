<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\Email\Email;

class Auth extends BaseController
{

    public function register(): string
    {
        return view('auth/register', [
            'title'      => 'Register',
            'validation' => \Config\Services::validation(),
        ]);
    }


    public function store()
    {
        $rules = [
            'name'  => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|is_unique[students.email]',
            'bio'   => 'permit_empty|max_length[500]',
        ];

        // ── Validation ────────────────────────────────────────
        if (! $this->validate($rules)) {
            // Re-display the form with validation errors.
            // NOTE: we pass the validation object back so the view
            // can call $validation->getError('field').
            return view('auth/register', [
                'title'      => 'Register',
                'validation' => $this->validator,
            ]);
        }

        // ── Persist ───────────────────────────────────────────
        $model = new StudentModel();

        $studentId = $model->insert([
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'bio'   => $this->request->getPost('bio'),
        ]);


        $this->_sendWelcomeEmail(
            $this->request->getPost('email'),
            $this->request->getPost('name')
        );

        return redirect()
            ->to('/students')
            ->with('success', 'Registration successful! Welcome aboard.');
    }


    private function _sendWelcomeEmail(string $to, string $name): void
    {
        /** @var \CodeIgniter\Email\Email $email */
        $email = \Config\Services::email();

        // HTML body (rendered from a dedicated view)
        $htmlBody = view('emails/welcome', [
            'name'    => $name,
            'siteUrl' => base_url(),
        ]);

        // Plain-text fallback (Week 12–13 requirement)
        $plainText = "Hi {$name},\n\nWelcome to the CI4 Student Portal!\n"
                   . "Visit us at: " . base_url() . "\n\n"
                   . "– The Portal Team";

        $email->setTo($to, $name);
        $email->setSubject('Welcome to the CI4 Student Portal!');
        $email->setMessage($htmlBody);
        $email->setAltMessage($plainText);   // plain-text fallback

        if ($email->send()) {
            log_message('info', "[Auth] Welcome email sent to {$to}");
        } else {
            log_message('error', "[Auth] Failed to send welcome email to {$to}: "
                . $email->printDebugger(['headers']));
        }
    }
}
