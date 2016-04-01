<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_carne_fornecedores extends CI_Controller {

    function __construct() {
      	parent::__construct();
      	if (!isset($this->session->userdata['Ativo'])) {
           	header('location: '.site_url());
  		}
    }

     public function cadastrarParcelas($carNum){
          $this->load->model('m_carnes_fornecedores');
          $this->load->view('head/head');
          $data['carnes'] = $this->m_carnes_fornecedores->BuscaCarnes($carNum);
          $this->load->view('menu/principal');
          $this->load->view('carne_fornecedores/cadastra_parcelas',$data);
          $this->load->view('footer/footer');        
     }
     public function editarParcelas($id){
          $this->load->model('m_carnes_fornecedores');
          $this->load->model('m_turnos');
          $data['parcela'] = $this->m_carnes_fornecedores->buscarParcela($id);
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $this->load->view('carne_fornecedores/editar_parcelas',$data);
          $this->load->view('footer/footer');
     }
     //funcoes para gravar no banco de dados
     public function salvar($id){
          $this->load->model('m_carnes_fornecedores');
          $this->m_carnes_fornecedores->salvarParcela($id);        
          header("location:".site_url('c_carne_fornecedores/gerenciador'));
     }
     public function gravar($id){
          $this->load->model('m_carnes_fornecedores');
          if($this->m_carnes_fornecedores->gravarParcela($id)){        
            header("location: ".site_url("c_carne_fornecedores/detalhes/".$id));
          }else{
            header("location: ".site_url("c_carne_fornecedores/detalhes/".$id));
          }
     }
     public function excluir($id){
          $this->load->model('m_carnes_fornecedores');
          $this->m_carnes_fornecedores->excluirParcela($id);      
          header("location:".site_url('c_carne_fornecedores/gerenciador'));
     }  
        
     public function excluir_parcelas(){
          $this->load->model('m_carnes_fornecedores');
          $this->m_carnes_fornecedores->excluirParcelas();      
          header("location:".site_url('c_carne_fornecedores/gerenciador'));

     }
     public function form_carnes()
     {
          $this->load->model('m_fornecedores');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['fornecedores'] = $this->m_fornecedores->listar();
          $this->load->view('carne_fornecedores/form_carne',$data);
          
          $this->load->view('footer/footer');
     } 
     public function gerenciador()
     {
          $this->load->model('m_carnes_fornecedores');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes_fornecedores->listCarnes();
          $this->load->view('carne_fornecedores/gerenciador_carnes',$data);
          $this->load->view('footer/footer');
     }

     public function RegistrarPagamento($id)
     {
          $this->load->model('m_carnes_fornecedores');
          $this->load->model('m_categorias');
          $this->load->model('m_contas');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['parcela'] = $this->m_carnes_fornecedores->buscarParcela($id);
          $data['contas'] = $this->m_contas->listar();
          $data['categorias'] = $this->m_categorias->buscaSaidas();
          $this->load->view('carne_fornecedores/carne_pagamento',$data);
          $this->load->view('footer/footer');
     }

     public function efetuarPagamento($id)
     {
          $this->load->model('m_carnes_fornecedores');
          $this->load->model('m_registro_saidas');
          $entradaId = $this->m_registro_saidas->registrarSaida($id);
          $this->m_carnes_fornecedores->pagaParcela($id,$entradaId);
          header('location:'.site_url('c_carne_fornecedores/gerenciador'));

     }
     public function excluir_carne($carNum){
          $this->load->model('m_carnes_fornecedores');
          $this->m_carnes_fornecedores->ExcluiCarne($carNum);
          header('location:'.site_url('c_carne_fornecedores/gerenciador'));
     }
     public function detalhes($carNum)
     {
          $this->load->model('m_carnes_fornecedores');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes_fornecedores->BuscaCarnes($carNum);
          $this->load->view('carne_fornecedores/detalhes_carnes',$data);
          $this->load->view('footer/footer');
     }

	public function imprimir()
     {
          $this->load->model('m_carnes_fornecedores');
          $this->load->library('mpdf');
          $vet= explode('/', $this->input->post('vencimento'));
          $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
          $ultimoCarne = $this->m_carnes_fornecedores->maiorCarne();
          $numCarne = $ultimoCarne[0]->fcNum + 1;
          $numParcelas = $this->input->post('n_parcela');
          $valorMensalidade = $this->input->post('mensalidade');
          $valorMensalidadeVencida = $this->input->post('mensalidade_vencida');

          for($i = 1; $i <= $numParcelas; $i++){
               $parcela['fcNum'] = $numCarne;
               $parcela['fcParcela'] = $i;
               $parcela['forId'] = $this->input->post('for_id');
               $parcela['fcVencimento'] = date_format($vencimento,'Y-m-d');
               $parcela['fcValor'] = $valorMensalidade;
               $parcela['fcDescricao'] = $this->input->post('descricao');
               $parcela['fcValorVencido'] = $valorMensalidadeVencida;
               $this->m_carnes_fornecedores->geraParcela($parcela);
               $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
          }
          header('location:'.site_url('c_carne_fornecedores/gerenciador'));  
     }

     
}
