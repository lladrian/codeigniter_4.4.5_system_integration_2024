<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'RegisterController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/recovery_account', 'RecoveryController::recovery_account');
$routes->post('/email_verification', 'RecoveryController::email_verification');

$routes->get('/recovery_code', 'RecoveryController::recovery_code');


$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboard/profile', 'DashboardController::edit_profile');
$routes->get('/dashboard/logout', 'DashboardController::logout');
$routes->post('/dashboard/profile/update/(:num)', 'DashboardController::update_profile/$1'); //update of data
$routes->post('/register', 'RegisterController::store');
$routes->post('/login', 'LoginController::authenticate');

$routes->get('/dashboard/test', 'UserController::test');
$routes->get('/dashboard/users', 'UserController::index');
$routes->get('/dashboard/user/add_user', 'UserController::add_user');
$routes->get('/dashboard/user/edit/(:num)', 'UserController::edit_user/$1');//show and about to update
$routes->post('/dashboard/user/store', 'UserController::store');//store of insert data
$routes->post('/dashboard/user/update/(:num)', 'UserController::update_user/$1'); //update of data
$routes->post('/dashboard/user/delete/(:num)', 'UserController::delete_user/$1');//delete
$routes->post('/dashboard/user_permission/store/(:num)', 'UserController::add_user_permission/$1');//store of insert data
$routes->post('/dashboard/user_permission/delete/(:num)/(:num)', 'UserController::delete_user_permission/$1/$2');//delete
$routes->get('/dashboard/user_permission/edit/(:num)', 'UserController::edit_user_permission/$1');//show and about to update


$routes->get('/dashboard/admins', 'AdminController::index');
$routes->get('/dashboard/admin/add_admin', 'AdminController::add_user');
$routes->get('/dashboard/admin/edit/(:num)', 'AdminController::edit_user/$1');//show and about to update
$routes->post('/dashboard/admin/store', 'AdminController::store');//store of insert data
$routes->post('/dashboard/admin/update/(:num)', 'AdminController::update_user/$1'); //update of data
$routes->post('/dashboard/admin/delete/(:num)', 'AdminController::delete_user/$1');//delete
$routes->get('/dashboard/admin_permission/edit/(:num)', 'AdminController::edit_admin_permission/$1');//show and about to update
$routes->get('/dashboard/permissions', 'PermissionController::index');
$routes->get('/dashboard/permission/add_permission', 'PermissionController::add_permission');
$routes->get('/dashboard/permission/edit/(:num)', 'PermissionController::edit_permission/$1');//show and about to update
$routes->post('/dashboard/permission/store', 'PermissionController::store');//store of insert data
$routes->post('/dashboard/permission/update/(:num)', 'PermissionController::update_permission/$1'); //update of data
$routes->post('/dashboard/permission/delete/(:num)', 'PermissionController::delete_permission/$1');//delete


$routes->get('/dashboard/roles', 'RoleController::index');
$routes->get('/dashboard/role/add_role', 'RoleController::add_role');
$routes->get('/dashboard/role/edit/(:num)', 'RoleController::edit_role/$1');//show and about to update
$routes->post('/dashboard/role/store', 'RoleController::store');//store of insert data
$routes->post('/dashboard/role/update/(:num)', 'RoleController::update_role/$1'); //update of data
$routes->post('/dashboard/role/delete/(:num)', 'RoleController::delete_role/$1');//delete
$routes->post('/dashboard/role_permission/delete/(:num)/(:num)', 'RoleController::delete_role_permission/$1/$2');//delete
$routes->post('/dashboard/role_permission/store/(:num)', 'RoleController::add_role_permission/$1');//store of insert data
$routes->get('/dashboard/role_permission/edit/(:num)', 'RoleController::edit_role_permission/$1');//show and about to update


$routes->get('/dashboard/uploads', 'UploadController::index');
$routes->get('/dashboard/upload/view_upload_id/(:num)', 'UploadController::view/$1');
$routes->get('/dashboard/upload/view_upload/(:any)', 'UploadController::viewUpload/$1');
$routes->get('/dashboard/upload/add_upload', 'UploadController::add_upload');
$routes->get('/dashboard/upload/comment/(:num)', 'UploadController::comment_upload/$1', ['as' => 'uploadComment']);//show and about to update
$routes->get('/dashboard/upload/edit/(:num)', 'UploadController::edit_upload/$1');//show and about to update
$routes->post('/dashboard/upload/store', 'UploadController::store');//store of insert data
$routes->post('/dashboard/upload/update/(:num)/(:any)', 'UploadController::update_upload/$1/$2'); //update of data
$routes->post('/dashboard/upload/comment_upload_post/(:num)', 'UploadController::comment_upload_post/$1'); //update of data
$routes->get('/dashboard/upload/comment/edit/(:num)', 'UploadController::comment_upload_edit/$1'); //update of data
$routes->post('/dashboard/upload/comment/delete/(:num)/(:num)', 'UploadController::comment_upload_delete/$1/$2'); //update of data
$routes->post('/dashboard/upload/comment/copy_link/(:num)', 'UploadController::comment_upload_copy_link/$1'); //update of data
$routes->post('/dashboard/upload/delete/(:num)/(:any)', 'UploadController::delete_upload/$1/$2');//delete
$routes->post('/dashboard/uploads/filter', 'UploadController::filterUploads');
$routes->post('/dashboard/uploads/filterQuarterly', 'UploadController::filterUploadsQuearterly');
$routes->post('/dashboard/uploads/filterMonthly', 'UploadController::filterUploadsMonthly');
$routes->post('/dashboard/uploads/filterYearly', 'UploadController::filterUploadsYearly');


$routes->get('/test', 'UploadController::test');
$routes->get('/display', 'DocxToPdf::index');
$routes->get('/smtp', 'EmailController::index');



