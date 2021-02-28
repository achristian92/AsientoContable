@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Usuarios',
        'tab' => 'Accesos',
    ])
    <user-form :p_roles="{{ $roles }}"
               :p_user="{{ $model }}"
               :p_user_roles_ids="{{ json_encode($RolesIDS) }}"
               :p_customers="{{ $customers }}">
    </user-form>
@endsection
@push('js')
@endpush
