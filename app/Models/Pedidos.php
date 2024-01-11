<?php

namespace App\Models;

use CodeIgniter\Model;

class Pedidos extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pedidos';
    protected $primaryKey       = 'pedidos_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pedidos_data', 'pedidos_produtos_id', 'pedidos_funcionarios_id', 'pedidos_clientes_id'];

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


     public function getPedidosProdutosFuncClientes(){
        return $this->select("*")
            ->join('produtos', 'pedidos.pedidos_produtos_id = produtos.produtos_id')
            ->join('funcionarios', 'pedidos.pedidos_funcionarios_id = funcionarios.funcionarios_id')
            ->join('clientes', 'pedidos.pedidos_clientes_id = clientes.clientes_id')
            ->orderBy('pedidos.pedidos_id', 'asc')
            ->findAll();
     }
}