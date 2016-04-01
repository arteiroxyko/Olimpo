<?php

/**
 * Description of c_categorias
 *
 * @author Loki
 */
class c_usuarios extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }

    //put your code here
    public function cadastrar(){
        $this->load->view('head/head');
        $this->load->model('m_contas');
        $this->load->view('menu/principal');
        $data['contas'] = $this->m_contas->listar();
        $this->load->view('usuarios/cadastrausuarios',$data);
        $this->load->view('footer/footer');        
    }

    public function editar($id){
        $this->load->model('m_usuarios');
        $this->load->model('m_contas');
        $data['usuarios'] = $this->m_usuarios->buscar($id);
        $data['contas'] = $this->m_contas->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('usuarios/editausuarios',$data);
        $this->load->view('footer/footer');
    }
    
    public function listar()
    {
        $this->load->model('m_usuarios');
        $data['usuarios'] = $this->m_usuarios->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('usuarios/listausuarios',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_usuarios');
        $this->m_usuarios->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_usuarios');
        if($this->m_usuarios->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_usuarios');
        $this->m_usuarios->excluir($id);      
        $this->listar();
    }
    
}
