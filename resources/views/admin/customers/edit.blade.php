@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Clientes',
        'tab' => 'Gestión comercial',
    ])
    @component('components.form')
        @slot('title','Editar cliente')
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('admin.customers.update',$model->id)}}">
                @method('PATCH')
                @include('admin.customers.partials.fields',[
                'back'=> route('admin.customers.index')
                ])
            </form>
            @include('components.destroy',['route'=> route('admin.customers.destroy',$model->id), 'id' => $model->id])
        @endslot
    @endcomponent
@endsection
