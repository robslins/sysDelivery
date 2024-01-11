<?php

namespace App\Models;

use CodeIgniter\Model;

class Entregas extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'entregas';
    protected $primaryKey       = 'entregas_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['entregas_data_saida', '	entregas_data_entrega', 'entregas_status', 'entregas_observacao', 'entregas_vendas_id', 'entregas_funcionarios_id'];

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


     public function getEntregas(){
        return $this->select("*")
            ->join('vendas', 'entregas.entregas_vendas_id = vendas.vendas_id')
            ->join('funcionarios', 'entregas.entregas_funcionarios_id = funcionarios.funcionarios_id')
            ->orderBy('entregas.entregas_id', 'asc')
            ->findAll();
     }
}