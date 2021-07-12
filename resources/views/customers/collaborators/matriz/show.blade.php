@extends('layouts.customer.app')
@section('content')
    @component('components.list')
        @slot('actions')
        @endslot
        @slot('table')
            <h4>Planilla registradas de <span class="text-primary">{{ $collaborator->full_name }}</span></h4>
            <table class="table">
                <thead class="thead-light">
                <tr class="font-italic font-weight-bold">
                    <th>Fecha</th>
                    <th>Por</th>
                </tr>
                </thead>
                <tbody>
                @forelse($files as $file)
                    <tr>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->createdby->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td rowspan="2" class="text-danger">No tienes ninguna planilla para este colaborador</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection

