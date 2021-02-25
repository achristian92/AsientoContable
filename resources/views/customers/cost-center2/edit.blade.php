@extends('layouts.customer.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Centro de costos',
        'tab' => 'Finanzas',
    ])
    @component('components.form')
        @slot('title')
            Editar centro de costo <br>
            <small class="text-muted">Crea nuevos centros de costos para distribuir tus ingresos y gastos.</small>
        @endslot
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('admin.customers.cost-center2.update',[$currentCustomer->id,$model->id])}}">
                @method('PUT')
                @include('customers.cost-center2.partials.fields',[
                'back'=> route('admin.customers.cost-center2.index',$currentCustomer->id)
                ])
            </form>
        @endslot
    @endcomponent
@endsection
