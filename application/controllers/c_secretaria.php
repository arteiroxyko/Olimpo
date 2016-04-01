<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_secretaria extends CI_Controller { 

	function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }

	public function registrarEntrada()
	{
		$this->load->model('m_categorias');
		$this->load->model('m_contas');
		$this->load->view('head/head');
		$this->load->view('menu/principal');
		$data['contas'] = $this->m_contas->listar();
		$data['categorias'] = $this->m_categorias->buscaEntradas();
		$this->load->view('financeiro/registro_entradas',$data);
		$this->load->view('footer/footer');
	}
	public function registrarSaida()
	{
		$this->load->model('m_categorias');
		$this->load->model('m_contas');
		$this->load->view('head/head');
		$this->load->view('menu/principal');
		$data['contas'] = $this->m_contas->listar();
		$data['categorias'] = $this->m_categorias->buscaSaidas();
		$this->load->view('financeiro/registro_saidas',$data);
		$this->load->view('footer/footer');
	}
}
