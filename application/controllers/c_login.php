<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_curso
 *
 * @author Loki
 */
class c_login extends CI_Controller{
    //put your code here
    public function logar(){
        $this->load->model('m_login');
        $users = $this->m_login->buscaUser();
        if (count($users)>0){
            $this->session->set_userdata('Ativo',true);
            $this->session->set_userdata('Nome',$users[0]->usuNome);
            $this->session->set_userdata('Conta',$users[0]->conId);
            $this->session->set_userdata('Perfil',$users[0]->perId);
        }else{
            $this->session->set_flashdata(array('Usuario ou senha invalida!'));
        }
        header('location:'.site_url());
    }

    public function logoff(){
        print_r($this->session->sess_destroy());
        header('location:'.site_url());
    }
    
}
