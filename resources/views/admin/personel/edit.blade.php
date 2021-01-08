@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Personel</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/personel">Personel</a></li>
            <li class="breadcrumb-item active">Edit Personel</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('main-content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Personel</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form role="form-horizontal" action="{{ url('/personel/' . $personel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ $personel->nik }}" disabled>
                        @error('nik')
                            <span class="text-red text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $personel->email }}" disabled>
                        @error('email')
                            <span class="text-red text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ $personel->nama }}">
                        @error('nama')
                            <span class="text-red text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" placeholder="Kosongkan jika tidak diubah">
                            @error('password')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                <div class="form-group row">
                    <label for="wa" class="col-sm-2 col-form-label">No WA</label>
                    <div class="col-sm-10">
                        <input type="number" name="wa" class="form-control @error('wa') is-invalid @enderror" id="wa" value="{{ $personel->wa }}">
                        @error('wa')
                            <span class="text-red text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <!-- radio -->
                        <div class="form-group mb-0">
                            <div class="m-0">
                                <input class="" type="radio" id="Laki-laki" value="Laki-laki" name="jenis_kelamin" {{ $personel->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                                <label for="Laki-laki" class="m-0" for="Laki-laki">Laki-laki</label>
                            </div>
                            <div class="m-0">
                                <input class="" type="radio" id="Perempuan" value="Perempuan" name="jenis_kelamin" {{ $personel->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                <label for="Perempuan" class="m-0" for="Perempuan">Perempuan</label>
                            </div>
                            @error('jenis_kelamin')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">TTL</label>
                    <div class="col-sm-6">
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ $personel->tempat_lahir }}">
                        @error('tempat_lahir')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ $personel->tanggal_lahir }}">
                        @error('tempat_lahir')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label @error('jabatan') is-invalid @enderror">Jabatan</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="id_jabatan" id="jabatan">
                            @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}" {{ $personel->id_jabatan == $j->id ? 'selected' : '' }}>{{ $j->jabatan }}</option>
                            @endforeach
                        </select>
                        @error('jabatan')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" class="custom-file-input" name="foto">
                        <label class="custom-file-label" for="foto">Kosongkan jika tidak ingin mengganti foto</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $personel->alamat }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Daerah</label>
                        <div class="col-sm-3">
                            <select class="custom-select @error('kota') is-invalid @enderror" name="id_kota">
                                <option selected hidden disabled value="">-- Pilih Kota --</option>
                                @foreach ($kota as $k)
                                <option value="{{ $k->id }}" {{ $k->id == $personel->id_kota ? 'selected' : '' }}>{{ $k->kota }}</option>
                                @endforeach
                            </select>
                            @error('kota')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <select class="custom-select @error('kecamatan') is-invalid @enderror" name="id_kecamatan">
                                <option selected hidden disabled value="">-- Pilih Kecamatan --</option>
                                @foreach ($kecamatan as $k)
                                <option value="{{ $k->id }}" {{ $k->id === $personel->id_kecamatan ? 'selected' : '' }}>{{ $k->kecamatan }}</option>
                                @endforeach
                            </select>
                            @error('kecamatan')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <select class="custom-select @error('kelurahan') is-invalid @enderror" name="id_kelurahan">
                                <option selected hidden disabled value="">-- Pilih Kelurahan --</option>
                                @foreach ($kelurahan as $k)
                                <option value="{{ $k->id }}" {{ $k->id === $personel->id_kelurahan ? 'selected' : '' }}>{{ $k->kelurahan }}</option>
                                @endforeach
                            </select>
                            @error('kelurahan')
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
    const personelMenu = document.getElementById('personel-menu')

    kelolaPersonelMenu.classList.add('menu-open')
    kelolaPersonelMenu.children[0].classList.add('active')
    personelMenu.classList.add('active')
</script>
@endpush