@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Fondo pensiones',
        'tab' => 'Finanzas',
    ])
    @component('components.form')
        @slot('title','Crear fondo pensión')
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{ route('admin.pensions.update',$model->id)}} ">
                @method('PUT')
                @include('admin.pension-fund.partials.fields',[
                'back'=> route('admin.pensions.index')
                ])
            </form>
        @endslot
    @endcomponent
@endsection
