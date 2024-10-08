<?php
class CalendarioController {
    public function gerarCalendario($mes, $ano) {
        $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $diaDaSemana = date('w', mktime(0, 0, 0, $mes, 1, $ano));

        $calendario = "<table>
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

        for ($i = 0; $i < $diaDaSemana; $i++) $calendario .= "<td></td>";
        for ($dia = 1; $dia <= $diasNoMes; $dia++) {
            if (($dia + $diaDaSemana - 1) % 7 == 0) $calendario .= "</tr><tr>";
            $calendario .= "<td>$dia</td>";
        }
        while (($diaDaSemana + $diasNoMes) % 7 != 0) { $calendario .= "<td></td>"; $diasNoMes++; }

        $calendario .= "</tr></table>";

        return $calendario;
    }
}
?>