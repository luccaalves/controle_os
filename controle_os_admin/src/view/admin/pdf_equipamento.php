<?php

include_once dirname(__DIR__, 2) . '/resource/dataview/gerar_pdf_dataview.php';

use Src\Controller\NovoEquipamentoCTRL;
use Src\public\Util;


if(isset($_POST['btn_pdf'])){
    $tipo_filtro = $_POST['tipo'];
    $modelo_filtro = $_POST['modelo'];
    

    $dados = (new NovoEquipamentoCTRL)->FiltrarNovoEquipamentoCTRL($tipo_filtro, $modelo_filtro);

    $cabecalho = "<center>Equipamentos Encontrados</center><hr>";
    $table_inicial = "<table width = '100%'>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Modelo</th>
            <th>Identificação</th>
            <th>Descrição</th>
            <th>Situação</th>
        </tr>
    </thead>
    <tbody>";
    $table_data = "";
    foreach ($equipamentos as $eqp) { 
           $table_data .="<tr>
                <td>" . $eqp['nome_tipo']  . "</td>
                <td>" . $eqp['nome_modelo'] . "</td>
                <td>" . $eqp['identificacao'] . "</td>
                <td>" . $eqp['descricao']  . "</td>
                <td>" . Util::MostrarSituacao($eqp['situacao'])  . "</td>
            </tr>";
        }
        $table_data .= '</tbody></table>';
        $resultado = $cabecalho . $table_inicial . $table_data;
        
        $dompdf->LoadHtml($resultado);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
}