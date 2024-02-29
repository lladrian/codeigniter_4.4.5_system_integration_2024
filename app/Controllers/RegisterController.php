<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use CodeIgniter\Session\Session;
use Config\Services;
use App\Helpers\CaptchaHelper;


class RegisterController extends Controller
{
   

    public function index()
    {
        $data = [
            'name' => 'John Does',
            'age' => 30
        ];
        CaptchaHelper::generateCaptcha();
        //$this->generate_image();

        return view('register', $data);
    }


    public function store()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'fname' => 'required|min_length[5]|max_length[255]',
            'lname' => 'required|min_length[5]|max_length[255]',
            'uname' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'captcha_code'=> 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            // Validation passed, proceed with registration logic
            // For simplicity, I'll assume you have a model named UserModel to interact with the database
            $userModel = new \App\Models\UserModel();
            $request = service('request');
            $userData = [
                'firstname' => $request->getPost('fname'),
                'lastname' => $request->getPost('lname'),
                'username' => $request->getPost('uname'),
                'email' => $request->getPost('email'),
                'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT)
            ];

            //public function createUser($data)
          // var_dump($session_data);
          $session = \Config\Services::session();

          $userCaptcha = $request->getPost('captcha_code');
         // var_dump($userCaptcha);
           // Perform CAPTCHA validation
           if ($userCaptcha == session()->get('captcha_code')) {
               // CAPTCHA validation passed
               $userModel->createUser($userData);
               session()->destroy();
               return redirect()->to('/login');
           } else {
               // CAPTCHA validation failed
               return redirect()->back()->withInput()->with('errors', ['Wrong captcha  code.!!']);
           }

        }
    }
}
