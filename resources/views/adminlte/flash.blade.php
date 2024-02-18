@if (session('Sukses'))
    <div class="alert alert-success">
    {{session ('Sukses') }}
    </div>
@endif

@if (session('gagal'))
    <div class="alert alert-danger">
    {{session ('gagal') }}
    </div>
@endif