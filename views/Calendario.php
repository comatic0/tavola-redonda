<?php
session_start();
  require '../includes/db.php'; 
  require '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


function gerarCalendario($mes, $ano) {
    $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    $diaDaSemana = date('w', mktime(0, 0, 0, $mes, 1, $ano));

    echo "<table>
            <tr>
                <th>Dom</th>
                <th>Seg</th>
                <th>Ter</th>
                <th>Qua</th>
                <th>Qui</th>
                <th>Sex</th>
                <th>Sáb</th>
            </tr>
            <tr>";

    for ($i = 0; $i < $diaDaSemana; $i++) echo "<td></td>";
    for ($dia = 1; $dia <= $diasNoMes; $dia++) {
        if (($dia + $diaDaSemana - 1) % 7 == 0) echo "</tr><tr>";
        echo "<td>$dia</td>";
    }
    while (($diaDaSemana + $diasNoMes) % 7 != 0) { echo "<td></td>"; $diasNoMes++; }

    echo "</tr></table>";
}

// Exibir o calendário do mês atual
gerarCalendario(date('n'), date('Y'));
?>

?>