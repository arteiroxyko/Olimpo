<?php

class m_registro_entradas extends CI_Model {
    
    public function registrarEntrada(){

        $conta = $this->input->post('conId');
        if(empty($conta)){
            $conta = $this->session->userdata['Conta'];            
        }

        $this->load->database();
        $insert = array(
            'reDescricao' => $this->input->post('reDescricao'),
            'reValor' => str_replace(",",".",$this->input->post('reValor')),
            'reData' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('reData'))))),
            'reCategoria' => $this->input->post('reCategoria'),
            'turId' => $this->input->post('turId'),
            'conId' => $conta,
        );
        
        if($this->db->insert('registroentradas',$insert)){
            return $this->db->insert_id();    
        }else{
            return $this->db->insert_id();    
        }
    }

    
    public function buscaMovimentosDia($dia = 0, $mes = 0, $ano = 0, $filtraConta = True)
    {
        $this->load->database();
        if (($dia==0)||($mes==0)||($ano==0)){
            $sql = "SELECT * 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    INNER JOIN registrocategorias on registroentradas.reCategoria = registrocategorias.rcId
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%c%d') = date_format(now(),'%Y%c%d')";  
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }else{
            $sql = "SELECT * 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    INNER JOIN registrocategorias on registroentradas.reCategoria = registrocategorias.rcId
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%c%d') = date_format(\"$ano-$mes-$dia\",'%Y%c%d')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }
        $sql .= " ORDER by reData,contas.conId,registrocategorias.rcId";
        $return = $this->db->query($sql);
        return $return->result();
    }    

    public function buscaMovimentosDiaPorCategoria($dia = 0, $mes = 0, $ano = 0, $filtraConta = True)
    {   
        $this->load->database();
        if ($dia==0){
            $sql = "SELECT rcNome, sum(reValor) as valor,conNome 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%m%d') = date_format(now(),'%Y%m%d')";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta']!=0){
                            $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
        }else{
            $sql = "SELECT rcNome, sum(reValor) as valor,conNome 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%m%d') = $ano$mes$dia";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta'] != 0){
                            $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
        }
        if ($filtraConta){
            $sql .=  " group by registroentradas.reCategoria,registroentradas.conId";
        }else{
            $sql .=  " group by registroentradas.reCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }  

    public function buscaMovimentosMes($mes = 0, $ano = 0, $filtraConta = True)
    {   
        $this->load->database();
        if (($mes==0)||($ano==0)){
            $sql = "SELECT * 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    INNER JOIN registrocategorias on registroentradas.reCategoria = registrocategorias.rcId
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%c') = date_format(now(),'%Y%c')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }else{
            $sql = "SELECT * 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    INNER JOIN registrocategorias on registroentradas.reCategoria = registrocategorias.rcId
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%c') = date_format(\"$ano-$mes-01\",'%Y%c')";
            if ($filtraConta){
                if ($this->session->userdata['Conta']!=0){
                    $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                }
            }
        }
        $sql .= " ORDER BY reData, registroentradas.turId, registroentradas.conId, reCategoria";
        $return = $this->db->query($sql);
        return $return->result();
    }  

    public function buscaMovimentosMesPorCategoria($mes = 0,$ano = 0, $filtraConta = True){
        $this->load->database();
        if ($mes==0){
            $sql = "SELECT rcNome, sum(reValor) as valor,conNome 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%m') = date_format(now(),'%Y%m')";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta']!=0){
                            $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
        }else{
            $sql = "SELECT rcNome, sum(reValor) as valor,conNome 
                    ,(select cliNome from clientes_carnes inner join clientes on clientes.cliId = clientes_carnes.cliId where reId  = registroentradas.reId) as nome
                    FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%m') = $ano$mes";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta'] != 0){
                            $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
        }
        if ($filtraConta){
            $sql .=  " group by registroentradas.reCategoria,registroentradas.conId";
        }else{
            $sql .=  " group by registroentradas.reCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    } 

    public function atualizarEntrada($id){
        $this->load->database();
        $insert = array(
            'reDescricao' => $this->input->post('reDescricao'),
            'reValor' => str_replace(",",".",$this->input->post('reValor')),
            'reData' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('reData'))))),
            'reCategoria' => $this->input->post('reCategoria'),
            'turId' => $this->input->post('turId'),
        );
        
        if($this->db->update('registroentradas',$insert,array('reId' => $id))){
            return true;    
        }else{
            return false;    
        }
    }    
    public function excluirEntrada($id){
        $this->load->database();        
        if($this->db->delete('registroentradas',array('reId' => $id))){
            return true;    
        }else{
            return false;    
        }
    }    

    public function buscaEntrada($id){
        $query = "select * from registroentradas where reId = ".$id;
        $return = $this->db->query($query);
        return $return->result();
    }    

    public function entradasPorMes($ano){
        $query = "SELECT 
                    date_format(reData,'%M') as reData,
                    sum(reValor) as reValor
                  FROM 
                    registroentradas 
                  WHERE date_format(reData,'%Y') = '$ano'
                  GROUP BY date_format(reData,'%m%Y');";
        $return = $this->db->query($query);
        return $return->result();
    }

    public function entradas_por_categoria($mes = 0,$ano = 0, $dia = 0, $filtraConta = True){
        $this->load->database();
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor,conNome FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId
                    WHERE date_format(reData,'%Y%m') = date_format(now(),'%Y%m')";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta'] != 0){
                            $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
                    $sql .= " group by registroentradas.reCategoria,registroentradas.conId";
        }else{
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor,conNome FROM registroentradas 
                inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                inner join contas on registroentradas.conId = contas.conId";
                if ($dia==0){
                    $sql .=" WHERE date_format(reData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE date_format(reData,'%Y%m%d') = $ano$mes$dia ";
                }
                if ($filtraConta){
                    if ($this->session->userdata['Conta'] != 0){
                        $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                    }
                }
                $sql .=" group by registroentradas.reCategoria,registroentradas.conId";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }    


    public function entradas_totais_por_categoria($mes = 0,$ano = 0, $dia = 0, $filtraConta = True){
        $this->load->database();
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria                   
                    WHERE date_format(reData,'%Y%m') = date_format(now(),'%Y%m')";
                    if ($filtraConta){
                        if ($this->session->userdata['Conta'] != 0){
                            $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                        }
                    }
                    $sql .= " group by registroentradas.reCategoria";
        }else{
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor FROM registroentradas 
                inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria";
                if ($dia==0){
                    $sql .=" WHERE date_format(reData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE date_format(reData,'%Y%m%d') = $ano$mes$dia";
                }
                if ($filtraConta){
                    if ($this->session->userdata['Conta'] != 0){
                        $sql .= " AND registroentradas.conId = ".$this->session->userdata['Conta'];
                    }
                }
                $sql .=" group by registroentradas.reCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }
    
}
?>