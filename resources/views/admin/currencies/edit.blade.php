@extends('layouts.admin.app')
@section('content')
    @component('components.form')
        @slot('title')
            Editar Moneda
        @endslot
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('admin.currencies.update',$model->id)}}">
                @method('PUT')
                @include('admin.currencies.partials.fields',[
                'back'=> route('admin.currencies.index')
                ])
            </form>
        @endslot
    @endcomponent
@endsection
