<div class="col-md-3 app-sidebar">
    <div class="card">
        <div class="app-sidebar-menu" tabindex="1" style="overflow: hidden; outline: none;">
            <div class="list-group list-group-flush">
                @foreach($files as $file)
                    <a href="{{ route('admin.customers.accounting-seat.show',[$currentCustomer->id,$file->id]) }}"
                       class="list-group-item d-flex align-items-center {{ (int) request()->segment(5) === $file->id ? 'text-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud width-15 height-15 mr-2"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                        {{ $file->name }}
                        <span class="small ml-auto">{{ $file->totalSeating }}</span>
                    </a>
                @endforeach
            </div>
            @if ($files->isEmpty())
                <div class="card-body">
                    <h6 class="mb-4 text-muted">Aún no tienes planillas subidas</h6>
                    <div class="align-items-center">
                        <div class="card">
                            <img src="{{ asset('img/upload_fle.png') }}" style="object-fit: cover" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
