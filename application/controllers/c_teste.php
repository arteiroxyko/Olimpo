<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_instrutor
 *
 * @author Loki
 */
class c_teste extends CI_Controller{
    //put your code here
    public function enconstrucao(){
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('construcao');
        $this->load->view('footer/footer');        
    }
    
}
