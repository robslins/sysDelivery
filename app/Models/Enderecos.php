<?php

namespace App\Models;

use CodeIgniter\Model;

class Enderecos extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'enderecos';
    protected $primaryKey       = 'enderecos_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['enderecos_cep', 'enderecos_logradouro', 'enderecos_numero', 'enderecos_complemento', 'enderecos_bairro', 'enderecos_cidades_id', 'enderecos_usuarios_id'];

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

    public function getEnderecosComUsuarios(){
        return $this->select("*")
            ->join('usuarios', 'enderecos.enderecos_usuarios_id = usuarios.usuarios_id')
            ->join('cidades', 'enderecos.enderecos_cidades_id = cidades.cidades_id' )
            ->orderBy('enderecos.enderecos_id', 'asc')
            ->findAll();

     }
}