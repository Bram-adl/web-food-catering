@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Jabatan Personel</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/jabatan">Jabatan</a></li>
            <li class="breadcrumb-item active">Edit Jabatan</li>
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
                <h3 class="card-title">Edit Data Jabatan</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form role="form-horizontal" action="{{ url('/jabatan/' . $jabatan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jabatan" class="form-control" value="{{ $jabatan->jabatan }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="keterangan" rows="3">{{ $jabatan->keterangan }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="warna" class="col-sm-2 col-form-label">Warna Label</label>
                    <div class="col-sm-10">
                        <input type="color" id="warna" name="warna" class="form-control  @error('warna') is-invalid @enderror" value="{{ $jabatan->warna }}">
                        @error('warna') 
                            <span class="text-sm text-danger">{{ $message }}</span>
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
    const kelolaPersonelMenu = document.getElementById('kelola-personel-menu')
    const jabatanMenu = document.getElementById('jabatan-menu')

    kelolaPersonelMenu.classList.add('menu-open')
    kelolaPersonelMenu.children[0].classList.add('active')
    jabatanMenu.classList.add('active')
</script>
@endpush