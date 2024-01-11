<?php

namespace App\Models;

use CodeIgniter\Model;

class Vendas extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'vendas';
    protected $primaryKey       = 'vendas_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['vendas_quantidade', 'vendas_data', 'vendas_forma_pagamentos_id', 'vendas_funcionarios_id', 'vendas_clientes_id', 'vendas_produtos_id', 'vendas_pedidos_id'];

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


     public function getVendas(){
        return $this->select("*")
            ->join('produtos', 'vendas.vendas_produtos_id = produtos.produtos_id')
            ->join('funcionarios', 'vendas.vendas_funcionarios_id = funcionarios.funcionarios_id')
            ->join('clientes', 'vendas.vendas_clientes_id = clientes.clientes_id')
            ->join('pedidos', 'vendas.vendas_pedidos_id = pedidos.pedidos_id')
            ->join('forma_pagamentos', 'vendas.vendas_forma_pagamentos_id = forma_pagamentos.forma_pagamentos_id')
            ->orderBy('vendas.vendas_id', 'asc')
            ->findAll();
     }
}