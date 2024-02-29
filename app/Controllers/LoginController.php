<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use Config\Services; // Add this line
use App\Models\UserModel; // Add this line
use CodeIgniter\HTTP\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        // Validate the form data
        // $validation = Services::validation(); // Change \Config\Services::validation() to Services::validation()
        // $validation->setRules([
        //     'email' => 'required|valid_email',
        //     'password' => 'required'
        // ]);
        $session = \Config\Services::session();

        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        // if (!$validation->withRequest($this->request)->run()) {
        //     return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        // }
        if ($this->validate($validationRules)) {
            $request = service('request');
            // Check if the user exists
            $userModel = new UserModel(); // Change \App\Models\UserModel() to UserModel()
           // $user = $userModel->where('email', $request->getPost('email'))->first();
            $user =  $userModel->getUserByEmail($request->getPost('email'));
        
            if(!$user || !password_verify($request->getPost('password'), $user['password']) ) {
                 return redirect()->back()->withInput()->with('errors', ['Invalid email or password.']);
             }
         
             if(password_verify($request->getPost('password'), $user['password']) ) {
                // Store user data in session
                session()->set('user', $user);
                return redirect()->to('/dashboard');
            }  
        } else {
            // Validation failed, show validation errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}
