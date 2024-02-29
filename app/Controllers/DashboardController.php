<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel; // Add this line
use App\Models\UploadModel; // Add this line
use App\Models\RoleModel; // Add this line
use CodeIgniter\HTTP\Request;
use CodeIgniter\Session\Session;
use Config\Services;
use App\Helpers\CaptchaHelper;


class DashboardController extends Controller
{
        public function index()
    {
        $session = \Config\Services::session();
        $uploadModel = new UploadModel();
        // Check if user is logged in
        if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }
        //helper('filesystem');
        $value = $session->get('user');
        // Define the folder path
        if($value['is_super_admin'] == 1) {
            $folder_path = FCPATH . 'uploads/'; // Example folder path
        }
       if($value['is_admin'] == 0 || $value['is_super_admin'] == 0 || $value['is_super_admin'] == 1) {
            $folder_path = FCPATH . 'uploads/'. $value['username']; // Example folder path
        }
        
        // Check if the folder exists
        if (!is_dir($folder_path)) {
             // Create the folder recursively
            if (!mkdir($folder_path, 0777, true)) {
                die("Failed to create folder.");
            }
          //  die("The specified folder does not exist or is not accessible.");
        }
        
        // Get the folder size recursively
        $folder_size = $this->getFolderSize($folder_path);
        
        // Convert bytes to KB, MB, etc. for better readability
        $folder_size_readable = $this->formatBytes($folder_size);

        $userModel = new UserModel();
        $data['user_count'] = $userModel->whereIn('role_id', [0, 1])->countAllResults();
        $data['admin_count'] = $userModel->where('is_admin', 1)->countAllResults();
        $data['staff_count'] = $userModel->whereNotIn('role_id', [0, 1, 2])->countAllResults();
       // $data['staff_count'] = 1;
        $data['folder_size'] = $folder_size_readable;

        $data['file_count'] = $uploadModel->where('user_id', $value['id'])->countAllResults();

       // print_r($value['is_admin']);
        // Load dashboard view
        if($value['is_super_admin'] == 1 && $value['is_admin'] == 0) {
             return view('dashboards/super_admin_dashboard', $data);
        }
        if($value['is_admin'] == 1 && $value['is_super_admin'] == 0) {
            return view('dashboards/admin_dashboard', $data);
        }
        if($value['is_admin'] == 0 && $value['is_super_admin'] == 0) {
             return view('dashboards/user_dashboard', $data);
       }

    }

    
    private function getFolderSize($folder_path) {
        // Initialize folder size
        $folder_size = 0;

        // Get the list of files and directories in the folder
        $items = scandir($folder_path);

        // Remove "." and ".." from the list
        $items = array_diff($items, array('.', '..'));

        // Iterate through items
        foreach ($items as $item) {
            // Get the item path
            $item_path = $folder_path . '/' . $item;

            // If the item is a file, add its size to the folder size
            if (is_file($item_path)) {
                $folder_size += filesize($item_path);
            }
            // If the item is a directory, recursively call the function to get its size
            elseif (is_dir($item_path)) {
                $folder_size += $this->getFolderSize($item_path);
            }
        }

        return $folder_size;
    }

    // Helper function to convert bytes to KB, MB, etc.
    // Helper function to convert bytes to KB, MB, etc.
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('bytes', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        //return round($bytes, $precision) . ' ' . $units[$pow] . '('.$bytes.')';
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function edit_profile() {
        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();

        return view('profiles/edit_profile',$data);
    }

    
    public function update_profile($id)
    {
        $validation = \Config\Services::validation();
       // 'email' => 'required|valid_email|is_unique[users.email]',
        $validation->setRules([
            'fname' => 'required|min_length[5]|max_length[255]',
            'lname' => 'required|min_length[5]|max_length[255]',
            'uname' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email',
            'confirm_password' => 'matches[password]',
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

            if($request->getPost('password') != NULL) {
                $userData = [
                    'firstname' => $request->getPost('fname'),
                    'lastname' => $request->getPost('lname'),
                    'username' => $request->getPost('uname'),
                    'email' => $request->getPost('email'),
                    'role_id' => $request->getPost('category'),
                    'role_name' => $data['roles']['0']['role_name'],
                    'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT)
                ];
                if($userModel->update($id, $userData)){
                    return redirect()->to('/dashboard/users')->with('success', 'Feature updated successfully.');
                } else {
                    return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
                }
            } else {
                $userData = [
                    'firstname' => $request->getPost('fname'),
                    'lastname' => $request->getPost('lname'),
                    'username' => $request->getPost('uname'),
                    'role_name' => $data['roles']['0']['role_name'],
                    'role_id' => $request->getPost('category'),
                    'email' => $request->getPost('email')
                ];
                if($userModel->update($id, $userData)){
                    return redirect()->to('/dashboard/users')->with('success', 'Feature updated successfully.');
                } else {
                    return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
                }
            }
            return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
        }
        return redirect()->to('/dashboard/users')->with('error', 'Failed to update feature.');
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();

        // Redirect to login page
        return redirect()->to('/login');
    }
}
