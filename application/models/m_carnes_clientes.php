<?php
class m_carnes_clientes extends CI_Model {
    

    public function maiorCarne(){
        $this->load->database();
        $this->db->select_max('carNum');
        $carnes =  $this->db->get('clientes_carnes');
        return $carnes->result();
    }    

    public function geraParcela($parcela){
        $this->load->database();
        $insert = array(
            'carNum' => $parcela['carNum'],
            'carParcela' => $parcela['carParcela'],
            'cliId' => $parcela['cliId'],
            'carDescricao' => $parcela['carDescricao'],
            'carVencimento' => $parcela['carVencimento'],
            'carValor' => str_replace(',', '.', $parcela['carValor']),
            'carValorVencido' => $parcela['carValorVencido']
        );
        if($this->db->insert('clientes_carnes',$insert)){
            return true;    
        }else{
            return false;    
        }
    }

    public function listCarnes(){
        $this->load->database();
        $sql = "SELECT 
                    carNum,
                    cliNome,
                    carDescricao,
                    (select sum(carValor) from clientes_carnes where carPago = 0 and carNum = c.carNum)as aindaReceber, 
                    sum(carPago) as pagos,
                    count(CarParcela)as parcelas 
                FROM clientes_carnes as c
                    inner join clientes on c.cliId = clientes.cliid
                group by carNum;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function salvarParcela($id){
        $this->load->database();
        $insert = array(
            'carValor' => str_replace(',', '.', $this->input->post('carValor')),
            'carVencimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('carVencimento'))))),
            'carParcela' => $this->input->post('carParcela'),
            'carValorVencido' => str_replace(',', '.', $this->input->post('carValorVencido')),
        );
        
        if($this->db->update('clientes_carnes',$insert,array('carId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function gravarParcela($carNum){
        $this->load->database();
        $query = "select max(carParcela) as parcela from clientes_carnes where carNum = ".$carNum;

        $max = $this->db->query($query);
        $max = $max->result();

        $numero = $max[0]->parcela;
        $numero +=1;
        $parcela = $this->input->post('carParcela');
        $vet = explode("/",$this->input->post('carVencimento'));
        $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
        $total = $numero+$parcela;
        while ($numero <= $total) {
            $insert = array(
                'carNum' => $carNum,
                'carParcela' => $numero,
                'carDescricao' => $this->input->post('carDescricao'),
                'cliId' => $this->input->post('cliId'),
                'carVencimento' => date_format($vencimento,'Y-m-d'),
                'carValor' => str_replace(',', '.', $this->input->post('carValor')),
                'carValorVencido' => str_replace(',', '.', $this->input->post('carValorVencido')),
            );
            $this->db->insert('clientes_carnes',$insert);
            $numero +=1;
            $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
        }
        return true;
    }

    public function excluirParcela($id){
        $this->load->database();
        if($this->db->delete('clientes_carnes',array('carId'=>$id))){
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
        if($this->db->delete('clientes_carnes',array('carNum'=>$id,'carPago'=>0))){
            return true;    
        }else{
            return false;    
        }
    }
    public function buscaCarnes($carne){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM clientes_carnes 
                    inner join clientes on clientes_carnes.cliId = clientes.cliid
                where carNum = $carne;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function buscarParcela($carId){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM clientes_carnes 
                    inner join clientes on clientes_carnes.cliId = clientes.cliid
                where carId = ".$carId;
        $result = $this->db->query($sql);
        return $result->result();
    }
    public function buscaVencidos(){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM clientes_carnes 
                    inner join clientes on clientes_carnes.cliId = clientes.cliid
                where carVencimento <= CURDATE() and carPago = 0";
        $result = $this->db->query($sql);
        return $result->result();
    }

    
    public function pagaParcela($carId,$parcelaId){
        $this->load->database();
        $sql = "UPDATE  clientes_carnes SET carPago = 1, reId = $parcelaId where carId = $carId;";
        $result = $this->db->query($sql);
        return true;
    }

    public function prospecPorMes($ano){
        $query = "SELECT 
                    date_format(carVencimento,'%M') as carVencimento,
                    sum(carValor)  as carValor
                  FROM 
                    clientes_carnes 
                  WHERE date_format(carVencimento,'%Y') = '$ano'
                  GROUP BY date_format(carVencimento,'%m%Y');";
        $return = $this->db->query($query);
        return $return->result();
    }
}
?>

