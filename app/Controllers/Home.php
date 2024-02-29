<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'name' => 'John Doe',
            'age' => 30
        ];
    
        // Pass the $data array to the view
        return view('welcome_message', $data);
    }
}
