<h1>Reporte de medidcion -- FunghiFarm</h1>

<!-- tabla -->
<table class="table table-striped table-dark  table-hover container">
    <thead>
        <th>ID</th>
        <th>Dispositivo</th>
        <th>Temperatura</th>
        <th>Humedad</th>
        <th>Mensaje</th>
        <th>Data</th>
    </thead>    
    <tbody class="">

        <?php foreach($registros as $registro): ?>
            <tr>
                <td><?php  echo($registro->id); ?></td>
                <td><?php  echo($registro->device); ?></td>
                <td><?php  echo($registro->temperature); ?></td>
                <td><?php  echo($registro->humidity); ?></td>
                <td><?php  echo($registro->msg); ?></td>
                <td><?php  echo($registro->time_signal); ?></td>
                
            </tr>
        <?php  endforeach; ?>
    </tbody>
</table>
