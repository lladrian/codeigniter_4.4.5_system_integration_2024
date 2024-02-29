<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel; // Add this line


class RecoveryController extends BaseController
{
    public function index()
    {
        //
    }
    public function send()
    {
       // echo "submitted";
        if($this->isonline()) {
            $to = 'adrian.manatad@evsu.edu.ph';
          //  $subject = $this->request->getVar('subject'); 
           // $message = $this->request->getVar('message');
            $subject = "red"; 
            $message = "red";
          
            $email = \Config\Services::email();

            $email->setTo($to); 
            $email->setFrom('adrianmanatad5182@gmail.com', 'ADRIAN C. MANATAD'); 
            $email->setSubject($subject); 
            $email->setMessage($message); 

            if($email->send()) {
                return redirect()->to('/recovery_code')->with('success', "Email sent successfully!"); 
            } else{ 
                return redirect()->to('/recovery_code')->with('error', "Failed to send.!")->withInput(); 
            }

        } else {
           return redirect()->to('/recovery_code')
                            ->with('error', 'Check your internet connection')
                            ->withInput(); 
         }   
    }

    public function isOnline($site= "https://youtube.com"){ 
        if(@fopen($site, "r")){ 
            return true; 
        }else{
             return false;
        }
    }

    public function email_verification() {
        $userModel = new UserModel();
        $session = \Config\Services::session();

        $validationRules = [
            'email' => 'required|valid_email'
        ];

        if ($this->validate($validationRules)) {
            $request = service('request');
            // Check if the user exists
            $userModel = new UserModel(); // Change \App\Models\UserModel() to UserModel()
           // $user = $userModel->where('email', $request->getPost('email'))->first();
            $user =  $userModel->getUserByEmail($request->getPost('email'));
        
            if(!$user) {
                 return redirect()->back()->withInput()->with('errors', ['Email address not found.']);
             } else {

                return view('recovery_code');
             }
        
        } else {
            // Validation failed, show validation errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

    }

    public function recovery_account() {
        return view('recovery_account');
    }

    public function recovery_code() {
        return view('recovery_code');
    }

}
