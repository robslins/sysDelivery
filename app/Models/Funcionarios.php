<?php

namespace App\Models;

use CodeIgniter\Model;

class Funcionarios extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'funcionarios';
    protected $primaryKey       = 'funcionarios_id';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['funcionarios_data_admissao', 'funcionarios_contrato', 'funcionarios_salario', 'funcionarios_cargo', 'funcionarios_usuarios_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}