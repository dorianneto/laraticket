@if (session()->has('notice'))
    <div class="container">
        <div class="alert alert-{{ session('notice.status') }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('notice.message') }}
        </div>
    </div>
@endif