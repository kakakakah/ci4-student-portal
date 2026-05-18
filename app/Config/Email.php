<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{

    public string $protocol = 'smtp';

    public string $SMTPHost   = '';    // Overridden by .env email.SMTPHost
    public string $SMTPUser   = '';    // Overridden by .env email.SMTPUser
    public string $SMTPPass   = '';    // Overridden by .env email.SMTPPass
    public int    $SMTPPort   = 587;
    public string $SMTPCrypto = 'tls';


    public string $mailType = 'html';
    public string $charset  = 'utf-8';

    public string $fromEmail = '';     // Overridden by .env
    public string $fromName  = 'CI4 Student Portal';


    public bool $mailgunDebug = false;
}
