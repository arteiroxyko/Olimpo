<?php

/**
 * Description of c_categorias
 *
 * @author Loki
 */
class c_categorias extends CI_Controller{

    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }
    
    public function cadastrar(){
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('categorias/cadastracategorias');
        $this->load->view('footer/footer');        
    }

    public function editar($id){
        $this->load->model('m_categorias');
        $data['categorias'] = $this->m_categorias->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('categorias/editacategorias',$data);
        $this->load->view('footer/footer');
    }

    public function listar()
    {
        $this->load->model('m_categorias');
        $data['categorias'] = $this->m_categorias->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('categorias/listacategorias',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_categorias');
        $this->m_categorias->salvar($id);        
        $this->listar();
    }

    public function gravar(){
        $this->load->model('m_categorias');
        if($this->m_categorias->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    
    public function excluir($id){
        $this->load->model('m_categorias');
        $this->m_categorias->excluir($id);      
        $this->listar();
    }
    
}
