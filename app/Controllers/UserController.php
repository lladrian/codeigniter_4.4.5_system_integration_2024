<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use App\Models\UserModel; // Add this line
use App\Models\RoleModel; // Add this line
use App\Models\PermissionModel; // Add this line

use CodeIgniter\HTTP\Request;
use CodeIgniter\Session\Session;
use Config\Services;
use App\Helpers\CaptchaHelper;

class UserController extends BaseController
{
    public function index()
    {
         // Check if user is logged in
         if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }

        $userModel = new UserModel();
        $data['users'] = $userModel->where('is_admin', 0)->findAll();

      
        // Load dashboard view
        return view('/tables/user_table/users_table', $data);
    }

    public function test() {
        $userModel = new UserModel();

    // print_r($data['user']['user_permission_id']);
    $data['user'] = $userModel
    ->select('users.id, users.firstname, users.lastname, 
    users.username, users.email, 
    users.permission_id AS user_permission_id, 
    users.role_id, roles.role_name, 
    roles.permission_id AS role_permission_id')
    ->join('roles', 'roles.id = users.role_id')
    ->where('users.id', 17)
    ->first();

    // print_r($data['user']['user_permission_id']);
    // print_r($data['user']['role_permission_id']);

   //Combine permission arrays and remove duplicates
    $combinedPermissions = [];
    $userPermissions = json_decode($data['user']['user_permission_id']);
    $rolePermissions = json_decode($data['user']['role_permission_id']);
    // Merge user and role permissions
    $combinedPermissions = array_merge($combinedPermissions, $userPermissions, $rolePermissions);
    
    // Remove duplicates
    $combinedPermissions = json_encode(array_values(array_unique($combinedPermissions)));


   // print_r($combinedPermissions);


       // return view('/tables/dagan_daw', $data);
    }

    
    public function edit_user_permission($id) {
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();
        $userModel = new UserModel();
        $data['user'] = $userModel
        ->select('users.id, users.firstname, users.lastname, 
        users.username, users.email, 
        users.permission_id AS user_permission_id, 
        users.role_id, roles.role_name, 
        roles.permission_id AS role_permission_id')
        ->join('roles', 'roles.id = users.role_id')
        ->where('users.id', $id)
        ->first();
    
       //Combine permission arrays and remove duplicates
        $combinedPermissions = [];
        $userPermissions = json_decode($data['user']['user_permission_id']);
        $rolePermissions = json_decode($data['user']['role_permission_id']);
        // Merge user and role permissions
        $combinedPermissions = array_merge($combinedPermissions, $userPermissions, $rolePermissions);
 
        // Remove duplicates
        $combinedPermissions = json_encode(array_values(array_unique($combinedPermissions)));
        $value_combinedPermissions = explode(',', $combinedPermissions);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id',  $value_combinedPermissions)->findAll();

        if ($data['user']) {
            // If user is found, load the view and pass user data to it
            return view('/tables/user_table/edit_user_permission',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/roles')->with('error', 'Role not found.');
        }
    }

    public function delete_user_permission($id, $user_id) {
        // Fetch the product from the database
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();

        $data['user'] = $userModel
        ->select('users.id, users.firstname, users.lastname, 
        users.username, users.email, 
        users.permission_id AS user_permission_id, 
        users.role_id, roles.role_name, 
        roles.permission_id AS role_permission_id')
        ->join('roles', 'roles.id = users.role_id')
        ->where('users.id', $user_id)
        ->first();
    
       //Combine permission arrays and remove duplicates
        $combinedPermissions = [];
        $userPermissions = json_decode($data['user']['user_permission_id']);
        $rolePermissions = json_decode($data['user']['role_permission_id']);
        // Merge user and role permissions
        $combinedPermissions = array_merge($combinedPermissions, $userPermissions, $rolePermissions);
 
        // Remove duplicates
        $combinedPermissions = json_encode(array_values(array_unique($combinedPermissions)));
        $value_combinedPermissions = explode(',', $combinedPermissions);
        /*
            $data['user'] = $userModel->find($user_id);
            $value_1 = explode(',', $data['user']['permission_id']);
            $data['permissions_2'] = $permissionModel->whereIn('id', $value_1)->orderBy('id', 'ASC')->findAll();

        */
        //$value_2 = $data['role']['permission_id'];
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $value_combinedPermissions)->orderBy('id', 'ASC')->findAll();
    
        $permissionIdArray = json_decode($combinedPermissions);
        $array = $permissionIdArray;

        // Value to remove
        $valueToRemove = $id;

        // Remove the value from the array
        $resultArray = array_diff($array , [$valueToRemove]);
        $resultString = '[' . implode(',', $resultArray) . ']';

        $userData = [
            'permission_id' => $resultString
        ];
        //$roleModel->update($data['user']['role_id'], $userData)
        if($userModel->update($user_id, $userData)){
            return view('/tables/user_table/edit_user_permission',$data);
        } else {
            return view('/tables/user_table/edit_user_permission',$data);
        }
    }
    
    public function add_user_permission($user_id) {
        // Fetch the product from the database
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();
        $validation = \Config\Services::validation();
        $request = service('request');

        $validation->setRules([
            'category' => 'required'
        ]);
/*
        $data['user'] = $userModel->find($user_id);
        $value = explode(',', $data['user']['permission_id']);
        $data['permissions_2'] = $permissionModel->whereIn('id', $value)->findAll();

        */
        $data['user'] = $userModel
        ->select('users.id, users.firstname, users.lastname, 
        users.username, users.email, 
        users.permission_id AS user_permission_id, 
        users.role_id, roles.role_name, 
        roles.permission_id AS role_permission_id')
        ->join('roles', 'roles.id = users.role_id')
        ->where('users.id', $user_id)
        ->first();
    
       //Combine permission arrays and remove duplicates
        $combinedPermissions = [];
        //print_r($data['user']['role_id']);
        $userPermissions = json_decode($data['user']['user_permission_id']);
        $rolePermissions = json_decode($data['user']['role_permission_id']);
        // Merge user and role permissions
        $combinedPermissions = array_merge($combinedPermissions, $userPermissions, $rolePermissions);
 
        // Remove duplicates
        $combinedPermissions = json_encode(array_values(array_unique($combinedPermissions)));
        $value_combinedPermissions = explode(',', $combinedPermissions);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $value_combinedPermissions)->findAll();

        $permissionIdArray = json_decode($combinedPermissions);
        $array = $permissionIdArray;

        // Remove the value from the array
        $resultArray = array_diff($array , [0]);
        $value_counts = array_count_values($resultArray);
        $search_value = $request->getPost('category');
        $is_duplicate = isset($value_counts[$search_value]) && $value_counts[$search_value] > 0;

        if (!$is_duplicate) {
                 //echo "No duplicate of $search_value found in the array.";
                 $resultArray[] = $request->getPost('category');
                 $resultString = '[' . implode(',', $resultArray) . ']';
 
                 $userData = [
                     'permission_id' => $resultString
                 ]; 
                // $roleModel->update($data['user']['role_id'], $userData)
                 if($userModel->update($user_id, $userData)){
                      return view('/tables/user_table/edit_user_permission',$data);
                 } else {
                      return view('/tables/user_table/edit_user_permission',$data);
                 }
        } else {
            return view('/tables/user_table/edit_user_permission',$data);

            //echo "Duplicate of $search_value exists in the array.";
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
            return view('/tables/user_table/edit_user',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/users')->with('error', 'User not found.');
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
        return view('/tables/user_table/add_user',$data);
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
            'category' => 'required'
        ]);
      

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            // Validation passed, proceed with registration logic
            // For simplicity, I'll assume you have a model named UserModel to interact with the database
            $userModel = new \App\Models\UserModel();
            $roleModel = new RoleModel();
            $request = service('request');
            $value = $request->getPost('category');
            $data['roles'] = $roleModel->where('id', $value)->findAll();
        //     $data['roles'] = $roleModel->select('id, role_name')->where('id', $value)->findAll();
        //    echo $data['roles']['0']['role_name'];
            $userData = [
                'firstname' => $request->getPost('fname'),
                'lastname' => $request->getPost('lname'),
                'username' => $request->getPost('uname'),
                'email' => $request->getPost('email'),
                'role_id' => $request->getPost('category'),
                'role_name' => $data['roles']['0']['role_name'],
                'permission_id' => '['.'0'.']',
                'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT)
            ];

            if($userModel->createUser($userData)) {
                return redirect()->to('/dashboard/users')->with('success', 'Feature added successfully.');
            } else {
                return redirect()->to('/dashboard/users')->with('error', 'Failed to add feature.');
            }


            return redirect()->to('/dashboard/users');
        }
    }

    
    public function update_user($id)
    {
        $validation = \Config\Services::validation();
       // 'email' => 'required|valid_email|is_unique[users.email]',
        $validation->setRules([
            'fname' => 'required|min_length[5]|max_length[255]',
            'lname' => 'required|min_length[5]|max_length[255]',
            'uname' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email',
            'category' => 'required'
        ]);
        //  $request = service('request');
        //  var_dump($request->getPost('password'));

        // $request = service('request');
        // $value =$request->getPost('category');
        // var_dump($value);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $roleModel = new RoleModel();    
            $userModel = new UserModel();
            $request = service('request');
            $value = $request->getPost('category');
            $data['roles'] = $roleModel->where('id', $value)->findAll();

            $userData = [
                    'firstname' => $request->getPost('fname'),
                    'lastname' => $request->getPost('lname'),
                    'username' => $request->getPost('uname'),
                    'email' => $request->getPost('email'),
                    'role_id' => $request->getPost('category'),
                    'role_name' => $data['roles']['0']['role_name']
            ];
            if($userModel->update($id, $userData)){
                return redirect()->to('/dashboard/users')->with('success', 'Feature updated successfully.');
            } else {
                return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
            }
            return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
        }
        return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
    }

    public function delete_user($id) {
        // Fetch the product from the database
        $userModel = new UserModel();
        //var_dump($userModel->find($id));
        
         // Validate the ID
         if (!$userModel->find($id)) {
            // Feature not found, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/users')->with('error', 'Feature not found.');
        }

        // Attempt to delete the feature
        if ($userModel->delete($id)) {
            // Deletion successful, redirect with success message
            return redirect()->to('/dashboard/users')->with('success', 'Feature deleted successfully.');
        } else {
            // Deletion failed, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/users')->with('error', 'Failed to delete feature.');
        }   

    }
   
}
