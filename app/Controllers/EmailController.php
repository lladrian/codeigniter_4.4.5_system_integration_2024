<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmailController extends BaseController
{
    public function index()
    {
        echo "SMTP: HELLO WORLD";
    }
}
