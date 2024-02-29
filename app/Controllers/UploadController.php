<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use App\Models\UserModel; // Add this line
use App\Models\RoleModel; // Add this line
use App\Models\PermissionModel; // Add this line
use App\Models\UploadModel; // Add this line
use App\Models\CommentModel; // Add this line
use CodeIgniter\HTTP\Request;
use CodeIgniter\Session\Session;
use Config\Services;
use App\Helpers\CaptchaHelper;
use CodeIgniter\Files\File;
class UploadController extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $value = $session->get('user');
         // Check if user is logged in
         if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }
    

        $uploadModel = new UploadModel();
        //$data['uploads'] = $uploadModel->findAll();
       // $data['uploads'] = $uploadModel->where('user_id', $value['id'])->findAll();
        $data['uploads'] = $uploadModel->where('user_id', $value['id'])->orderBy('upload_date', 'ASC')->findAll();

        // Load dashboard view
        return view('/tables/upload_table/uploads_table', $data);
    }

    public function filterUploadsQuearterly() {
        $uploadModel = new UploadModel();
        $request = service('request');
        $selectedYear = $request->getPost('year');
        $selectedQuarter =  $request->getPost('quarter');
        if ($selectedQuarter == 1) {
            $startDate = $selectedYear . "/01/01";
            $endDate = $selectedYear . "/03/31";
        } elseif ($selectedQuarter == 2) {
            $startDate = $selectedYear . "/04/01";
            $endDate = $selectedYear . "/06/30";
        } elseif ($selectedQuarter == 3) {
            $startDate = $selectedYear . "/07/01";
            $endDate = $selectedYear . "/09/30";
        } elseif ($selectedQuarter == 4) {
            $startDate = $selectedYear . "/10/01";
            $endDate = $selectedYear . "/12/31";
        } else {
            // Invalid quarter
            die("Invalid quarter selected.");
        }
        
        // Filter data based on the calculated start and end dates
        // $data['uploads'] = $uploadModel->where('upload_date >=', $startDate)
        //                                 ->where('upload_date <=', $endDate)
        //                                 ->orderBy('upload_date', 'ASC')
        //                                 ->findAll();
        $session = \Config\Services::session();
        $value = $session->get('user');
        $userId = $value['id'];
        $data['uploads'] = $uploadModel->where('user_id', $userId)
                                    ->where('upload_date >=', $startDate)
                                    ->where('upload_date <=', $endDate)
                                    ->orderBy('upload_date', 'ASC')
                                    ->findAll();
        return view('/tables/upload_table/uploads_table', $data);
    }

    public function filterUploadsYearly()
{
    $uploadModel = new UploadModel();
    $request = service('request');
    // Retrieve the selected year from the form data
    $selectedYear = $request->getPost('year');

    // Construct start and end dates for the selected year
    $startDate = $selectedYear . '/01/01';
    $endDate = $selectedYear . '/12/31';

    // Filter data based on the constructed start and end dates
    // $data['uploads'] = $uploadModel->where('upload_date >=', $startDate)
    //                                      ->where('upload_date <=', $endDate)
    //                                      ->orderBy('upload_date', 'ASC')
    //                                      ->findAll();
    $session = \Config\Services::session();
    $value = $session->get('user');
    $userId = $value['id'];
    $data['uploads'] = $uploadModel->where('user_id', $userId)
                                ->where('upload_date >=', $startDate)
                                ->where('upload_date <=', $endDate)
                                ->orderBy('upload_date', 'ASC')
                                ->findAll();
    // Pass filtered uploads to the view
    return view('/tables/upload_table/uploads_table', $data);
}

   

    public function  filterUploadsMonthly()
{
    $uploadModel = new UploadModel();
    $request = service('request');
    // Retrieve month and year from form data
    $selectedMonth = $request->getPost('month');
    $selectedYear = $request->getPost('year');

    // Construct start and end dates for the selected month
    $startDate = date('Y/m/01', strtotime($selectedYear . '-' . $selectedMonth . '-01'));
    $endDate = date('Y/m/t', strtotime($selectedYear . '-' . $selectedMonth . '-01'));
    // print_r($startDate."</br>");
    // print_r($endDate."</br>");
    // print_r($selectedMonth."</br>");
    // print_r($selectedYear."</br>");
    // Filter data based on the calculated start and end dates
    // $data['uploads'] = $uploadModel->where('upload_date >=', $startDate)
    //                                      ->where('upload_date <=', $endDate)
    //                                      ->orderBy('upload_date', 'ASC')
    //                                      ->findAll();
    $session = \Config\Services::session();
    $value = $session->get('user');
    $userId = $value['id'];
    $data['uploads'] = $uploadModel->where('user_id', $userId)
                                ->where('upload_date >=', $startDate)
                                ->where('upload_date <=', $endDate)
                                ->orderBy('upload_date', 'ASC')
                                ->findAll();

    // Pass filtered uploads to the view
    return view('/tables/upload_table/uploads_table', $data);
}

    public function filterUploads()
{
    $uploadModel = new UploadModel();
    $request = service('request');
    $startDate = $request->getPost('start_date');
    $endDate = $request->getPost('end_date');

    // Convert date format if needed
    $startDate = date('Y/m/d', strtotime($startDate));
    $endDate = date('Y/m/d', strtotime($endDate));
 


    // // Example filtering by upload date within the selected date range
    // $data['uploads'] = $uploadModel->where('upload_date >=', $startDate)
    //                                      ->where('upload_date <=', $endDate)
    //                                      ->orderBy('upload_date', 'ASC')
    //                                      ->findAll();
    $session = \Config\Services::session();
    $value = $session->get('user');
    $userId = $value['id'];
    $data['uploads'] = $uploadModel->where('user_id', $userId)
                                ->where('upload_date >=', $startDate)
                                ->where('upload_date <=', $endDate)
                                ->orderBy('upload_date', 'ASC')
                                ->findAll();

    // Pass filtered uploads to the view
    return view('/tables/upload_table/uploads_table', $data);
}

    public function view($id) {
        $uploadModel = new UploadModel();
        $data['upload'] = $uploadModel->find($id);

        //print_r($data['upload']['file_path']);

        $file_path = $data['upload']['file_path'];

        // Check if file exists
        if (file_exists($file_path)) {
            // Get file extension
            $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
          
            // Check if file extension is PDF, PNG, or JPG
            if ($extension === 'pdf') {
                $data['extension'] = $extension;
                $data['fileName'] = $data['upload']['file_path'];
                $this->viewPdf($data['upload']['file_path'], $id);
               return view('/tables/upload_table/view_upload', $data);
            }  else if ($extension === 'docx') {
                $data['fileName'] = $data['upload']['file_path'];
                $data['extension'] = $extension;
                $this->viewDocx($data['upload']['file_path'], $id) ;
                return view('/tables/upload_table/view_upload', $data);
            } else if ($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
                $data['extension'] = $extension;
                $this->viewImage($data['upload']['file_path'], $id);
                return view('/tables/upload_table/view_upload', $data);
            } else if ($extension === 'zip' || $extension === 'rar') {
                $data['extension'] = $extension;
                //echo $extension;
                //$this->viewCompress($data['upload']['file_path'], $id);
                return view('/tables/upload_table/view_upload', $data);
            } else {
              // echo 'File exists but has an invalid extension.';
            }
        } else {
            echo 'File does not exist.';
           // return view('/tables/upload_table/view_upload', $data);

        }
  
    }

    public function viewCompress($file_path, $id) {
        $uploadModel = new UploadModel();
        $data['upload'] = $uploadModel->find($id);
        // Path to your PDF file
        // Specify the path to the view_pdf.php file
        $filePath = FCPATH . 'view_upload/view_compress.php';
        $fileContent = file_get_contents($filePath);

        $newFileValue = 'C:/xampp/htdocs/system-integration-codeigniter4-2024/public/'.$file_path;


        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        // Check if file extension is PDF, PNG, or JPG
        if ($extension === 'zip' || $extension === 'rar') {
            //echo 'File exists and has a valid extension.';
            $newFileValue =  $newFileValue;

            // Perform modification to the file content
            $modifiedContent = preg_replace(
                '/\$file\s*=\s*[\'"].*?[\'"]\s*;/',
                '$file = \'' . $newFileValue . '\';',
                $fileContent
            );

                 // Write the modified content back to the file
                if (file_put_contents($filePath, $modifiedContent) !== false) {
                   // echo 'File modified successfully.';
                   // return view('/tables/upload_table/view_upload', $data);

                } else {
                    echo 'Failed to modify file.';
                    //return view('/tables/upload_table/view_upload', $data);
                } 
        } else {
           // echo 'File exists but has an invalid extension.';
        }

        // New value for the $file variable
       // return view('/tables/upload_table/view_upload', $data);

    }


    public function viewImage($file_path, $id) {
        $uploadModel = new UploadModel();
        $data['upload'] = $uploadModel->find($id);
        // Path to your PDF file
        // Specify the path to the view_pdf.php file
        $filePath = FCPATH . 'view_upload/view_image.php';
        $fileContent = file_get_contents($filePath);

        $newFileValue = 'C:/xampp/htdocs/system-integration-codeigniter4-2024/public/'.$file_path;


      //  $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                                                   
        // Check if file extension is PDF, PNG, or JPG
        if ($extension === 'png') {
            //echo 'File exists and has a valid extension.';
            $newFileValue =  $newFileValue;

            // Perform modification to the file content
            $modifiedContent = preg_replace(
                '/\$file\s*=\s*[\'"].*?[\'"]\s*;/',
                '$file = \'' . $newFileValue . '\';',
                $fileContent
            );

                 // Write the modified content back to the file
                if (file_put_contents($filePath, $modifiedContent) !== false) {
                   // echo 'File modified successfully.';
                   // return view('/tables/upload_table/view_upload', $data);

                } else {
                    echo 'Failed to modify file.';
                    //return view('/tables/upload_table/view_upload', $data);
                } 
        } else {
           // echo 'File exists but has an invalid extension.';
        }

        // New value for the $file variable
       // return view('/tables/upload_table/view_upload', $data);

    }

    public function viewDocx($file_path, $id) {
        $uploadModel = new UploadModel();
        $data['upload'] = $uploadModel->find($id);
        // Path to your PDF file
        // Specify the path to the view_pdf.php file
        $filePath = FCPATH . 'view_upload/view_docx.php';
        $fileContent = file_get_contents($filePath);

        $newFileValue = 'C:/xampp/htdocs/system-integration-codeigniter4-2024/public/'.$file_path;


        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        // Check if file extension is PDF, PNG, or JPG
        if ($extension === 'docx') {
            //echo 'File exists and has a valid extension.';
            $newFileValue =  $newFileValue;

            // Perform modification to the file content
            $modifiedContent = preg_replace(
                '/\$file\s*=\s*[\'"].*?[\'"]\s*;/',
                '$file = \'' . $newFileValue . '\';',
                $fileContent
            );

                 // Write the modified content back to the file
                if (file_put_contents($filePath, $modifiedContent) !== false) {
                   // echo 'File modified successfully.';
                   // return view('/tables/upload_table/view_upload', $data);

                } else {
                    echo 'Failed to modify file.';
                    //return view('/tables/upload_table/view_upload', $data);
                } 
        } else {
           // echo 'File exists but has an invalid extension.';
        }

        // New value for the $file variable
       // return view('/tables/upload_table/view_upload', $data);

    }

    public function viewPdf($file_path, $id) {
        $uploadModel = new UploadModel();
        $data['upload'] = $uploadModel->find($id);
        // Path to your PDF file
        // Specify the path to the view_pdf.php file
        $filePath = FCPATH . 'view_upload/view_pdf.php';
        $fileContent = file_get_contents($filePath);

        $newFileValue = 'C:/xampp/htdocs/system-integration-codeigniter4-2024/public/'.$file_path;


        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        // Check if file extension is PDF, PNG, or JPG
        if ($extension === 'pdf') {
            //echo 'File exists and has a valid extension.';
            $newFileValue =  $newFileValue;

            // Perform modification to the file content
            $modifiedContent = preg_replace(
                '/\$file\s*=\s*[\'"].*?[\'"]\s*;/',
                '$file = \'' . $newFileValue . '\';',
                $fileContent
            );

                 // Write the modified content back to the file
                if (file_put_contents($filePath, $modifiedContent) !== false) {
                   // echo 'File modified successfully.';
                   // return view('/tables/upload_table/view_upload', $data);

                } else {
                    echo 'Failed to modify file.';
                    //return view('/tables/upload_table/view_upload', $data);
                } 
        } else {
           // echo 'File exists but has an invalid extension.';
        }

        // New value for the $file variable
       // return view('/tables/upload_table/view_upload', $data);

    }




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
    public function add_upload()
    {
        // Check if user is logged in
        if (!session()->get('user')) {
            return redirect()->to('/login'); // Redirect to login page if user is not logged in
        }
        $uploadModel = new UploadModel();
        $data['uploads'] = $uploadModel->findAll();

        // Load dashboard view
        return view('/tables/upload_table/add_upload',$data);
    }

    public function edit_upload($id) {
        $roleModel = new RoleModel();
        $userModel = new UserModel();
        $uploadModel = new UploadModel();
        $data['roles'] = $roleModel->findAll();
        $data['upload'] = $uploadModel->find($id);
        //var_dump($user['firstname']);
        
        if ($data['upload']) {
            // If user is found, load the view and pass user data to it
            return view('/tables/upload_table/edit_upload',$data);
        } else {
            // If user is not found, show an error or redirect as necessary
            return redirect()->to('/dashboard/uploads')->with('error', 'Feature not found.');
        }
    }
    
    public function store(){
        $uploadModel = new UploadModel();
        $data['uploads'] = $uploadModel->findAll();
        if(!is_dir('./uploads/'))
        mkdir('./uploads/');
        //$label = $this->request->getPost('file_name');
       
        $session = \Config\Services::session();
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'file' => 'uploaded[file]'
        ]);
      
        //if ($validation->run($_FILES) === false) {
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $file = $this->request->getFile('file');
            $fname = $file->getName();
            $value = $session->get('user');
            $folder_path = 'uploads/'. $value['username']; // Example folder path
            $currentDate = date('Y/m/d');
  
                $check = $uploadModel->where('file_path', $folder_path.'/'.$fname)->countAllResults();
                if($check == 0){
                    $fname = $file->getName();
                    if($file->move($folder_path.'/', $fname)){
                        $fileData = [
                            "file_name" => $fname ,
                            "file_path" => $folder_path.'/'.$fname,
                            "user_id"   => $value['id'],
                            "upload_date" => $currentDate,
                            "file_type" => $file->getClientMimeType(), // Get file type
                            "file_size" => $this->formatBytes($file->getSize(), $precision = 2) // Get file size
                        ];

                        if($uploadModel->createUpload($fileData)) {
                            return redirect()->to('/dashboard/uploads')->with('success', 'Feature added successfully.');
                        } else {
                            return redirect()->to('/dashboard/uploads')->with('error', 'File failed upload.');
                        }
                    } else {
                        return redirect()->to('/dashboard/uploads')->with('error', 'File failed to transfer.');
                    }
                } else if($check >= 1) {
                    return redirect()->to('/dashboard/uploads')->with('error', 'File upload already exist.');
                }

        }
       
        return redirect()->to('/dashboard/uploads')->with('error', 'File upload failed.');
    }

    public function comment_upload($upload_id) {
      // print_r($upload_id);
      
  

        $userModel = new UserModel();
        $uploadModel = new UploadModel();
        $commentModel = new CommentModel();

        //$data['comments'] = $commentModel->where('upload_id', $upload_id)->findAll();
        $data['comments'] = $commentModel
        ->select('comments.*, users.firstname,users.lastname') // Assuming you have a 'users' table with 'username'
        ->join('users', 'users.id = comments.user_id') // Assuming 'id' is the primary key in 'users' table
        ->where('upload_id', $upload_id)
        ->findAll();
       // $data['comments'] = $commentModel->findall();
    // print_r($data['comments']);
        $data['upload'] = $uploadModel->find($upload_id);
        $extension = strtolower(pathinfo($data['upload']['file_path'], PATHINFO_EXTENSION));

        $data['extension'] = $extension;
        //print_r($data['upload']['user_id']);
        $data['user'] = $userModel->find($data['upload']['user_id']);
       return view('/tables/upload_table/comment_upload',$data);
    }

    public function comment_upload_delete($comment_id, $upload_id) {
        $commentModel = new CommentModel();
    
        if ($commentModel->delete($comment_id)) {
            return redirect()->to(route_to('uploadComment', $upload_id));
        } else {
            return redirect()->to(route_to('uploadComment', $upload_id));
        }  
    }

    public function comment_upload_edit($id) {
        print_r("edit:".$id);
    }

    public function comment_upload_copy_link($id) {
        print_r("copy_link:".$id);
    }

    public function comment_upload_post($upload_id) {
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();
        $request = service('request');
        $commentModel = new CommentModel();
        $uploadModel = new UploadModel();
        $userModel = new UserModel();
        
        $value = session()->get('user');
        $data['upload'] = $uploadModel->find($upload_id);
       // $data['user'] = $userModel->find($value['id']);
        //$data['comment'] = $commentModel->find($upload_id);
        $data['comments'] = $commentModel->where('upload_id', $upload_id)->findAll();
       // print_r($upload_id);

       $validation->setRules([
           'comment' => 'required'
       ]);
        if ($validation->withRequest($this->request)->run()) {
      // if ($this->request->isAJAX()) {
            $commentData = [
                'comments' => $request->getPost('comment'),
                'upload_id' => $upload_id,
                'user_id' => $value['id']
            ];
            if($commentModel->createComment($commentData)) {
                return redirect()->to(route_to('uploadComment', $upload_id));
            } else {
                return redirect()->to(route_to('uploadComment', $upload_id));
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }
    
    public function update_upload($id, $fileName) {
        // Fetch the product from the database
        $uploadModel = new UploadModel();
        $session = \Config\Services::session();
        $value = $session->get('user');
        //var_dump($userModel->find($id));
        //$filePath = base_url('uploads/' . $fileName);
        $filePath = FCPATH . 'uploads/'. $value['username'] . '/' . $fileName;
        //$filePath = FCPATH . 'uploads/' . $fileName;
         // Validate the ID
   
        if (!$uploadModel->find($id)) {
            // Feature not found, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/uploads')->with('error', 'Feature not found.');
        } else {
            $session = \Config\Services::session();
            $validation = \Config\Services::validation();
       
            $validation->setRules([
                'file' => 'uploaded[file]'
            ]);
          //  print_r("updated successfully");

            //if ($validation->run($_FILES) === false) {
            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            } else {
                $file = $this->request->getFile('file');
                $fname = $file->getName();
                $folder_path = 'uploads/'. $value['username']; // Example folder path
                $currentDate = date('Y/m/d');
                print_r("updated successfully");
                if (unlink($filePath)) {
                    $check = $uploadModel->where('file_path', $folder_path.'/'.$fname)->countAllResults();
                    if($check == 0){
                        if($file->move($folder_path.'/', $fname)){
                            $fileData = [
                                "file_name" => $fname ,
                                "file_path" => $folder_path.'/'.$fname,
                                "upload_date" => $currentDate,
                                "file_type" => $file->getClientMimeType(), // Get file type
                                "file_size" => $this->formatBytes($file->getSize(), $precision = 2) // Get file size
                            ];

                            if($uploadModel->update($id, $fileData)) {
                                return redirect()->to('/dashboard/uploads')->with('success', 'Feature updated successfully.');
                            } else {
                                return redirect()->to('/dashboard/uploads')->with('error', 'File failed to update.');
                            }
                        }  else {
                            return redirect()->to('/dashboard/uploads')->with('error', 'File failed to transfer.');
                        }
                    } else if($check >= 1){
                        return redirect()->to('/dashboard/uploads')->with('error', 'File upload already exist.');
                    }
                } else {
                    return redirect()->to('/dashboard/uploads')->with('error', 'Failed to delete file.');
                }
            }
        }
    }
    public function test() {
        return view('test');
    }

    public function delete_upload($id, $fileName) {
        // Fetch the product from the database
        $uploadModel = new UploadModel();
        $session = \Config\Services::session();
        $value = $session->get('user');
        //var_dump($userModel->find($id));
        //$filePath = base_url('uploads/' . $fileName);
        $filePath = FCPATH . 'uploads/'. $value['username'] . '/' . $fileName;
        //$filePath = FCPATH . 'uploads/' . $fileName;
         // Validate the ID

        if (!$uploadModel->find($id)) {
            // Feature not found, handle error (e.g., show an error message)
            return redirect()->to('/dashboard/uploads')->with('error', 'Feature not found.');
        } else {

            if (unlink($filePath)) {
                    // Attempt to delete the feature
                if ($uploadModel->delete($id)) {
                    //return redirect()->to('/dashboard/uploads')->with('success', 'Feature deleted successfully.');
                    return redirect()->to('/dashboard/uploads')->with('success', 'File deleted successfully.');
                } else {
                    // Deletion failed, handle error (e.g., show an error message)
                    return redirect()->to('/dashboard/uploads')->with('error', 'Failed to delete feature.');
                }  
            } else {
                return redirect()->to('/dashboard/uploads')->with('error', 'Failed to delete file.');
            }
        }
    }
}
