<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

    public function index(): string
    {
        // Page cache: CI4 will serve a static copy for 60 s,
        // skipping DB queries and controller logic entirely.
        $this->cachePage(60);

        return view('home/index', [
            'title' => 'CI4 Student Portal',
        ]);
    }
}
