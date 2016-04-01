<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_carne_clientes extends CI_Controller {

    function __construct() {
      	parent::__construct();
      	if (!isset($this->session->userdata['Ativo'])) {
           	header('location: '.site_url());
  		}
    }

     public function cadastrarParcelas($carNum){
          $this->load->model('m_carnes_clientes');
          $this->load->view('head/head');
          $data['carnes'] = $this->m_carnes_clientes->BuscaCarnes($carNum);
          $this->load->view('menu/principal');
          $this->load->view('carne_clientes/cadastra_parcelas',$data);
          $this->load->view('footer/footer');        
     }

     public function editarParcelas($id){
          $this->load->model('m_carnes_clientes');
          $this->load->model('m_turnos');
          $data['parcela'] = $this->m_carnes_clientes->buscarParcela($id);
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $this->load->view('carne_clientes/editar_parcelas',$data);
          $this->load->view('footer/footer');
     }
     //funcoes para gravar no banco de dados
     public function salvar($id){
          $this->load->model('m_carnes_clientes');
          $this->m_carnes_clientes->salvarParcela($id);        
          header("location:".site_url('c_carne_clientes/gerenciador'));
     }
     public function gravar($id){
          $this->load->model('m_carnes_clientes');
          if($this->m_carnes_clientes->gravarParcela($id)){        
            header("location: ".site_url("c_carne_clientes/detalhes/".$id));
          }else{
            header("location: ".site_url("c_carne_clientes/detalhes/".$id));
          }
     }
     public function excluir($id){
          $this->load->model('m_carnes_clientes');
          $this->m_carnes_clientes->excluirParcela($id);      
          header("location:".site_url('c_carne_clientes/gerenciador'));
     }  
        
     public function excluir_parcelas(){
          $this->load->model('m_carnes_clientes');
          $this->m_carnes_clientes->excluirParcelas();      
          header("location:".site_url('c_carne_clientes/gerenciador'));

     }
     public function form_carnes_clientes()
     {
          $this->load->model('m_clientes');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['clientes'] = $this->m_clientes->listar();
          $this->load->view('carne_clientes/form_carne',$data);
          
          $this->load->view('footer/footer');
     } 
     public function gerenciador()
     {
          $this->load->model('m_carnes_clientes');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes_clientes->listCarnes();
          $this->load->view('carne_clientes/gerenciador_carnes',$data);
          $this->load->view('footer/footer');
     }

     public function RegistrarPagamento($id)
     {
          $this->load->model('m_carnes_clientes');
          $this->load->model('m_contas');
          $this->load->model('m_categorias');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['parcela'] = $this->m_carnes_clientes->buscarParcela($id);
          $data['contas'] = $this->m_contas->listar();
          $data['categorias'] = $this->m_categorias->buscaEntradas();
          $this->load->view('carne_clientes/carne_pagamento',$data);
          $this->load->view('footer/footer');
     }

     public function efetuarPagamento($id)
     {
          $this->load->model('m_carnes_clientes');
          $this->load->model('m_registro_entradas');
          $entradaId = $this->m_registro_entradas->registrarEntrada($id);
          $this->m_carnes_clientes->pagaParcela($id,$entradaId);
          header('location:'.site_url('c_carne_clientes/gerenciador'));

     }
     public function excluir_carne($carNum){
          $this->load->model('m_carnes_clientes');
          $this->m_carnes_clientes->ExcluiCarne($carNum);
          header('location:'.site_url('c_carne_clientes/gerenciador'));
     }
     public function detalhes($carNum)
     {
          $this->load->model('m_carnes_clientes');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes_clientes->BuscaCarnes($carNum);
          $this->load->view('carne_clientes/detalhes_carnes',$data);
          $this->load->view('footer/footer');
     }

	public function imprimir()
     {
          $this->load->model('m_clientes');
          $this->load->model('m_carnes_clientes');
          $aluno = $this->m_clientes->buscar($this->input->post('alu_id'));
          $this->load->library('mpdf');
          $html= "<table style='border: 1px solid #FFF; font-family: mono; font-size: 7pt;'>";
          $vet= explode('/', $this->input->post('vencimento'));
          $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
          $ultimoCarne = $this->m_carnes_clientes->maiorCarne();
          $numCarne = $ultimoCarne[0]->carNum + 1;
          $numParcelas = $this->input->post('n_parcela');
          $valorMensalidade = $this->input->post('mensalidade');
          $valorMensalidadeVencida = $this->input->post('mensalidade_vencida');

          for($i = 1; $i <= $numParcelas; $i++){
               $parcela['carNum'] = $numCarne;
               $parcela['carParcela'] = $i;
               $parcela['cliId'] = $this->input->post('cli_id');
               $parcela['carDescricao'] = $this->input->post('descricao');
               $parcela['carVencimento'] = date_format($vencimento,'Y-m-d');
               $parcela['carValor'] = $valorMensalidade;
               $parcela['carValorVencido'] = $valorMensalidadeVencida;
               $this->m_carnes_clientes->geraParcela($parcela);
               $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
          }
          header('location:'.site_url('c_carne_clientes/gerenciador')); 
     }

     public function imprimir_carne($carNum)
	{
          $this->load->model('m_carnes_clientes');
          $this->load->library('mpdf');
          $html= "<table style='border: 1px solid #FFF; font-family: mono; font-size: 7pt;'>";
          $carnes = $this->m_carnes_clientes->buscaCarnes($carNum);

          $numParcelas = count($carnes);
          for($i = 0; $i <= $numParcelas; $i++){
               if (($i%2)==0){
                    $html = $html.   "<td style='border-collapse: collapse;'>";
                    $html = $html.     "<table style='height:5cm; width:15cm; border: 0.3px solid #DDD;'>";
                    $html = $html.          "<tr style='border-collapse: collapse;'>";
                    $html = $html.              "<td style='border-right: 1px dashed #ccc;'>";
                    $html = $html.                  "<table style='margin-left: 1cm; margin-right: 0.1cm;border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td align='center' style='text-rotate: 90; width:0.6cm; border: 1px solid #ccc;' rowspan=5>";
                    $html = $html.                              "<br><br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $carnes[$i-1]->carValor."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                           "<td>";
                    $html = $html.                              "<img src=". base_url("public/img/logo.jpg")." height='15'>";
                    $html = $html.                           "</td>";                    
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>";            
                    $html = $html.              "</td>";
                    $html = $html.              "<td>";
                    $html = $html.                  "<table style='margin-left: 0.2cm; border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $carnes[$i-1]->carValorVencido."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=3>";                    
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>"; 
                    $html = $html.              "</td>";
                    $html = $html.          "</tr>";
                    $html = $html.      "</table>";
                    $html = $html.  "</td>";
                    
               }else{
                    
                    $html = $html. "</tr>";
                    $html = $html. "<tr style='border-collapse: collapse;'>";
                    $html = $html.   "<td style='border-collapse: collapse;'>";
                    $html = $html.     "<table style='height:5cm; width:15cm; border: 0.5px solid #DDD;'>";
                    $html = $html.          "<tr style='border-collapse: collapse;'>";
                    $html = $html.              "<td style='border-right: 1px dashed #ccc;'>";
                    $html = $html.                  "<table style='border-top-left-radius: 15px; border-bottom-left-radius: 15px; margin-left: 1cm; margin-right: 0.2cm;border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td align='center' style='text-rotate: 90; width:1cm; border: 1px solid #ccc;' rowspan=5>";
                    $html = $html.                              "<br><br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $carnes[$i-1]->carValorVencido."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                           "<td>";
                    $html = $html.                              "<img src=". base_url("public/img/logo.jpg")." height='15'>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>";            
                    $html = $html.              "</td>";
                    $html = $html.              "<td>";
                    $html = $html.                  "<table style='margin-left: 0.2cm; border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ".$carnes[$i-1]->carValorVencido."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>"; 
                    $html = $html.              "</td>";
                    $html = $html.          "</tr>";
                    $html = $html.      "</table>";
                    $html = $html.  "</td>";
               }
          }
          $html = $html."</table>";
          $this->mpdf->mPDF('utf-8', 'A4-L', 0, '', 2, 2, 2, 2, 0, 0, 'L');
          $this->mpdf->WriteHTML($html);
          $this->mpdf->Output($carnes[0]->aluMatricula.' - '.$carnes[0]->aluNome.'.pdf','D');        
	}
}
