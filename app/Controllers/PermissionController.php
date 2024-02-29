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


class PermissionController extends BaseController
{
    public function index()
    {
         // Check if user is logged in
         if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }

        $permissionModel = new PermissionModel();
        $data['permissions'] = $permissionModel->findAll();


        // Load dashboard view
        return view('/tables/permission_table/permissions_table', $data);
    }

    public function add_permission()
    {
        // Check if user is logged in
        if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }

        // Load dashboard view
        return view('/tables/permission_table/add_permission');
    }

    public function store()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'permission_name' => 'required|max_length[255]',
            'category' => 'required'
        ]);
      

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $permissionModel = new PermissionModel();
            $request = service('request');
            $permissionData = [
                'permission_name' => $request->getPost('permission_name'),
                'status' => $request->getPost('category')
            ];

            if($permissionModel->createPermission($permissionData)) {
                return redirect()->to('/dashboard/permissions')->with('success', 'Feature added successfully.');
            } else {
                return redirect()->to('/dashboard/permissions')->with('error', 'Failed to add feature.');
            }
        }
        return redirect()->to('/dashboard/permissions');
    }

    public function edit_permission($id) {
        $permissionModel = new PermissionModel();
        $data['permission'] = $permissionModel->find($id);
        //var_dump($user['firstname']);
        
        if ($data['permission']) {
            // If user is found, load the view and pass user data to it
            return view('/permission_table/edit_permission',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/permissions')->with('error', 'Role not found.');
        }
    }

    public function update_permission($id)
    {
        $validation = \Config\Services::validation();
       // 'email' => 'required|valid_email|is_unique[users.email]',
        $validation->setRules([
            'permission_name' => 'required|max_length[255]',
            'category' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
                $permissionModel = new PermissionModel();
                $request = service('request');
                $permissionData = [
                    'permission_name' => $request->getPost('permission_name'),
                    'status' => $request->getPost('category')
                ];
                if($permissionModel->update($id, $permissionData)){
                    return redirect()->to('/dashboard/permissions')->with('success', 'Feature updated successfully.');
                } else {
                    return redirect()->to('/dashboard/permissions')->with('error', 'Failed to update feature.');
                }

            return redirect()->to('/dashboard/permissions')->with('error', 'Failed to update feature.');
        }
        return redirect()->to('/dashboard/permissions')->with('error', 'Failed to update feature.');
    }

    public function delete_permission($id) {
        // Fetch the product from the database
        $permissionModel = new PermissionModel();
      
        // Attempt to delete the feature
        if ($permissionModel->delete($id)) {
            // Deletion successful, redirect with success message
            return redirect()->to('/dashboard/permissions')->with('success', 'Feature deleted successfully.');
        } else {
            // Deletion failed, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/permissions')->with('error', 'Failed to delete feature.');
        }   

    }
}