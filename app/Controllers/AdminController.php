<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\RoleModel;
use App\Models\PermissionModel;

use CodeIgniter\HTTP\Request;
use CodeIgniter\Session\Session;
use Config\Services;
use App\Helpers\CaptchaHelper;

class AdminController extends BaseController
{
    public function index()
    {
         // Check if user is logged in
         if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }

        $userModel = new UserModel();
        $data['users'] = $userModel->where('is_admin', 1)->findAll();

        return view('/tables/admin_table/admins_table', $data);
    }

    
    public function edit_admin_permission($id) {
        $adminModel = new UserModel();
        $permissionModel = new PermissionModel();
       // echo $id;
        $data['admin'] = $adminModel->find($id);
        $permissionIdArray = json_decode($data['admin']['permission_id']);
       // $value = explode(',', $data['role']['permission_id']);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $permissionIdArray)->findAll();

        if ($data['admin']) {
            // If user is found, load the view and pass user data to it
            return view('/tables/admin_table/edit_admin_permission',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/admins')->with('error', 'Role not found.');
        }
    }


    
    public function edit_user($id) {
        $roleModel = new RoleModel();
        $userModel = new UserModel();
        $data['roles'] = $roleModel->findAll();
        $data['user'] = $userModel->find($id);
        //var_dump($user['firstname']);
        
        if ($data['user']) {
            // If user is found, load the view and pass user data to it
            return view('/tables/admin_table/edit_admin',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/tables/dashboard/admins')->with('error', 'User not found.');
        }
    }

    public function add_user()
    {
        // Check if user is logged in
        if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }
        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();

        // Load dashboard view
        return view('/tables/admin_table/add_admin',$data);
    }
    
    
    public function store()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'fname' => 'required|min_length[5]|max_length[255]',
            'lname' => 'required|min_length[5]|max_length[255]',
            'uname' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'role_id'=>  'required',
            'role_name'=>  'required',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ]);
 
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            // Validation passed, proceed with registration logic
            // For simplicity, I'll assume you have a model named UserModel to interact with the database
            $userModel = new \App\Models\UserModel();
            $request = service('request');
            // $value = $request->getPost('password');
            // var_dump($value);
            $userData = [
                'firstname' => $request->getPost('fname'),
                'lastname' => $request->getPost('lname'),
                'username' => $request->getPost('uname'),
                'email' => $request->getPost('email'),
                'role_name' => $request->getPost('role_name'),
                'role_id' => $request->getPost('role_id'),
                'is_admin' => 1,
                'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT)
            ];
          
            if($userModel->createUser($userData)){
                return redirect()->to('/dashboard/admins')->with('success', 'Feature added successfully.');
            } else {
                return redirect()->to('/dashboard/admins')->with('error', 'Failed to add feature.');
            }
        }
    }

    
    public function update_user($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'fname' => 'required|min_length[5]|max_length[255]',
            'lname' => 'required|min_length[5]|max_length[255]',
            'uname' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email',
            'category' => 'required'
        ]);
        //  $request = service('request');
        //  var_dump($request->getPost('password'));

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $userModel = new UserModel();
            $request = service('request');

            $userData = [
                    'firstname' => $request->getPost('fname'),
                    'lastname' => $request->getPost('lname'),
                    'username' => $request->getPost('uname'),
                    'email' => $request->getPost('email'),
                    'role_name' => $request->getPost('category')
            ];
            if($userModel->update($id, $userData)){
                return redirect()->to('/dashboard/admins')->with('success', 'Feature updated successfully.');
            } else {
                return redirect()->to('/dashboard/admins')->with('error', 'Failed to update feature.');
            }
            
            return redirect()->to('/dashboard/admins')->with('error', 'Failed to update feature.');
        }
        return redirect()->to('/dashboard/admins')->with('error', 'Failed to update feature.');
    }

    public function delete_user($id) {
        // Fetch the product from the database
        $userModel = new UserModel();
        //var_dump($userModel->find($id));
        
         // Validate the ID
         if (!$userModel->find($id)) {
            // Feature not found, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/admins')->with('error', 'Feature not found.');
        }

        // Attempt to delete the feature
        if ($userModel->delete($id)) {
            // Deletion successful, redirect with success message
            return redirect()->to('/dashboard/admins')->with('success', 'Feature deleted successfully.');
        } else {
            // Deletion failed, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/admins')->with('error', 'Failed to delete feature.');
        }   

    }
   

  
}
