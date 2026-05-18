<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;

class Upload extends BaseController
{

    public function index(): string
    {
        return view('upload/index', [
            'title'      => 'Upload File',
            'validation' => \Config\Services::validation(),
        ]);
    }


    public function store()
    {
        $rules = [
            'userfile' => [
                'label' => 'Upload File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',               // type: images only
                    'mime_in[userfile,image/jpg,image/jpeg,image/png,image/gif,image/webp]', // MIME check
                    'max_size[userfile,2048]',           // size: max 2 MB
                    'max_dims[userfile,4000,4000]',      // dimensions guard
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return view('upload/index', [
                'title'      => 'Upload File',
                'validation' => $this->validator,
            ]);
        }

        /** @var UploadedFile $file */
        $file = $this->request->getFile('userfile');

        if (! $file->isValid()) {
            return redirect()->back()->with('error', 'Invalid or corrupted file.');
        }


        $newName   = $file->getRandomName();
        $uploadDir = WRITEPATH . 'uploads/';

        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file->move($uploadDir, $newName);

        log_message('info', "[Upload] File saved: {$newName} "
            . "(original: {$file->getClientName()}, "
            . "MIME: {$file->getClientMimeType()}, "
            . "size: {$file->getSizeByUnit('kb')} KB)");

        // Week 12–13: redirect to success page that displays the file
        return redirect()->to('/upload/success/' . $newName);
    }


    public function success(string $filename): string
    {
        // Sanitise: allow only alphanumeric, dot, dash, underscore
        $clean = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);

        $path = WRITEPATH . 'uploads/' . $clean;

        if (! file_exists($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found.');
        }

        return view('upload/success', [
            'title'    => 'Upload Successful',
            'filename' => $clean,
            'fileUrl'  => base_url('uploads/' . $clean),
            'fileSize' => round(filesize($path) / 1024, 1) . ' KB',
        ]);
    }
}
