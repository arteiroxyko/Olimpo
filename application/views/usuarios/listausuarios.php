<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <h2 class="panel-title pull-left">Usuarios</h2>
      <a href="<?php echo site_url("c_usuarios/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    </div>
    <div class="panel-body ">
      <table class="table table-hover dataTables">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Editar</th>
          </tr>
        </thead>
        <tbody>
            <?php 
              foreach ($usuarios as $row) {
                 echo "<tr>";
                      echo "<td>$row->usuNome</td>";
                      echo "<td><a href=".site_url('c_usuarios/editar/'.$row->usuId)." class='button tiny'>Editar</a></td>";
                 echo "</tr>" ;
              }
            ?>  
        </tbody>
      </table>
    </div>
  </div>
</div>