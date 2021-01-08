@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Kategori Paket</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/paket">Paket</a></li>
            <li class="breadcrumb-item active">Edit Kategori Paket</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Kategori Paket</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form role="form-horizontal" action="{{ url('/kategori/' . $kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" name="kategori" value="{{ $kategori->kategori }}" class="form-control @error('kategori') is-invalid @enderror" placeholder="Nama Kategori">
                        @error('kategori')                                    
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" name="keterangan"  placeholder="Keterangan">{{ $kategori->keterangan }}</textarea>
                        @error('keterangan')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
</div>
@endsection

@push('scripts')
<script>
    const kelolaPaketMenu = document.getElementById('kelola-paket-menu')
    const paketMenu = document.getElementById('paket-menu')

    kelolaPaketMenu.classList.add('menu-open')
    kelolaPaketMenu.children[0].classList.add('active')
    paketMenu.classList.add('active')
</script>
@endpush