<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cotizador</title>
</head>
<style type="text/css">
    html {
        font-size: 10px;
    }
    .customer-container {
        padding: 3mm 0mm;
    }
    .style_hr {
        border: 1px solid red;
    }
</style>
<body>
<div class="customer-container" style="border-style: solid">
    <table width="100%">
        <tr>
            <td width="80%">{{ $customer->name }}</td>
            <td align="right" width="20%"><small>D.S. Nº 020 - 2008</small></td>
        </tr>
        <tr>
            <td width="80%">
                <small>{{ $customer->address }}</small> <br>
                <small>Ruc: {{ $customer->ruc }}</small>
            </td>
            <td align="right" width="20%"><strong><h4>Planilla {{ $payroll->name }}</h4></strong></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td colspan="3" align="center"><strong><h4>BOLETA DE REMUNERACIONES</h4></strong></td>
        </tr>
        <tr>
            <td width="45%">
                <table width="100%">
                    <tr>
                        <td width="24%"><strong>Código</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->code }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Trabajador</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->worked }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Tipo Doc.</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->docType }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Nro Doc.</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->nroDoc }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Tipo/Cat Trab</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->type }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Área</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->area }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Centro costos</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->costCenter }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Cargo</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->position }}</td>
                    </tr>
                </table>
            </td>
            <td width="35%">
                <table width="100%">
                    <tr>
                        <td width="39%"><strong>F. Ingreso</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">{{ $data->admission }}</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>F. Cese</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">{{ $data->termination }}</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Periodo Vac</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%" align="right"><strong>Inicio Vac.</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%" align="right"><strong>Fin Vac.</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Rég. Pensionario</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">{{ $data->pension }}</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>C.U.S.P.P</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Autogenerado</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Sit. Especial</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                </table>
            </td>
            <td width="20%">
                <table width="100%">
                    <tr>
                        <td width="59%"><strong>Días Lab.</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right">{{ $data->workedDays }}</td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Días L.C.G.H</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Días No Lab</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Días Vac.</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>N° Horas Ord.</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right">{{ $data->workedHours }}</td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>N° Hs. Ext. 25%</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>N° Hs. Ext. 35%</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Rem. Mensual</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right">{{ number_format($data->remuneration,2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="33%" align="center" style="border-style: solid"><strong>INGRESOS</strong></td>
            <td width="33%" align="center" style="border-style: solid"><strong>DESCUENTOS</strong></td>
            <td width="33%" align="center" style="border-style: solid"><strong>APORTACIONES EMPLEADOR</strong></td>
        </tr>
        <tr>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    @foreach($data->income as $income)
                        <tr>
                            <td width="70%">{{ $income->header }}</td>
                            <td width="30%" align="right">{{ number_format($income->value,2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    @foreach($data->expense as $expense)
                        <tr>
                            <td width="70%">{{ $expense->header }}</td>
                            <td width="30%" align="right">{{ number_format($expense->value,2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    @foreach($data->contribution as $contribution)
                        <tr>
                            <td width="70%">{{ $contribution->header }}</td>
                            <td width="30%" align="right">{{ number_format($contribution->value,2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%" align="center">TOTAL INGRESOS S/</td>
                        <td width="25%" align="right">{{ number_format($data->income->sum('value'),2) }}</td>
                    </tr>
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%" align="center">TOTAL DESC. S/</td>
                        <td width="25%" align="right">{{ number_format($data->expense->sum('value'),2) }}</td>
                    </tr>
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%" align="center">TOTAL APORTA. S/</td>
                        <td width="25%" align="right">{{ number_format($data->contribution->sum('value'),2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="33%" style="padding-bottom: 25px;
                        padding-top: 25px;">
            </td>
            <td width="33%" align="center">
                <strong>NETO A PAGAR S/{{ number_format($data->net,2) }}</strong>
            </td>
            <td width="33%"><strong></td>
        </tr>
        <tr>
            <td width="33%" align="center">
                ____________________________________<br>
                EMPLEADOR
            </td>
            <td width="33%" align="center">

            </td>
            <td width="33%" align="center">
                ____________________________________<br>
                TRABAJADOR
            </td>
        </tr>
    </table>
    <br>
</div>
<br>
<hr class="style_hr">
<br>
<div class="customer-container" style="border-style: solid">
    <table width="100%">
        <tr>
            <td width="80%">{{ $customer->name }}</td>
            <td align="right" width="20%"><small>D.S. Nº 020 - 2008</small></td>
        </tr>
        <tr>
            <td width="80%">
                <small>{{ $customer->address }}</small> <br>
                <small>Ruc: {{ $customer->ruc }}</small>
            </td>
            <td align="right" width="20%"><strong><h4>Planilla {{ $payroll->name }}</h4></strong></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td colspan="3" align="center"><strong><h4>BOLETA DE REMUNERACIONES</h4></strong></td>
        </tr>
        <tr>
            <td width="45%">
                <table width="100%">
                    <tr>
                        <td width="24%"><strong>Código</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->code }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Trabajador</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->worked }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Tipo Doc.</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->docType }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Nro Doc.</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->nroDoc }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Tipo/Cat Trab</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->type }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Área</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->area }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Centro costos</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->costCenter }}</td>
                    </tr>
                    <tr>
                        <td width="24%"><strong>Cargo</strong></td>
                        <td width="1%">:</td>
                        <td width="75%">{{ $data->position }}</td>
                    </tr>
                </table>
            </td>
            <td width="35%">
                <table width="100%">
                    <tr>
                        <td width="39%"><strong>F. Ingreso</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">{{ $data->admission }}</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>F. Cese</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">{{ $data->termination }}</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Periodo Vac</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%" align="right"><strong>Inicio Vac.</strong></td>
                        <td width="1%">: </td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%" align="right"><strong>Fin Vac.</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Rég. Pensionario</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">{{ $data->pension }}</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>C.U.S.P.P</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Autogenerado</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                    <tr>
                        <td width="39%"><strong>Sit. Especial</strong></td>
                        <td width="1%">:</td>
                        <td width="60%">-</td>
                    </tr>
                </table>
            </td>
            <td width="20%">
                <table width="100%">
                    <tr>
                        <td width="59%"><strong>Días Lab.</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right">{{ $data->workedDays }}</td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Días L.C.G.H</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Días No Lab</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Días Vac.</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>N° Horas Ord.</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right">{{ $data->workedHours }}</td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>N° Hs. Ext. 25%</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>N° Hs. Ext. 35%</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right"></td>
                    </tr>
                    <tr>
                        <td width="59%"><strong>Rem. Mensual</strong></td>
                        <td width="1%">:</td>
                        <td width="40%"align="right">{{ number_format($data->remuneration,2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="33%" align="center" style="border-style: solid"><strong>INGRESOS</strong></td>
            <td width="33%" align="center" style="border-style: solid"><strong>DESCUENTOS</strong></td>
            <td width="33%" align="center" style="border-style: solid"><strong>APORTACIONES EMPLEADOR</strong></td>
        </tr>
        <tr>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    @foreach($data->income as $income)
                        <tr>
                            <td width="70%">{{ $income->header }}</td>
                            <td width="30%" align="right">{{ number_format($income->value,2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    @foreach($data->expense as $expense)
                        <tr>
                            <td width="70%">{{ $expense->header }}</td>
                            <td width="30%" align="right">{{ number_format($expense->value,2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    @foreach($data->contribution as $contribution)
                        <tr>
                            <td width="70%">{{ $contribution->header }}</td>
                            <td width="30%" align="right">{{ number_format($contribution->value,2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%" align="center">TOTAL INGRESOS S/</td>
                        <td width="25%" align="right">{{ number_format($data->income->sum('value'),2) }}</td>
                    </tr>
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%" align="center">TOTAL DESC. S/</td>
                        <td width="25%" align="right">{{ number_format($data->expense->sum('value'),2) }}</td>
                    </tr>
                </table>
            </td>
            <td width="33%" style="border-style: solid">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%" align="center">TOTAL APORTA. S/</td>
                        <td width="25%" align="right">{{ number_format($data->contribution->sum('value'),2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="33%" style="padding-bottom: 25px;
                        padding-top: 25px;">
            </td>
            <td width="33%" align="center">
                <strong>NETO A PAGAR S/{{ number_format($data->net,2) }}</strong>
            </td>
            <td width="33%"><strong></td>
        </tr>
        <tr>
            <td width="33%" align="center">
                ____________________________________<br>
                EMPLEADOR
            </td>
            <td width="33%" align="center">

            </td>
            <td width="33%" align="center">
                ____________________________________<br>
                TRABAJADOR
            </td>
        </tr>
    </table>
    <br>
</div>
</body>
</html>

