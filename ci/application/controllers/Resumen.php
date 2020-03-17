<?php
    class Resumen extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('MdPedidos');
        }
        public function index(){
            $arrDatosDinamico['arrPruebas']=$this->MdPedidos->listar();
            $arrDatos['strActivo']='resumen';
            $arrDatos['strContenido']=$this->load->view('pedidos/resumen',$arrDatosDinamico,TRUE);
            $this->load->view('principal',$arrDatos);
        }
    }    
?>