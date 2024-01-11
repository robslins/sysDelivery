<?php

namespace App\Controllers;
use App\Models\Clientes as Clientes_model;
use App\Models\Usuarios as Usuarios_model;

class Clientes extends BaseController
{
    private $clientes;
    private $usuarios;
    public function __construct(){
        $this->clientes = new Clientes_model();
        $this->usuarios = new Usuarios_model();
        $data['title'] = 'Clientes';
        helper('functions');
    }
    public function index(): string
    {
        $data['title'] = 'Clientes';
        $data['clientes'] = $this->clientes->join('usuarios', 'clientes_usuarios_id = usuarios_id')->find();
        return view('Clientes/index',$data);
    }

    public function new(): string
    {
        $data['title'] = 'Clientes';
        $data['op'] = 'create';
        $data['form'] = 'cadastrar';
        $data['usuarios'] = $this->usuarios->findAll();
        $data['clientes'] = (object) [
            'clientes_usuarios_id'=> '',
            'clientes_data_cadastro'=> '',
            'clientes_id'=> ''
            
        ];
        return view('Clientes/form',$data);
    }

    
    public function create()
    {

        // Checks whether the submitted data passed the validation rules.
        if(!$this->validate([
            'clientes_data_cadastro' => 'required|max_length[255]|min_length[3]',
        ])) {
            
            // The validation fails, so returns the form.
            $data['clientes'] = (object) [
                //'categorias_id' => $_REQUEST['categorias_id'],
                'clientes_data_cadastro' => $_REQUEST['clientes_data_cadastro'],
                'clientes_usuarios_id' => $_REQUEST['clientes_usuarios_id']
            ];
            
            $data['title'] = 'Clientes';
            $data['form'] = 'Cadastrar';
            $data['op'] = 'create';
            return view('Clientes/form',$data);
        }


        $this->clientes->save([
            'clientes_data_cadastro' => $_REQUEST['clientes_data_cadastro'],
            'clientes_usuarios_id' => $_REQUEST['clientes_usuarios_id']

        ]);
        
        $data['msg'] = msg('Cadastrado com Sucesso!','success');
        $data['clientes'] = $this->clientes->join('usuarios', 'clientes_usuarios_id = usuarios_id')->find();
        $data['title'] = 'Clientes';
        return view('Clientes/index',$data);

    }

    public function delete($id)
    {

        $this->clientes->where('clientes_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['clientes'] = $this->clientes->join('usuarios', 'clientes_usuarios_id = usuarios_id')->find();
        $data['title'] = 'Clientes';
        return view('Clientes/index',$data);
    }

    public function edit($id)
    {
        $data['usuarios'] = $this->usuarios->findAll();
        $data['clientes'] = $this->clientes->find(['clientes_id' => (int) $id])[0];
        $data['title'] = 'Clientes';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Clientes/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'clientes_data_cadastro' => $_REQUEST['clientes_data_cadastro'],
            'clientes_usuarios_id' => $_REQUEST['clientes_usuarios_id']
        ];

        $this->clientes->update($_REQUEST['clientes_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['clientes'] = $this->clientes->findAll();
        $data['title'] = 'Clientes';
        return view('Clientes/index',$data);
    }

    public function search()
    {

        $data['clientes'] = $this->clientes->join('usuarios', 'clientes_usuarios_id = usuarios_id')->like('clientes_usuarios_id', $_REQUEST['pesquisar'])->find();
        $total = count($data['clientes']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Clientes';
        return view('Clientes/index',$data);

    }

}