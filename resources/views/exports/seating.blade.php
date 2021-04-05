<table class="table table-bordered">
    <thead>
    <tr>
        <th><strong>SUB</strong></th>
        <th><strong>N°AS.</strong></th>
        <th><strong>L/REGISTRO</strong></th>
        <th><strong>F.REGISTRO</strong></th>
        <th><strong>MES</strong></th>
        <th><strong>CUENTA</strong></th>
        <th><strong>DEBE S/</strong></th>
        <th><strong>HABER S/</strong></th>
        <th><strong>M</strong></th>
        <th><strong>T/C</strong></th>
        <th><strong>DEBE US$</strong></th>
        <th><strong>HABER US$</strong></th>
        <th><strong>GLOSA ASIENTO</strong></th>
        <th><strong>RUC/DNI</strong></th>
        <th><strong>DOC</strong></th>
        <th><strong>NUM/DOC</strong></th>
        <th><strong>F. DOC</strong></th>
        <th><strong>F. VENC</strong></th>
        <th><strong>COSTO</strong></th>
        <th><strong>COSTO2</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $seat)
        <tr>
            <td>{{ $seat['sub_diario'] }}</td>
            <td>{{ $seat['nro_asiento'] }}</td>
            <td>{{ $seat['l_registro'] }}</td>
            <td>{{ $seat['fecha_registro'] }}</td>
            <td>{{ $seat['mes'] }}</td>
            <td>{{ $seat['cuenta_contable'] }}</td>
            <td>{{ $seat['debe'] }}</td>
            <td>{{ $seat['haber'] }}</td>
            <td>{{ $seat['moneda'] }}</td>
            <td>{{ $seat['tipo_cambio'] }}</td>
            <td>{{ $seat['debe_usd'] }}</td>
            <td>{{ $seat['haber_usd'] }}</td>
            <td>{{ $seat['glosa_asiento'] }}</td>
            <td>{{ $seat['nro_documento'] }}</td>
            <td>{{ $seat['doc'] }}</td>
            <td>{{ $seat['nro_doc'] }}</td>
            <td>{{ $seat['fecha_doc'] }}</td>
            <td>{{ $seat['fecha_vencimiento'] }}</td>
            <td>{{ $seat['cost'] }}</td>
            <td>{{ $seat['cost2'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
