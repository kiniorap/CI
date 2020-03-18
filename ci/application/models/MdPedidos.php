<?php 
    class MdPedidos extends CI_Model{
        function __construct()
        {
            parent::__construct();
        }
        public function listar(){
            $this->db->select("id,nombre_cliente,direccion,CASE estatus WHEN 1 THEN 'En proceso de envio' WHEN 2 THEN 'En ruta' WHEN 3 THEN 'Cancelado' ELSE 'Otro' END AS estatus");
            $this->db->from ('pedidos');
            $consulta=$this->db->get();
            return $consulta->result();
        }
         public function agregar($strNombre,$strDireccion,$intEstatus,$dateFechaCaptura,$strFechaEntrega,$dblCostoEnvio,$intCantidad,$dblTotal){
            $this->db->set('nombre_cliente',$strNombre);
            $this->db->set('direccion',$strDireccion);
            $this->db->set('estatus',$intEstatus);  
            $this->db->set('fecha_captura',$dateFechaCaptura);
            $this->db->set('fecha_entrega',$strFechaEntrega);  
            $this->db->set('costo_envio',$dblCostoEnvio); 
            $this->db->set('cantidad',$intCantidad); 
            $this->db->set('total',$dblTotal); 
            $this->db->insert('pedidos');
            return $this->db->affected_rows();
        }
    }
?>