@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Profil</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
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
                    src="img/personel/ibeng-160.jpg"
                    alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Ibeng Abdul Latif</h3>
                <p class="text-muted text-center">Chief Executive Officer</p>
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
                <p class="text-muted">3206190207970001</p>
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted"><a href="mailto:ibeng@senjani.id">ibeng@senjani.id</a></p>
                <strong><i class="fas fa-phone mr-1"></i> No HP</strong>
                <p class="text-muted"><a href="https://wa.me/6208998679773" target="_blank">08998679773</a></p>
                <strong><i class="fas fa-male mr-1"></i><!-- <i class="fas fa-male mr-1"></i> -->Jenis Kelamin</strong>
                <p class="text-muted">Laki-laki</p>
                <strong><i class="fas fa-calendar mr-1"></i> TTL</strong>
                <p class="text-muted">Tasikmalaya, 18 Januari 1997</p>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                <p class="text-muted">Jl. Buyut Risah RT 19 RW 7, Kasin, Desa Ampeldento, Kec. Karangploso, Kab. Malang</p>
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
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="number" name="nik" class="form-control" value="3206190207970001" disabled="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" value="ibeng@senjani.id" disabled="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="Ibeng Abdul Latif">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="number" name="nik" class="form-control" id="inputNIK" value="08998679773">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="jeniskelamin" checked>
                                            <label for="customRadio1" class="custom-control-label">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="jeniskelamin">
                                            <label for="customRadio2" class="custom-control-label">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">TTL</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama" class="form-control" id="inputNama" value="Tasikmalaya">
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" name="tanggal-lahir" class="form-control" value="1997-01-18">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3">Jl. Buyut Risah RT 19 RW 7, Kasin, Desa Ampeldento, Kec. Karangploso, Kab. Malang</textarea>
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
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Foto baru</label>
                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input">
                                    <label class="custom-file-label">Pilih foto</label>
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
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputName" placeholder="Password lama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputName" placeholder="Password baru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">Ulangi Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputName" placeholder="Ulangi password baru">
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
@endpush