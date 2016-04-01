<?php
class m_carnes_fornecedores extends CI_Model {
    

    public function maiorCarne(){
        $this->load->database();
        $this->db->select_max('fcNum');
        $carnes =  $this->db->get('fornecedores_carnes');
        return $carnes->result();
    }    

    public function geraParcela($parcela){
        $this->load->database();
        $insert = array(
            'fcNum' => $parcela['fcNum'],
            'fcParcela' => $parcela['fcParcela'],
            'fcDescricao' => $parcela['fcDescricao'],
            'forId' => $parcela['forId'],
            'fcVencimento' => $parcela['fcVencimento'],
            'fcValor' => str_replace(',', '.', $parcela['fcValor']),
            'fcValorVencido' => $parcela['fcValorVencido']
        );
        if($this->db->insert('fornecedores_carnes',$insert)){
            return true;    
        }else{
            return false;    
        }
    }

    public function listCarnes(){
        $this->load->database();
        $sql = "SELECT 
                    fcNum,
                    forNome,
                    fcDescricao,
                    (select sum(fcValor) from fornecedores_carnes where fcPago = 0 and fcNum = c.fcNum)as aindaReceber, 
                    sum(fcPago) as pagos,
                    count(fcParcela)as parcelas 
                FROM fornecedores_carnes as c
                    inner join fornecedores on c.forId = fornecedores.forid
                group by fcNum;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function salvarParcela($id){
        $this->load->database();
        $insert = array(
            'fcValor' => str_replace(',', '.', $this->input->post('fcValor')),
            'fcVencimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('fcVencimento'))))),
            'fcParcela' => $this->input->post('fcParcela'),
            'fcValorVencido' => str_replace(',', '.', $this->input->post('fcValorVencido')),
        );
        
        if($this->db->update('fornecedores_carnes',$insert,array('fcId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function gravarParcela($fcNum){
        $this->load->database();
        $query = "select max(fcParcela) as parcela from fornecedores_carnes where fcNum = ".$fcNum;

        $max = $this->db->query($query);
        $max = $max->result();

        $numero = $max[0]->parcela;
        $numero +=1;
        $parcela = $this->input->post('fcParcela');
        $vet = explode("/",$this->input->post('fcVencimento'));
        $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
        $total = $numero+$parcela;
        while ($numero <= $total) {
            $insert = array(
                'fcNum' => $fcNum,
                'fcParcela' => $numero,
                'fcId' => $this->input->post('fcId'),
                'forId' => $this->input->post('forId'),
                'fcDescricao' => $this->input->post('fcDescricao'),
                'fcVencimento' => date_format($vencimento,'Y-m-d'),
                'fcValor' => str_replace(',', '.', $this->input->post('fcValor')),
                'fcValorVencido' => str_replace(',', '.', $this->input->post('fcValorVencido')),
            );
            $this->db->insert('fornecedores_carnes',$insert);
            $numero +=1;
            $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
        }
        return true;
    }
    public function excluirParcela($id){
        $this->load->database();
        if($this->db->delete('fornecedores_carnes',array('fcid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function excluirParcelas(){
        $this->load->database();
        $parcelas = $this->input->post('parcelas');
        var_dump($parcelas);
        foreach ($parcelas as $key) {
            $this->excluirParcela($key);
        }
    }   
    public function excluiCarne($id){
        $this->load->database();
        if($this->db->delete('fornecedores_carnes',array('fcNum'=>$id,'fcPago'=>0))){
            return true;    
        }else{
            return false;    
        }
    }
    public function buscaCarnes($carne){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM fornecedores_carnes 
                inner join fornecedores on fornecedores_carnes.forId = fornecedores.forid
                where fcNum = $carne;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function buscarParcela($carId){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM fornecedores_carnes 
                inner join fornecedores on fornecedores_carnes.forId = fornecedores.forid
                where fcId = ".$carId;
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function buscaVencidos(){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM fornecedores_carnes 
                inner join fornecedores on fornecedores_carnes.forId = fornecedores.forid
                where fcVencimento <= DATE_ADD(DATE(NOW()), INTERVAL 6 DAY)  and fcPago = 0
                ORDER BY fcVencimento";
        $result = $this->db->query($sql);
        return $result->result();
    }

    
    public function pagaParcela($carId,$parcelaId){
        $this->load->database();
        $sql = "UPDATE  fornecedores_carnes SET fcPago = 1, rsId = $parcelaId where fcId = $carId;";
        $result = $this->db->query($sql);
        return true;
    }

    public function prospecPorMes($ano){
        $query = "SELECT 
                    date_format(fcVencimento,'%M') as fcVencimento,
                    sum(fcValor)  as fcValor
                  FROM 
                    fornecedores_carnes 
                  WHERE date_format(fcVencimento,'%Y') = '$ano'
                  GROUP BY date_format(fcVencimento,'%m%Y');";
        $return = $this->db->query($query);
        return $return->result();
    }

}
?>

