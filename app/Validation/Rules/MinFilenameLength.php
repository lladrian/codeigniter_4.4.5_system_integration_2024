<?php

namespace App\Validation\Rules;

use CodeIgniter\Validation\Rule;

class MinFilenameLength extends Rule
{
    protected $config = [
        'min_length' => 0,
    ];

    protected $language;

    public function __construct(array $options = [])
    {
        if (isset($options['min_length'])) {
            $this->config['min_length'] = (int)$options['min_length'];
        }

        // Inject the Language service
        $this->language = \Config\Services::language();
    }

    public function check($value): bool
    {
        return (mb_strlen(pathinfo($value, PATHINFO_FILENAME)) >= $this->config['min_length']);
    }

    public function setParameters(array $parameters): Rule
    {
        $this->config['min_length'] = (int)$parameters[0];
        return $this;
    }

    public function getErrorMessage(string $field): string
    {
        return lang('Validation.min_filename_length', ['field' => $field, 'min_length' => $this->config['min_length']]);
    }
}
