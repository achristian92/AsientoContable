<table class="table table-bordered">
    <thead>
    <tr>
        <th><strong>NOMBRES COMPLETO</strong></th>
        <th><strong>CÓDIGO</strong></th>
        <th><strong>TIPO DOC</strong></th>
        <th><strong>NRO DOC</strong></th>
        <th><strong>FECHA INGRESO</strong></th>
        <th><strong>CUSPP</strong></th>
        <th><strong>AUTOGENERADO</strong></th>
        <th><strong>SIT ESPECIAL</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee['user'] }}</td>
            <td>{{ $employee['code'] }}</td>
            <td>{{ $employee['docType'] }}</td>
            <td>{{ $employee['nroDoc'] }}</td>
            <td>{{ $employee['startWork'] }}</td>
            <td>{{ $employee['cuspp'] }}</td>
            <td>{{ $employee['codeCuspp'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
