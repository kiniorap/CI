<div class="card">
    <h5 class="card-header">Resumen<a href="<?= base_url()?>pedidos/agregar" class="btn btn-primary float-right">AGREGAR</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="50px">PEDIDO</th>
                                <th scope="col">COMPRADOR</th>
                                <th scope="col">DIRECCIÓN</th>
                                <th scope="col">ESTATUS</th>
                                <th scope="col" width="50px">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($arrModelos as $objetos) {?>
                            <tr>
                                <td scope="row"><?=$objetos->id?></td>
                                <td><?=$objetos->nombre_cliente?></td>
                                <td><?=$objetos->direccion?></td>
                                <td><?=$objetos->estatus?></td>
                                <td>$</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table> 
                </div>   
            </div>
        </div>   
        <div class="row justify-content-end">
            <div class="col-3">
                <table class="table" border="1">
                    <tr>
                        <td>SubTotal del Día</td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td>Iva 16%</td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td>Total del Día</td>
                        <td>$</td>
                    </tr>
                </table> 
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-4">
            <form class="form-inline mr-auto">
                <button class="btn btn-primary btn-rounded btn-sm my-0" type="submit">Cambiar Estatus del Pedido</button>
            </form>
        </div> 
        <div class="col-8">
            <form class="form-inline mr-auto float-right">
                <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-info btn-rounded btn-sm my-0" type="submit">Buscar</button>
            </form>
        </div>   
    </div>
</div>
<?php 

?>