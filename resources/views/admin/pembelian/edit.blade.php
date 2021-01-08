@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Pembelian</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/pembelian">Pembelian</a></li>
            <li class="breadcrumb-item active">Edit Data Pembelian</li>
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
            <form role="form-horizontal" action="{{ url('/pembelian/' . $pembelian->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="pelanggan" class="col-sm-2 col-form-label">Pelanggan</label>
                    <div class="col-sm-10">
                        <select class="custom-select @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan">
                            <option value="" selected hidden disabled>-- Pilih Pelanggan --</option>
                            @foreach ($pelanggan as $p)
                                <option value="{{ $p->id }}" {{ $p->id === $pembelian->id_pelanggan ? 'selected' : '' }}>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_pelanggan')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paket" class="col-sm-2 col-form-label">Paket</label>
                    <div class="col-sm-10">
                        <select class="custom-select @error('id_paket') is-invalid @enderror" name="id_paket">
                            <option value="" selected hidden disabled>-- Pilih Paket --</option>
                            @foreach($paket as $p)
                                <option value="{{ $p->id }}" {{ $p->id === $pembelian->id_paket ? 'selected' : '' }}>{{ $p->paket }}</option>
                            @endforeach
                        </select>
                        @error('id_paket')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bukti_bayar" class="col-sm-2 col-form-label">Bukti Bayar</label>
                    <div class="col-sm-10">
                        <input type="file" class="custom-file-input @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar" name="bukti_bayar">
                        <label class="custom-file-label text-muted" for="bukti_bayar">Kosongkan jika tidak ingin mengganti bukti bayar</label>
                        @error('bukti_bayar')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="status">
                            <option {{ $pembelian->status == 'Belum bayar' ? 'selected' : '' }} value="Belum bayar">Belum bayar</option>
                            <option {{ $pembelian->status == 'Proses verifikasi' ? 'selected' : '' }} value="Proses verifikasi">Proses verifikasi</option>
                            <option {{ $pembelian->status == 'Aktif' ? 'selected' : '' }} value="Aktif">Aktif</option>
                            <option {{ $pembelian->status == 'Selesai' ? 'selected' : '' }} value="Selesai">Selesai</option>
                        </select>
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
    const pembelianMenu = document.getElementById('pembelian-menu');
    pembelianMenu.classList.add('active');
</script>
@endpush