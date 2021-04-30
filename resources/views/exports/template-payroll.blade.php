<table class="table table-bordered">
    <thead>
    <tr>
        @foreach($headers as $header)
            <th style="background-color: {{ $header['bgColor'] }}">{{ $header['nroAccount'] }}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($headers as $header)
            <th style="background-color: {{ $header['bgColor'] }}">{{ $header['name'] }}</th>
        @endforeach
    </tr>
    </thead>
</table>
