<?php

namespace App\Validation;

use CodeIgniter\Validation\Validation;
use CodeIgniter\Validation\Exceptions\ValidationException;

class CustomRules
{
    public function validateFiles(array $files): bool
    {
        foreach ($files as $file) {
            if (!$file->isValid()) {
                return false;
            }
        }
        return true;
    }
}
