<?php

/**
 * Description of c_categorias
 *
 * @author Loki
 */
class c_contas extends CI_Controller{
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
        $this->load->view('contas/cadastracontas');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_contas');
        $data['contas'] = $this->m_contas->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('contas/editacontas',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_contas');
        $data['contas'] = $this->m_contas->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('contas/listacontas',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_contas');
        $this->m_contas->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_contas');
        if($this->m_contas->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_contas');
        $this->m_contas->excluir($id);      
        $this->listar();
    }
    
}
