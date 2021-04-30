@extends('layouts.admin.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <form action="{{ route('admin.history.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text"
                                       name="q"
                                       class="form-control"
                                       placeholder="Buscar.."
                                       value="{{ request()->input('q') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th>DESCRIPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $history)
                                    <tr>
                                        <td>
                                            {{ $history->description }} <br>
                                            <small>
                                                <i class="fa fa-info-circle"></i>  {{ $history->id }} |
                                                <i class="far fa fa-edit mr-1 ml-1"></i> {{ $history->type }} |
                                                @if($history->type === \App\Models\History::IMPORT_TYPE)
                                                    <a href="{{ $history->file_url }}">
                                                        <i class="far fa fa-upload mr-1 ml-1"></i> Descargar |
                                                    </a>
                                                @endif
                                                <i class="far fa fa-user-o mr-1 ml-1"></i> {{ $history->user->full_name }} |
                                                <i class="far fa fa-clock-o mr-1 ml-1"></i> {{ \Carbon\Carbon::parse($history->created_at)->format('d/m/y h:i') }} </small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
