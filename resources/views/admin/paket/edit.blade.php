@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Paket</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/paket">Paket</a></li>
            <li class="breadcrumb-item active">Edit Paket</li>
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
                <h3 class="card-title">Edit Data Paket</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form role="form-horizontal" action="{{ url('/paket/' . $paket->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="paket" class="col-sm-2 col-form-label">Nama Paket</label>
                    <div class="col-sm-10">
                        <input type="text" id="paket" name="paket" value="{{ $paket->paket }}" class="form-control @error('paket') is-invalid @enderror" placeholder="Nama Paket">
                        @error('paket')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="porsi" class="col-sm-2 col-form-label">Jumlah Porsi</label>
                    <div class="col-sm-10">
                        <input type="number" id="porsi" name="porsi" value="{{ $paket->porsi }}" class="form-control @error('porsi') is-invalid @enderror" placeholder="Jumlah porsi dalam paket">
                        @error('porsi')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="custom-select @error('id_kategori') is-invalid @enderror" name="id_kategori">
                            <option value="" selected disabled hidden>-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                            <option value="{{ $k->id }}" {{ $k->id === $paket->id_kategori ? 'selected' : '' }}>{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga Paket</label>
                    <div class="col-sm-10">
                        <input type="number" id="harga" name="harga" value="{{ $paket->harga }}" class="form-control @error('harga') is-invalid @enderror" placeholder="Harga Paket">
                        @error('harga')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Paket</label>
                    <div class="col-sm-10">
                        <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
                        @error('foto')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="waktu" class="col-sm-2 col-form-label">Bisa dikirim pada waktu</label>
                    <div class="col-sm-10">
                        <div class="icheck-primary">
                            <input type="hidden" name="pagi" value="0">
                            <input type="checkbox" id="pagi" value="1" name="pagi" {{ $paket->pagi === 1 ? 'checked' : '' }}>
                            <label for="pagi">Pagi</label>
                        </div>
                        <div class="icheck-primary">
                            <input type="hidden" name="siang" value="0">
                            <input type="checkbox" id="siang" value="1" name="siang" {{ $paket->siang === 1 ? 'checked' : '' }}>
                            <label for="siang">Siang</label>
                        </div>
                        <div class="icheck-primary">
                            <input type="hidden" name="sore" value="0">
                            <input type="checkbox" id="sore" value="1" name="sore" {{ $paket->sore === 1 ? 'checked' : '' }}>
                            <label for="sore">Sore</label>
                        </div>
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