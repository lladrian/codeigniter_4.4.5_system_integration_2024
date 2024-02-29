<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['firstname', 'lastname', 'username', 'email', 'password', 'mobile', 'role_name', 'role_id', 'is_admin', 'permission_id'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getCommentsWithUser()
    {
        return $this->db->table('comments')
            ->select('comments.*, users.firstname, users.lastname')
            ->join('users', 'users.id = comments.user_id')
            ->get()
            ->getResult();
    }

    public function createUser($data)
    {
        return $this->insert($data);
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
