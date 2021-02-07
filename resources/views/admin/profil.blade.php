@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Profil</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Profil Personel</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                    style="width: 100px; height: 100px; object-fit: cover;"
                    src="/images/personel/{{ $user_auth[0]->foto }}"
                    alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user_auth[0]->nama }}</h3>
                <p class="text-muted text-center">{{ $user_auth[0]->jabatan }}</p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Biodata</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-id-card mr-1"></i> NIK</strong>
                <p class="text-muted">{{ $user_auth[0]->nik }}</p>
                
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted"><a href="mailto:ibeng@senjani.id">{{ $user_auth[0]->email }}</a></p>
                
                <strong><i class="fas fa-phone mr-1"></i> No HP</strong>
                <p class="text-muted"><a href="https://wa.me/6208998679773" target="_blank">{{ $user_auth[0]->wa }}</a></p>
                
                <strong><i class="fas fa-male mr-1"></i><!-- <i class="fas fa-male mr-1"></i> -->Jenis Kelamin</strong>
                <p class="text-muted">{{ $user_auth[0]->jenis_kelamin }}</p>
                
                <strong><i class="fas fa-calendar mr-1"></i> TTL</strong>
                <p class="text-muted">{{ $user_auth[0]->tempat_lahir }}, {{ $user_auth[0]->tanggal_lahir }}</p>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                <p class="text-muted">{{ $user_auth[0]->alamat }}, {{ $user_auth[0]->kelurahan }}, {{ $user_auth[0]->kecamatan }}, {{ $user_auth[0]->kota }}</p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#datadiri" data-toggle="tab">Edit Data Diri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#foto" data-toggle="tab">Ganti Foto Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ganti Password</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="datadiri">
                        <form class="form-horizontal" method="POST" action="/profil/{{ $user->id }}/edit/biodata">
                            @csrf
                            <div class="form-group row">
                                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="number" name="nik" class="form-control" value="{{ $user_auth[0]->nik }}" disabled="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" value="{{ $user_auth[0]->email }}" disabled="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="{{ $user_auth[0]->nama }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="number" name="wa" class="form-control" id="inputNIK" value="{{ $user_auth[0]->wa }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="jenis_kelamin" value="Laki-laki" {{ $user_auth[0]->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }}>
                                            <label for="customRadio1" class="custom-control-label">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="jenis_kelamin" value="Perempuan" {{ $user_auth[0]->jenis_kelamin === 'Perempuan' ? 'checked' : '' }}>
                                            <label for="customRadio2" class="custom-control-label">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">TTL</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{$user_auth[0]->tempat_lahir}}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $user_auth[0]->tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" rows="3">{{ $user_auth[0]->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">Kota, Kecamatan, Kelurahan</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="id_kota">
                                        @foreach ($kota as $k)
                                            <option value="{{$k->id}}" {{ $k->id == $user_auth[0]->id_kota ? 'selected' : '' }}>
                                                {{ $k->kota }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" name="id_kecamatan">
                                        @foreach ($kecamatan as $k)
                                            <option value="{{$k->id}}" {{ $k->id == $user_auth[0]->id_kecamatan ? 'selected' : '' }}>
                                                {{ $k->kecamatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="id_kelurahan">
                                        @foreach ($kelurahan as $k)
                                            <option value="{{$k->id}}" {{ $k->id == $user_auth[0]->id_kelurahan ? 'selected' : '' }}>
                                                {{ $k->kelurahan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="foto">
                        <form class="form-horizontal" method="POST" action="/profil/{{ $user->id }}/edit/foto" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Foto baru</label>
                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="foto">Pilih foto</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="password">
                        <form class="form-horizontal" method="POST" action="/profil/{{ $user->id }}/edit/password">
                            @csrf
                            <div class="form-group row">
                                <label for="password_lama" class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama" name="password_lama" placeholder="Password lama">
                                    @error('password_lama')
                                        <span class="text-sm text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_baru" class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru" placeholder="Password baru">
                                    @error('password_baru')
                                        <span class="text-sm text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_baru_confirmation" class="col-sm-3 col-form-label">Ulangi Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control @error('password_baru_confirmation') is-invalid @enderror" id="password_baru_confirmation" name="password_baru_confirmation" placeholder="Ulangi password baru">
                                    @error('password_baru_confirmation')
                                        <span class="text-sm text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('scripts')
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('front-end-master/js/demo.js') }}"></script>
<!-- SweetAlert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        })

        Toast.fire({
            icon: 'success',
            title: @json(session('status')),
        })
    </script>
@endif


@if(session('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        })

        Toast.fire({
            icon: 'error',
            title: @json(session('error')),
        })
    </script>
@endif
@endpush