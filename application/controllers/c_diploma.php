<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_diploma
 *
 * @author Loki
 */
class c_diploma extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }

    public function imprimir()
	{
            $this->load->library('mpdf');
            $this->mpdf->mPDF('utf-8', 'A4-L', 0, '', 2, 2, 2, 2, 0, 0, 'L');
            $this->load->model("m_curso");
            $curso = $this->m_curso->Buscar($this->input->post('curso'));
            //Fundo da pagina
            $html ="<div style='height: 100%; background-image: url(http://localhost/infox/public/img/certificado_branco.png)'>";
            //div do nome do candidato
            $html = $html ."<div style='padding-top:300px; padding-left:135px'>"
                    . "<span style='min-width:200px; background-color:#FFF; margin:0; padding:0; font-family: vibes;font-size:48px;'>"
                    . "".$this->input->post('nome').""
                    . "</span>"
                    . "</div>";
            //div do curso
            $html = $html ."<div style='padding-top:30px;padding-left:145px'>"
                    . "<p style='margin:0;padding:0;font-family: robo;font-size:30px;'>"
                    . "".$curso[0]->curNome.""
                    . "</p>"
                    . "</div>";
            //div do instrutor
            $html = $html ."<div style='text-align: center;font-family: vibes;font-size:20px; padding-top:-35px; margin-left:680px; width:250px'>"
                    . $this->input->post('instrutor')
                    . "</div>";
            //div do div da carga Horaria
            $html = $html ."<div style='padding-top: 16px; padding-left:145px'>"
                    . "<p style='margin:0;padding:0;font-family: robo;font-size:30px;'>"
                    . "".$curso[0]->curCargHora.' horas'.""
                    . "</p>"
                    . "</div>";
            //div do div do periodo
            $html = $html ."<div style='padding-top: 10px; padding-left:145px'>"
                    . "<p style='margin:0;padding:0;font-family: robo;font-size:30px;'>"
                    . "".$this->input->post('inicio').' a '. $this->input->post('fim').""
                    . "</p>"
                    . "</div>";
            switch (date(m)):
                    case 1:
                        $mes="Janeiro";
                        break;
                    case 2:
                        $mes="Fevereiro";
                        break;
                    case 3:
                        $mes="Março";
                        break;
                    case 4:
                        $mes="Abril";
                        break;
                    case 5:
                        $mes="Maio";
                        break;
                    case 6:
                        $mes="Junho";
                        break;
                    case 7:
                        $mes="Julho";
                        break;
                    case 8:
                        $mes="Agosto";
                        break;
                    case 9:
                        $mes="Setembro";
                        break;
                    case 10:
                        $mes="Outubro";
                        break;
                    case 11:
                        $mes="Novembro";
                        break;
                    case 12:
                        $mes="Dezembro";
                        break;
            endswitch;
            $html = $html ."<div style='padding-top: 10px; padding-left:145px'>"
                    . "<p style='margin:0;padding:0;font-family: robo;font-size:15px;'>"
                    . "São Marcos, ".date(d)." de ".$mes." de ".date(Y).""
                    . "</p>"
                    . "</div>";
            //div do instrutor
            $html = $html ."<div style='text-align: center;font-family: vibes;font-size:20px; padding-top:-80px; margin-left:680px; width:250px'>"
                    . "Rogério Junior Rizzon"
                    . "</div>";
            //fim da div do fundo
            $html = $html ."</div>";
            $this->mpdf->WriteHTML($html);
            
            $this->mpdf->AddPage('utf-8', 'A4-L', 0, '', 2, 2, 2, 2, 0, 0, 'L');
            
            $html = "<table style='border: 1px solid #fff; font-family: robo; width:100%'>";
            $html = $html ."<tr>";
            $html = $html   ."<td style='vertical-align:top; height:450px;width:200px; border: 1px solid #000; font-family: robo;'>";
            $html = $html       ."<center>Curso(s):<br></center>";
            $html = $html       ."<p style='text-align=justify'>".$curso[0]->curCursos."</p>";
            $html = $html   ."</td>";
            $html = $html   ."<td rowspan='2' style='vertical-align:top; border: 1px solid #000; font-family: robo;'>";
            $html = $html       ."<center>Conteúdo:</center><br>";
            $html = $html       ."<p style='text-align=justify'>".$curso[0]->curConteudo."</p>";
            $html = $html    ."</td>";
            $html = $html ."</tr>";
            $html = $html ."<tr>";
            $html = $html   ."<td style='vertical-align:top; height:80px;aling:center; border: 1px solid #000; font-family: robo;'>";
            $html = $html       ."<center>Carga Horária:<br>";
            $html = $html       .$curso[0]->curCargHora."h</center>";
            $html = $html   ."</td>";
            $html = $html ."</tr>";
            $html = $html ."</table>";
            $html = $html ."<table style='width:100%'>";
            $html = $html ."<tr style='border: 1px solid #000'>";
            $html = $html   ."<td style='padding-left:235;padding-right:235; border: 1px solid #FFF; font-family: robo;'>";
            $html = $html       ."Registro sob nº________________Fl_____________<br>";
            $html = $html       ."do Livro de registro do Certificado nº__________<br>";
            $html = $html       ."São Marcos ____/____/_____";
            $html = $html   ."</td>";
            $html = $html   ."<td style='height:150px; width:300px;border: 1px dashed #000; font-family: robo;'>";
            $html = $html   ."</td>";
            $html = $html ."</tr>";
            $html = $html ."</table>";
            $html = $html ."<table>";
            $html = $html ."<tr>";
            $html = $html   ."<td>";
            $html = $html       ."<img src='http://localhost/infox/public/img/DepartamentoPessoal.png' height='50px'/>";
            $html = $html   ."</td>";
            $html = $html   ."<td style='width: 1100px;border: 1px solid #fff; font-family: robo;'>";
            $html = $html       ."Centro de Atendimento:<br>";
            $html = $html       ."<b>Infox Informática LTDA</b> - Avenida Venancio Aires, 1110, sala 11, centro - São Marcos - RS, CEP 95190-000<br>";
            $html = $html       ."<b>Telefone:</b> (0xx54) 3291.2670, <b>E-mail:</b>atendimento@infox.net.br";
            $html = $html   ."</td>";
            $html = $html ."</tr>";
            $html = $html ."</table>";

            
            $this->mpdf->WriteHTML($html);
            $this->mpdf->Output($this->input->post('nome').'.pdf','D');
        }
}
