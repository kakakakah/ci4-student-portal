<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EmailTest extends BaseController
{
    public function index(): string
    {
        $email     = \Config\Services::email();
        $toAddress = env('email.SMTPUser', 'test@example.com');

        // HTML body
        $htmlBody = view('emails/welcome', [
            'name'    => 'Test Student',
            'siteUrl' => base_url(),
        ]);

        // Plain-text fallback 
        $plainText = "Hi Test Student,\n\nWelcome to the CI4 Student Portal!\n"
                   . "Visit: " . base_url() . "\n\n– The Portal Team";

        $email->setTo($toAddress);
        $email->setSubject('CI4 Portal – Email Test (Week 12-13)');
        $email->setMessage($htmlBody);
        $email->setAltMessage($plainText);

        $sent = $email->send();

        // Log result
        if ($sent) {
            log_message('info', "[EmailTest] Test email sent to {$toAddress}");
        } else {
            log_message('error', "[EmailTest] Failed: " . $email->printDebugger(['headers']));
        }

        $status     = $sent ? 'SUCCESS' : 'FAILED';
        $alertClass = $sent ? 'success' : 'danger';
        $message    = $sent
            ? "Email sent to <strong>{$toAddress}</strong>. Check your inbox and <code>writable/logs/</code>."
            : "Email failed. Check your SMTP settings in <code>.env</code>.<br><br><pre>" . esc($email->printDebugger()) . "</pre>";

        $html  = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">';
        $html .= '<title>Email Test</title>';
        $html .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">';
        $html .= '</head><body class="p-5">';
        $html .= '<div class="card shadow-sm" style="max-width:640px;margin:auto">';
        $html .= '<div class="card-header bg-dark text-white fw-bold">Week 12-13 – Email Test Result</div>';
        $html .= '<div class="card-body">';
        $html .= '<h4 class="text-' . $alertClass . '">' . $status . '</h4>';
        $html .= '<p>' . $message . '</p>';
        $html .= '<hr><p class="small text-muted">';
        $html .= '✔ HTML email sent via SMTP<br>';
        $html .= '✔ Plain-text fallback via setAltMessage()<br>';
        $html .= '✔ Send status logged to <code>writable/logs/</code></p>';
        $html .= '<a href="/" class="btn btn-dark btn-sm">← Back to Portal</a>';
        $html .= '</div></div></body></html>';

        return $html;
    }
}