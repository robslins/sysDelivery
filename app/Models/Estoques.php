<?php

namespace App\Models;

use CodeIgniter\Model;

class Estoques extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'estoques';
    protected $primaryKey       = 'estoques_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['estoques_quantidade', 'estoques_data_compra', 'estoques_data_validade', 'estoques_lote', 'estoques_produtos_id', 'estoques_funcionarios_id'];

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


     public function getEstoquesComProdutosFuncionarios(){
        return $this->select("*")
            ->join('produtos', 'estoques.estoques_produtos_id = produtos.produtos_id')
            ->join('funcionarios', 'estoques.estoques_funcionarios_id = funcionarios.funcionarios_id' )
            ->orderBy('estoques.estoques_id', 'asc')
            ->findAll();

     }
}