<?php
    class Modelos extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('MdModelos');
            $this->load->model('MdMarcas');
        }
        public function index($arrDatos = []){
            $intMarcaId=$this->input->post('intMarcaId');
            if($intMarcaId=='')$intMarcaId=0; 
            $arrDatosDinamicos['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosDinamicos['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatosDinamicos['intMarcaId']=$intMarcaId;
            $arrDatos['strActivo']='modelos';
            $arrDatos['strContenido']=$this->load->view('modelos/listar',$arrDatosDinamicos,TRUE);
            $this->load->view('principal',$arrDatos);
        }
        public function guardar(){
            $intId=$this->input->post('intId');
            if($intId==''){
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre',
                    'required|is_unique[modelos.nombre]',
                    array(
                        'required'=>'Ingrese un %s.',
                        'is_unique'=>'El %s ya existe, ingrese uno distinto.'
                    )
                ); 
            }else{
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre','required',
                    array(
                        'required'=>'Ingrese un %s.',
                    )
                );    
            }
            $this->form_validation->set_rules(
                'intMarcaId', 'Marca','required|integer',
                array(
                    'required'=>'Seleccione una %s.',
                    'integer'=>'El %s debe ser un número.'
                )
            );    
            $this->form_validation->set_rules(
                'intEstatus', 'Estatus',
                'required|integer|greater_than[0]',
                array(
                    'required'=>'Ingrese un %s.',
                    'integer'=>'El %s debe ser un número.',
                    'greater_than'=>'Seleccione un %s'
                )
            );
            $this->form_validation->set_rules(
                'dblPrecio', 'Precio',
                'required|numeric',
                array(
                    'required'=>'Ingrese el %s.',
                    'numeric'=>'El %s debe ser un número.'
                )
            );
            if ($this->form_validation->run() == FALSE){
                if($intId == ''){                
                    $this->index();
                    echo "holisjsdiasnoifn";
                }else{
                    $this->editar($intId,TRUE);
                }
            }else{
                $intMarcaId = $this->input->post('intMarcaId');
                $strNombre=$this->input->post('strNombre');
                $strDescripcion=$this->input->post('strDescripcion');
                $intEstatus=$this->input->post('intEstatus');
                $dblPrecio=$this->input->post('dblPrecio');
                $intResultado=0;
                if ($intId==''){
                    $intResultado=$this->MdModelos->agregar($intMarcaId,$strNombre,$strDescripcion,$intEstatus,$dblPrecio);
                }else
                {
                    $intResultado=$this->MdMarcas->editar($intId,$strNombre,$strDescripcion,$intEstatus,$dblPrecio);
                }
                if($intResultado==1){
                    $arrDatos['arrMensajes'] = [array ('intTipo'=>1,'strMensaje'=>'El registro fue guardado')]; 
                }else{
                    $arrDatos['arrMensajes'] = [array ('intTipo'=>2,'strMensaje'=>'error al guardar')]; 
                }
                $this->index($arrDatos);
            }       
        }
        public function editar($intId,$EsEditarGuardar=FALSE){
            if(!$EsEditarGuardar){$arrDatos['registro']= $this->MdMarcas->buscar($intId);}
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas/agregar',$arrDatos,TRUE);
            $this->load->view('principal',$arrDatos); 
        }
        public function eliminar(){
            $intId=$this->input->post('intId');
            if($intId!=''){
                //$intId=$this->encrypt->decode($strId);
                if($this->MdMarcas->eliminar($intId)==1){
                    $arrDatos['arrMensajes']=[array ('intTipo'=>1,'strMensaje'=>'El registro fue eliminado')]; 
                }else{
                    $arrDatos['arrMensajes']=[array ('intTipo'=>2,'strMensaje'=>'Error al eliminar')]; 
                }
            }else{
                $arrDatos['arrMensajes']=[array ('intTipo'=>2,'strMensaje'=>'Error no se debe eliminar así')]; 
            }
            $this->listar($arrDatos);
        }
    }
?>