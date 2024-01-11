<?php

namespace App\Controllers;
use App\Models\Enderecos as Enderecos_model;
use App\Models\Cidades as Cidades_model;
use App\Models\Usuarios as Usuarios_model;


class Enderecos extends BaseController
{
    private $enderecos;
    private $cidades;
    private $usuarios;
    public function __construct(){
        $this->enderecos = new Enderecos_model();
        $this->cidades = new Cidades_model();
        $this->usuarios = new Usuarios_model();
        $data['title'] = 'Enderecos';
        helper('functions');
    }

    public function index(): string
    {
        $data['title'] = 'Enderecos';
        $data['enderecos'] = $this->enderecos->getEnderecosComUsuarios();
        return view('Enderecos/index',$data);
    }
    public function new(): string
    {
        $data['title'] = 'Enderecos';
        $data['op'] = 'create';
        $data['form'] = 'Cadastrar';
        $data['cidades'] = $this->cidades->findAll();
        $data['usuarios'] = $this->usuarios->findAll();
        $data['enderecos'] = (object) [
            'enderecos_id' => '',
            'enderecos_cep' => '',
            'enderecos_logradouro' => '',
            'enderecos_numero' => '',
            'enderecos_complemento' => '',
            'enderecos_bairro' => '',
            'enderecos_cidades_id' => '',
            'enderecos_usuarios_id' => ''];
            return view('Enderecos/form',$data);
    }

    public function create()
    {
        helper(["form", "url"]);
        $regrasValidacao = [
            'enderecos_logradouro' => 'required|max_length[255]|min_length[3]'
        ];

            if($this->validate($regrasValidacao)){
                $this->enderecos->save([
                    'enderecos_cep' => $this->request['enderecos_cep'],
                    'enderecos_logradouro' => $this->request['enderecos_logradouro'],
                    'enderecos_numero' => $this->request['enderecos_numero'],
                    'enderecos_complemento' => $this->request['enderecos_complemento'],
                    'enderecos_bairro' => $this->request['enderecos_bairro'],
                    'enderecos_cidades_id' => $this->request['enderecos_cidades_id'],
                    'enderecos_usuarios_id' => $this->request['enderecos_usuarios_id']
                ]);
                
                
                $data['msg'] = msg('Cadastrado com Sucesso!','success');
                $data['enderecos'] = $this->enderecos->getEnderecosComUsuarios();
                $data['title'] = 'Enderecos';
                return view('Enderecos/index',$data);
            } 
            
            else {
                $data['enderecos'] = (object) [
                    'enderecos_cep' => $_REQUEST['enderecos_cep'],
                    'enderecos_logradouro' => $_REQUEST['enderecos_logradouro'],
                    'enderecos_numero' => $_REQUEST['enderecos_numero'],
                    'enderecos_complemento' => $_REQUEST['enderecos_complemento'],
                    'enderecos_bairro' => $_REQUEST['enderecos_bairro'],
                    'enderecos_cidades_id' => $_REQUEST['enderecos_cidades_id'],
                    'enderecos_usuarios_id' => $_REQUEST['enderecos_usuarios_id'],
                    'enderecos_id' => $_REQUEST['enderecos_id']
                ];
                
                $data['cidades'] = $this->cidades->findAll();
                $data['usuarios'] = $this->usuarios->findAll();
                $data['title'] = 'Enderecos';
                $data['form'] = 'Cadastrar';
                $data['op'] = 'create';
                $data['msg'] = msg($this->validator->listErrors(), "danger");
                return view('Enderecos/form',$data);
            }

    }

    public function delete($id)
    {

        $this->enderecos->where('enderecos_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['enderecos'] = $this->enderecos->getEnderecosComUsuarios();
        $data['title'] = 'Enderecos';
        return view('Enderecos/index',$data);
    }

    public function edit($id)
    {
        $data['cidades'] = $this->cidades->findAll();
        $data['usuarios'] = $this->usuarios->findAll();
        $data['enderecos'] = $this->enderecos->find(['enderecos_id' => (int) $id])[0];
        $data['title'] = 'Enderecos';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Enderecos/form',$data);
    }

    public function update()
    {
        $dataForm = [
                'enderecos_cep' => $_REQUEST['enderecos_cep'],
                'enderecos_logradouro' => $_REQUEST['enderecos_logradouro'],
                'enderecos_numero' => $_REQUEST['enderecos_numero'],
                'enderecos_complemento' => $_REQUEST['enderecos_complemento'],
                'enderecos_bairro' => $_REQUEST['enderecos_bairro'],
                'enderecos_cidades_id' => $_REQUEST['enderecos_cidades_id'],
                'enderecos_usuarios_id' => $_REQUEST['enderecos_usuarios_id']
        ];

        $this->enderecos->update($_REQUEST['enderecos_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['enderecos'] = $this->enderecos->getEnderecosComUsuarios();
        $data['title'] = 'Enderecos';
        return view('Enderecos/index',$data);
    }

    public function search()
    {

        $data['enderecos'] = $this->enderecos->join('cidades', 'enderecos_cidades_id = cidades_id')->join('usuarios', 'enderecos_usuarios_id = usuarios_id')->like('cidades_nome', $_REQUEST['pesquisar'])->orlike('usuarios_nome', $_REQUEST['pesquisar'])->find();
        $total = count($data['enderecos']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Enderecos';
        return view('Enderecos/index',$data);

    }
}