@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Usuarios',
        'tab' => 'Accesos',
    ])
    <add-user :p_roles="{{ $roles }}"></add-user>
@endsection
@push('js')
@endpush
