<?php

/**
 * Description of c_fornecedores
 *
 * @author Loki
 */
class c_fornecedores extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }
    
    public function cadastrar(){
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('fornecedores/cadastrafornecedores');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_fornecedores');
        $data['fornecedores'] = $this->m_fornecedores->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('fornecedores/editafornecedores',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_fornecedores');
        $data['fornecedores'] = $this->m_fornecedores->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('fornecedores/listafornecedores',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_fornecedores');
        $this->m_fornecedores->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_fornecedores');
        if($this->m_fornecedores->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_fornecedores');
        $this->m_fornecedores->excluir($id);      
        $this->listar();
    }
    
}
