@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Pelanggan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/pelanggan">Pelanggan</a></li>
            <li class="breadcrumb-item active">Edit Pelanggan</li>
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
                <h3 class="card-title">Edit Data Pelanggan</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form role="form-horizontal" action="{{ url('/pelanggan/' . $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="{{ $pelanggan->nama }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap">
                        @error('nama')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $pelanggan->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        @error('email')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="wa" class="col-sm-2 col-form-label">No WhatsApp</label>
                    <div class="col-sm-10">
                        <input type="number" name="wa" value="{{ $pelanggan->wa }}" class="form-control @error('wa') is-invalid @enderror" placeholder="No WA">
                        @error('wa')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rumah_teks" class="col-sm-2 col-form-label">Alamat Rumah</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('rumah_teks') is-invalid @enderror" name="rumah_teks" value="{{ $pelanggan->rumah_teks }}" rows="3" placeholder="Alamat Lengkap"></textarea>
                        @error('rumah_teks')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Daerah Rumah</label>
                    <div class="col-sm-3">
                        <select class="custom-select @error('rumah_kota') is-invalid @enderror" name="rumah_kota">
                            <option selected hidden value="">-- Pilih Kota --</option>
                            @foreach ($kota as $k)
                            <option value="{{ $k->id }}" {{ $pelanggan->rumah_kota == $k->id ? 'selected' : '' }}>{{ $k->kota }}</option>
                            @endforeach
                        </select>
                        @error('rumah_kota')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <select class="custom-select @error('rumah_kecamatan') is-invalid @enderror" name="rumah_kecamatan">
                            <option selected hidden value="">-- Pilih Kecamatan --</option>
                            @foreach ($kecamatan as $k)
                            <option value="{{ $k->id }}" {{ $pelanggan->rumah_kecamatan == $k->id ? 'selected' : '' }}>{{ $k->kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('rumah_kecamatan')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <select class="custom-select @error('rumah_kelurahan') is-invalid @enderror" name="rumah_kelurahan">
                            <option selected hidden value="">-- Pilih Kelurahan --</option>
                            @foreach ($kelurahan as $k)
                            <option value="{{ $k->id }}" {{ $pelanggan->rumah_kelurahan == $k->id ? 'selected' : '' }}>{{ $k->kelurahan }}</option>
                            @endforeach
                        </select>
                        @error('rumah_kelurahan')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rumah_maps" class="col-sm-2 col-form-label">Link GMaps Rumah</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('rumah_maps') is-invalid @enderror" name="rumah_maps" value="{{ $pelanggan->rumah_maps }}" placeholder="link GMaps">
                        @error('rumah_maps')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kantor_teks" class="col-sm-2 col-form-label">Alamat Kantor</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('kantor_teks') is-invalid @enderror" rows="3" name="kantor_teks" value="{{ $pelanggan->kantor_teks }}" placeholder="Alamat Lengkap"></textarea>
                        @error('kantor_teks')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Daerah Kantor</label>
                    <div class="col-sm-3">
                        <select class="custom-select @error('kantor_kota') is-invalid @enderror" name="kantor_kota">
                            <option selected hidden value="">-- Pilih Kota --</option>
                            @foreach ($kota as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $pelanggan->kantor_kota ? 'selected' : '' }}>{{ $k->kota }}</option>
                            @endforeach
                        </select>
                        @error('kantor_kota')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <select class="custom-select @error('kantor_kecamatan') is-invalid @enderror" name="kantor_kecamatan">
                            <option selected hidden value="">-- Pilih Kecamatan --</option>
                            @foreach ($kecamatan as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $pelanggan->kantor_kecamatan ? 'selected' : '' }}>{{ $k->kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kantor_kecamatan')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <select class="custom-select @error('kantor_kelurahan') is-invalid @enderror" name="kantor_kelurahan">
                            <option selected hidden value="">-- Pilih Kelurahan --</option>
                            @foreach ($kelurahan as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $pelanggan->kantor_kelurahan ? 'selected' : '' }}>{{ $k->kelurahan }}</option>
                            @endforeach
                        </select>
                        @error('kantor_kelurahan')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kantor_maps" class="col-sm-2 col-form-label">Link GMaps Kantor</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('kantor_maps') is-invalid @enderror" name="kantor_maps" value="{{ $pelanggan->kantor_maps }}" placeholder="link GMaps"></input>
                        @error('kantor_maps')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Alergi & Keterangan Lain</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" placeholder="Keterangan">{{ $pelanggan->keterangan }}</textarea>
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
    const pelangganMenu = document.getElementById('pelanggan-menu');
    pelangganMenu.classList.add('active');
</script>
@endpush