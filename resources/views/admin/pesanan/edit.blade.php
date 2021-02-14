@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Pesanan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/paket">Pesanan</a></li>
            <li class="breadcrumb-item active">Edit Pesanan</li>
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
            <form role="form-horizontal" action="{{ url('/pesanan/ganti_jadwal/' . $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="tanggal_baru" class="col-sm-3 col-form-label">Tanggal Pengganti</label>
                    <div class="col-sm-9">
                        <input type="date" id="tanggal_baru" name="tanggal_baru" value="{{ $pesanan->id }}" class="form-control @error('tanggal_baru') is-invalid @enderror">
                        @error('tanggal_baru')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_terakhir" class="col-sm-3 col-form-label">Tanggal Terakhir Pengiriman</label>
                    <div class="col-sm-9">
                        <input type="date" id="tanggal_terakhir" name="tanggal_terakhir" value="{{ $tanggal_terakhir[0]->tanggal_kirim }}" class="form-control" readonly disabled>
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