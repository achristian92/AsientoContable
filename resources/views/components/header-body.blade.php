<div class="page-header">
    <div class="container-fluid d-sm-flex justify-content-between">
        <h4>{{ $title }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">{{ $tab }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if (isset($current))
                        {{ $current }}
                    @else
                        {{ strtolower($title) }}
                    @endif
                </li>
            </ol>
        </nav>
    </div>
</div>
