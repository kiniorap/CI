<div class="card">
  <h5 class="card-header">Agregar Producto<a href="<?= base_url()?>marcas" class="btn btn-secondary float-right">ATRAS</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-5">
                <form id="frmDatosEnvio" action="<?= base_url()?>pedidos/datosEnvio" method="POST">
                <input type="hidden" name="intMarcaId" value="<?php if(isset($intMarcaId)) $intMarcaId; else 0;?>" > 
                    <div class="form-group">
                        <label for="txtNombre">NOMBRE:</label>
                        <input type="text" name="strNombre" class="form-control" id="strNombre" onchange="submit();" placeholder="Ingrese el nombre" value="<?php echo $this->objDatosEnvio->nombre?>">
                    </div>
                    <?php echo form_error('strNombre')?>
                    <div class="form-group">
                        <label for="txtFecha">FECHA DE ENTREGA:</label>
                        <input type="date" name="strFechaEntrega" class="form-control" id="txtFechaEntrega" onchange="submit();" value="<?php if($this->objDatosEnvio->nombre != "") {echo $this->objDatosEnvio->fechaEntrega;}?>" <?php if ($this->objDatosEnvio->nombre == "") echo 'disabled'?>>
                    </div>
                    <?php echo form_error('strFechaEntrega')?>
                    <div class="form-group">
                        <label for="txtDescripcion">DIRECCION DE ENTREGA:</label>
                        <textarea class="form-control" name="strDireccion" id="strDireccion" onchange="submit();" placeholder="Ingrese su dirección" <?php if ($this->objDatosEnvio->nombre == "" OR $this->objDatosEnvio->fechaEntrega == "") echo 'disabled'?>><?php if($this->objDatosEnvio->nombre != "" AND $this->objDatosEnvio->fechaEntrega != "") {echo $this->objDatosEnvio->direccion;}?></textarea>
                    </div>
                    <?php echo form_error('strDireccion')?>
                    <div class="form-group">
                        <label for="txtCostoEnvio">COSTO DE ENVIO:</label>
                        <input type="number" name="dblCostoEnvio" class="form-control" id="dblCostoEnvio" onchange="submit();" placeholder="<?php if ($this->objDatosEnvio->costoEnvio == NULL) {
                            echo "$0";
                        } ?>" value="<?php if($this->objDatosEnvio->nombre != "" AND $this->objDatosEnvio->fechaEntrega != "" AND $this->objDatosEnvio->direccion != "") {echo $this->objDatosEnvio->costoEnvio;}?>"<?php if ($this->objDatosEnvio->nombre == "" OR $this->objDatosEnvio->fechaEntrega == "" OR $this->objDatosEnvio->direccion == "") echo 'disabled'?>>
                    </div>
                    <?php echo form_error('dblCostoEnvio')?>
                    <div class="form-group">
                        <label for="txtEstatus">ESTATUS:</label>
                        <select name="intEstatus" id="cmbEstatus" class="form-control" onchange = "submit();" <?php if ($this->objDatosEnvio->nombre == "" OR $this->objDatosEnvio->fechaEntrega == "" OR $this->objDatosEnvio->direccion == "" OR $this->objDatosEnvio->costoEnvio == "") echo 'disabled'?>>
                            <option value="0">[Seleccion el Estatus]</option>
                            <option value="1"<?php if($this->objDatosEnvio->nombre != "" AND $this->objDatosEnvio->fechaEntrega != "" AND $this->objDatosEnvio->direccion != "" AND $this->objDatosEnvio->costoEnvio != "") {if($this->objDatosEnvio->estatus == 1){ echo 'selected';}}?>>En Proceso</option>
                            <option value="2"<?php if($this->objDatosEnvio->nombre != "" AND $this->objDatosEnvio->fechaEntrega != "" AND $this->objDatosEnvio->direccion != "" AND $this->objDatosEnvio->costoEnvio != "") {if($this->objDatosEnvio->estatus == 2){ echo 'selected';}}?>>En Camino</option>
                            <option value="3"<?php if($this->objDatosEnvio->nombre != "" AND $this->objDatosEnvio->fechaEntrega != "" AND $this->objDatosEnvio->direccion != "" AND $this->objDatosEnvio->costoEnvio != "") {if($this->objDatosEnvio->estatus == 3){ echo 'selected';}}?>>Cancelado</option>
                        </select>
                    </div>
                    <?php echo form_error('intEstatus')?>
                </form>  
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE LA MARCA:</label>
                        <div class="form-group">
                            <form id="frmCargarModelos" action="<?= base_url()?>pedidos" method="POST">    
                                <select name="intMarcaId" id="cmbMarca" class="form-control"  onchange ="submit();" >
                                <option value="0">[Marca]</option>
                                <?php foreach($arrMarcas as $objMarcas)  {?>
                                    <option value="<?=$objMarcas->id?>" <?php if($objMarcas->id == $intMarcaId) echo 'selected'?>><?=$objMarcas->nombre?></option>
                                <?php } ?>
                                </select>    
                            </form>
                        </div>
                    </div>
                    <?php echo form_error('intMarcaId')?> 
                <form id="frmAgregarCarrito" action="<?=base_url()?>pedidos/agregarCarrito" method="POST">  
                    <input type="hidden" name="intMarcaId" value="<?php if(isset($intMarcaId)) $intMarcaId; else 0;?>" > 
                    <div class="form-group">
                        <label for="txtProducto">SELECCIONE EL MODELO:</label>
                        <div class="form-group">
                        <select name="intModeloId" id="cmbModelos" class="form-control" required <?php if($intMarcaId == 0) echo 'disabled' ?>>
                                <option value="0">[Modelos]</option>
                                <?php foreach($arrModelos as $objModelos)  {?>
                                    <option value="<?=$objModelos->id?>" <?php if($objModelos->id == $intMarcaId) echo 'selected'?>><?=$objModelos->nombre?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>  
                    <?php echo form_error('intModeloId')?>
                    <div class="form-group">
                        <label for="txtProducto">CANTIDAD:</label>
                        <input type="number" class="form-control" name="intCantidad" id="txtCantidad" max="50" min="1" value="1" <?php if(isset($intMarcaId)) $intMarcaId; else $intMarcaId=0; if($intMarcaId == 0) echo 'disabled' ?>>
                    </div>
                    <?php echo form_error('intCantidad')?>
                    <button type="button" class="btn btn-info float-right" onclick="submit();" <?php if($intMarcaId==0) echo 'disabled'?> >AGREGAR PRODUCTO</button>   
                </form>
            </div>
            <div class="col-span-7">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($this->arrCarrito as $objModelo)  {?>
                            <tr>
                                <td><?=$objModelo->id ?></td>
                                <td><?=$objModelo->marca_id ?></td>
                                <td><?=$objModelo->nombre ?></td>
                                <td><?=$objModelo->cantidad ?></td>
                                <td><?=$objModelo->precio ?></td>
                                <td><?=$objModelo->subTotal ?></td>
                                <td>
                                    <form action="<?= base_url()?>pedidos/eliminarCarrito/" method="post">
                                        <input type="hidden" value="<?=$objModelo->id?>" name="intModeloId">
                                        <button type="submit" class="btn btn-danger">ELIMINAR</button>
                                    </form>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table> 
                </div>
                <div class="row justify-content-end">
            <div class="col-6">
                <table class="table" border="1" >
                    <tr>
                        <td>SubTotal</td>
                        <td align="right">$ <?= $dblSubTotal?></td>
                    </tr>
                    <tr>
                        <td>Costo de envio</td>
                        <td align="right">$ <?= $dblCostoEnvio?></td>
                    </tr>
                    <tr>
                        <td>Iva</td>
                        <td align="right">$ <?= $dblSubTotalIva?></td>
                    </tr>
                    <tr>
                        <td>Total a Pagar</td>
                        <td align="right">$ <?= $dblTotal?></td>
                    </tr>
                </table> 
            </div>
        </div>       
            </div>
        </div>
    </div>
</div>
<br>
<form action="<?= base_url()?>pedidos/guardar/" method="post">
    <input type="hidden" value="" name="intPedidoId">
    <button type="submit" class="btn btn-primary float-right">CONCLUIR PEDIDO</button>
</form>
<?php

?>