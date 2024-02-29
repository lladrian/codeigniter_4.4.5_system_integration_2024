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


class RoleController extends BaseController
{
    public function index()
    {
         // Check if user is logged in
         if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }

        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();


        // Load dashboard view
        return view('/tables/role_table/roles_table', $data);
    }



    public function add_role()
    {
        // Check if user is logged in
        if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }

        // Load dashboard view
        return view('/tables/role_table/add_role');
    }

    public function edit_role_permission($id) {
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();
        $data['role'] = $roleModel->find($id);
        $permissionIdArray = json_decode($data['role']['permission_id']);
       // $value = explode(',', $data['role']['permission_id']);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $permissionIdArray)->findAll();

        if ($data['role']) {
            // If user is found, load the view and pass user data to it
            return view('/tables/role_table/edit_role_permission',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/roles')->with('error', 'Role not found.');
        }
    }


    public function delete_role_permission($id, $role_id) {
        // Fetch the product from the database
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();

        $data['role'] = $roleModel->find($role_id);
        $value_1 = explode(',', $data['role']['permission_id']);
        //$value_2 = $data['role']['permission_id'];
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $value_1)->orderBy('id', 'ASC')->findAll();
    
        $permissionIdArray = json_decode($data['role']['permission_id']);
        $array = $permissionIdArray;

        // Value to remove
        $valueToRemove = $id;

        // Remove the value from the array
        $resultArray = array_diff($array , [$valueToRemove]);
        $resultString = '[' . implode(',', $resultArray) . ']';

        $roleData = [
            'permission_id' => $resultString
        ];

        if($roleModel->update($role_id, $roleData)){
            $data['refresh'] = 'true';
            return view('/tables/role_table/edit_role_permission',$data);
        } else {
            return view('/tables/role_table/edit_role_permission',$data);
        }
    }
    
    public function add_role_permission($role_id) {
        // Fetch the product from the database
        $session = \Config\Services::session();
        $roleModel = new RoleModel();
        $userModel = new UserModel();
        $permissionModel = new PermissionModel();
        $validation = \Config\Services::validation();
        $request = service('request');

        $validation->setRules([
            'category' => 'required'
        ]);
        /*
        $data['role'] = $roleModel->find($role_id);
        $value = explode(',', $data['role']['permission_id']);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $value)->findAll();
        */
        $data['role'] = $roleModel->find($role_id);
        $permissionIdArray = json_decode($data['role']['permission_id']);
       // $value = explode(',', $data['role']['permission_id']);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $permissionIdArray)->findAll();


        $permissionIdArray = json_decode($data['role']['permission_id']);
        $array = $permissionIdArray;

        $resultArray = array_diff($array , [-1]);


        $value_counts = array_count_values($resultArray);

        // Check if the value you're searching for exists and is a duplicate
        $search_value = $request->getPost('category');

        $is_duplicate = isset($value_counts[$search_value]) && $value_counts[$search_value] > 0;


        if (!$is_duplicate) {
            //echo "No duplicate of $search_value found in the array.";
            $resultArray[] = $request->getPost('category');
            $resultString = '[' . implode(',', $resultArray) . ']';

            $roleData = [
                'permission_id' => $resultString
            ];

            if($roleModel->update($role_id, $roleData)){
                return view('/tables/role_table/edit_role_permission', $data);
               // return view('/tables/role_table/edit_role_permission',$data);
            } else {
                return view('/tables/role_table/edit_role_permission',$data);
            }
        } else {
            return view('/tables/role_table/edit_role_permission',$data);
            //echo "Duplicate of $search_value exists in the array.";
        }
    }

    public function edit_role($id) {
        $roleModel = new RoleModel();
        $permissionModel = new PermissionModel();
        $data['role'] = $roleModel->find($id);
        $permissionIdArray = json_decode($data['role']['permission_id']);
       // $value = explode(',', $data['role']['permission_id']);
        $data['permissions_1'] = $permissionModel->find();
        $data['permissions_2'] = $permissionModel->whereIn('id', $permissionIdArray)->findAll();

        if ($data['role']) {
            // If user is found, load the view and pass user data to it
            return view('/tables/role_table/edit_role',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/roles')->with('error', 'Role not found.');
        }
    }

    public function store()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'role_name' => 'required|max_length[255]',
            'category' => 'required'
        ]);
      

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $roleModel = new RoleModel();
            $request = service('request');
            $roleData = [
                'role_name' => $request->getPost('role_name'),
                'status' => $request->getPost('category'),
                'permission_id' => '['.'0'.']'
            ];

            if($roleModel->createRole($roleData)) {
                return redirect()->to('/dashboard/roles')->with('success', 'Feature added successfully.');
            } else {
                return redirect()->to('/dashboard/roles')->with('error', 'Failed to add feature.');
            }

            return redirect()->to('/dashboard/roles');
        }
    }
    public function update_role($id)
    {
        $validation = \Config\Services::validation();
       // 'email' => 'required|valid_email|is_unique[users.email]',
        $validation->setRules([
            'role_name' => 'required|max_length[255]',
            'category' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
                $roleModel = new RoleModel();
                $request = service('request');
                $userData = [
                    'role_name' => $request->getPost('role_name'),
                    'status' => $request->getPost('category')
                ];
                if($roleModel->update($id, $userData)){
                    return redirect()->to('/dashboard/roles')->with('success', 'Feature updated successfully.');
                } else {
                    return redirect()->to('/dashboard/roles')->with('error', 'Failed to update feature.');
                }

            return redirect()->to('/dashboard/roles')->with('error', 'Failed to update feature.');
        }
        return redirect()->to('/dashboard/roles')->with('error', 'Failed to update feature.');
    }
    
   
 


    public function delete_role($id) {
        // Fetch the product from the database
        $roleModel = new RoleModel();
      
        // Attempt to delete the feature
        if ($roleModel->delete($id)) {
            // Deletion successful, redirect with success message
            return redirect()->to('/dashboard/roles')->with('success', 'Feature deleted successfully.');
        } else {
            // Deletion failed, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/roles')->with('error', 'Failed to delete feature.');
        }   

    }

}
