<?php

class m_registro_saidas extends CI_Model {
    
    public function registrarSaida(){
        $this->load->database();

        $conta = $this->input->post('conId');

        if(empty($conta)){
            $conta = $this->session->userdata['Conta'];            
        }

        $insert = array(
            'rsDescricao' => $this->input->post('rsDescricao'),
            'rsValor' => str_replace(",",".",$this->input->post('rsValor')),
            'rsData' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('rsData'))))),
            'rsCategoria' => $this->input->post('rsCategoria'),
            'turId' => $this->input->post('turId'),
            'conId' => $conta,
        );
        
        if($this->db->insert('registrosaidas',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    
    public function buscaMovimentosDia($dia = 0, $mes = 0, $ano = 0, $filtraConta = True)
    {
        $this->load->database();
        if (($dia==0)||($mes==0)||($ano==0)){
            $sql = "SELECT * 
                    FROM registrosaidas 
                    INNER JOIN registrocategorias on registrosaidas.rsCategoria = registrocategorias.rcId
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%c%d') = date_format(now(),'%Y%c%d')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }else{
            $sql = "SELECT * FROM registrosaidas 
                    INNER JOIN registrocategorias on registrosaidas.rsCategoria = registrocategorias.rcId
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%c%d') = date_format(\"$ano-$mes-$dia\",'%Y%c%d')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }
        $sql .= " ORDER BY rsData, registrosaidas.turId,rsCategoria";
        $return = $this->db->query($sql);
        return $return->result();
    }  

    public function buscaMovimentosMes($mes = 0, $ano = 0,$filtraConta = True)
    {   
        $this->load->database();
        if (($mes==0)||($ano==0)){
            $sql = "SELECT * FROM registrosaidas 
                    INNER JOIN registrocategorias on registrosaidas.rsCategoria = registrocategorias.rcId
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%c') = date_format(now(),'%Y%c')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }else{
            $sql = "SELECT * FROM registrosaidas 
                    INNER JOIN registrocategorias on registrosaidas.rsCategoria = registrocategorias.rcId
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%c') = date_format(\"$ano-$mes-01\",'%Y%c')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }
        $sql .= " ORDER BY rsData, registrosaidas.turId,rsCategoria";
        $return = $this->db->query($sql);
        return $return->result();
        
    } 

    public function buscaMovimentosMesPorCategoria($mes = 0,$ano = 0, $filtraConta = True){
        $this->load->database();
        if ($mes==0){
            $sql = "SELECT rcNome, sum(rsValor) as valor,conNome FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%m') = date_format(now(),'%m')";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta']!=0){
                            $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
        }else{
            $sql = "SELECT rcNome, sum(rsValor) as valor, conNome FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%m') = $ano$mes";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta']!=0){
                            $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
        }
        if ($filtraConta){
            $sql .=  " group by registrosaidas.rsCategoria,registrosaidas.conId";
        }else{
            $sql .=  " group by registrosaidas.rsCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }


    public function atualizarSaida($id){
        $this->load->database();
        $insert = array(
            'rsDescricao' => $this->input->post('rsDescricao'),
            'rsValor' => str_replace(",",".",$this->input->post('rsValor')),
            'rsData' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('rsData'))))),
            'rsCategoria' => $this->input->post('rsCategoria'),
            'turId' => $this->input->post('turId'),
        );
        
        if($this->db->update('registrosaidas',$insert,array('rsId' => $id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function buscaSaida($id){
        $query = "select * from registrosaidas where rsId = ".$id;
        $return = $this->db->query($query);
        return $return->result();
    }

    public function buscaMovimentosDiaPorCategoria($dia = 0, $mes = 0, $ano = 0)
    {   
        $this->load->database();
        if ($dia==0){
            $sql = "SELECT rcNome, sum(rsValor) as valor,conNome 
                    FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%m%d') = date_format(now(),'%Y%m%d')";
                    if ($this->session->userdata['Conta']!=0){
                        $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                    }
            $sql .=  " group by registrosaidas.rsCategoria,registrosaidas.conId";

        }else{
            $sql = "SELECT rcNome, sum(rsValor) as valor,conNome 
                    FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId
                    WHERE date_format(rsData,'%Y%m%d') = $ano$mes$dia";
                    if ($this->session->userdata['Conta'] != 0){
                        $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                    }
            $sql .=  " group by registrosaidas.rsCategoria,registrosaidas.conId";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }

    public function saidas_totais_por_categoria($mes = 0,$ano = 0, $dia = 0){
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor,conNome FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId                    
                    WHERE date_format(rsData,'%Y%m') = date_format(now(),'%Y%m')";
                    if ($this->session->userdata['Conta'] != 0){
                        $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                    }
                    $sql .= " group by registrosaidas.rsCategoria";
        }else{
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor,conNome FROM registrosaidas 
                inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                inner join contas on registrosaidas.conId = contas.conId";
                if ($dia==0){
                    $sql .=" WHERE date_format(rsData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE date_format(rsData,'%Y%m%d') = $ano$mes$dia";
                }
                if ($this->session->userdata['Conta'] != 0){
                    $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                }
                $sql .=" group by registrosaidas.rsCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }
    
    public function saidas_por_categoria($mes = 0,$ano = 0, $dia = 0){
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor,conNome FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId                   
                    WHERE date_format(rsData,'%Y%m') = date_format(now(),'%Y%m')";
                    if ($this->session->userdata['Conta'] != 0){
                        $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                    }
                    $sql .= " group by registrosaidas.rsCategoria,registrosaidas.conId";
        }else{
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor,conNome FROM registrosaidas 
                inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                inner join contas on registrosaidas.conId = contas.conId";
                if ($dia==0){
                    $sql .=" WHERE date_format(rsData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE date_format(rsData,'%Y%m%d') = $ano$mes$dia";
                }
                if ($this->session->userdata['Conta'] != 0){
                    $sql .= " AND registrosaidas.conId = ".$this->session->userdata['Conta'];
                }
                $sql .=" group by registrosaidas.rsCategoria,registrosaidas.conId";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }
    public function excluirSaida($id){
        $this->load->database();        
        if($this->db->delete('registrosaidas',array('rsId' => $id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function saidasPorMes($ano){
        $query = "SELECT 
                    date_format(rsData,'%M') as rsData,
                    sum(rsValor)  as rsValor
                  FROM 
                    registrosaidas 
                  WHERE date_format(rsData,'%Y') = '$ano'
                  GROUP BY date_format(rsData,'%m%Y');";
        $return = $this->db->query($query);
        return $return->result();
    }


    
}
?>