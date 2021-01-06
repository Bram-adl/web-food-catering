@extends('admin.layouts.app')

@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Personel</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Personel</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Personel</h5>
                <div class="card-tools">
                    <a href="#" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                Chief Executive Officer
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>Abdul Latif</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span>
                                                3206190207970001
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-male"><!-- <i class="fas fa-lg fa-female"></i>--></i></span>
                                                Laki-laki
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>
                                                <a href="mailto:ibeng@senjani.id">ibeng@senjani.id</a>
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                Tasikmalaya, 18 Januari 1997
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="img/personel/ibeng-160.jpg" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="https://wa.me/628998679773" target="_blank" class="btn btn-sm bg-success">
                                        WhatsApp
                                    </a>
                                    <a href="#" class="btn btn-sm bg-warning" data-toggle="modal" data-target="#modal-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#modal-hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                Chief Operating  Officer
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>Amira Ulvi Annisa</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span>
                                                6472036410960002
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><!-- <i class="fas fa-lg fa-male"> --><i class="fas fa-lg fa-female"></i></i></span>
                                                Perempuan
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>
                                                <a href="mailto:amira@senjani.id">amira@senjani.id</a>
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                Bayuwangi, 24 Oktober 1996
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="img/personel/amira-160.jpg" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="https://wa.me/628998679773" target="_blank" class="btn btn-sm bg-success">
                                        WhatsApp
                                    </a>
                                    <a href="#" class="btn btn-sm bg-warning" data-toggle="modal" data-target="#modal-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#modal-hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                Executive Chef
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>Aliyah</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span>
                                                3510164805480001
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><!-- <i class="fas fa-lg fa-male"> --><i class="fas fa-lg fa-female"></i></i></span>
                                                Perempuan
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>
                                                <a href="mailto:aliyah@senjani.id">aliyah@senjani.id</a>
                                            </li>
                                            <li class="small">
                                                <span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                Banyuwangi, 8 Mei 1948
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="img/personel/mutia-160.jpg" alt="" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="https://wa.me/628998679773" target="_blank" class="btn btn-sm bg-success">
                                        WhatsApp
                                    </a>
                                    <a href="#" class="btn btn-sm bg-warning" data-toggle="modal" data-target="#modal-edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#modal-hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="Personel Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Prev</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- ./card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <!-- MAP & BOX PANE -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Jenis Kelamin Personel</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="height: 200px">
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Jabatan Personel</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="height: 200px">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Personel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="number" name="nik" class="form-control" placeholder="NIK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" placeholder="Berakhiran @senjani.id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="number" name="hp" class="form-control" id="inputNIK" placeholder="No HP">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <!-- radio -->
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="jeniskelamin">
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
                        <label class="col-sm-2 col-form-label">TTL</label>
                        <div class="col-sm-6">
                            <input type="text" name="tempat-lahir" class="form-control" placeholder="Tempat Lahir">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" name="tanggal-lahir" class="form-control" value="1995-01-01">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select class="custom-select">
                                <option>-</option>
                                <option>Chief Executive Officer</option>
                                <option>Cook Helper</option>
                                <option>Food Courier</option>
                                <option>Executive Chef</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="custom-file-input" name="foto">
                            <label class="custom-file-label" for="foto">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat-teks" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Alamat Lengkap" name="alamat-teks"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="button" name="submit" class="btn btn-danger toastrTambahSuccess">Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal tambah data -->
<!-- MODAL EDIT DATA-->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Personel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <label for="inputExperience" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select class="custom-select">
                                <option>Chief Executive Officer</option>
                                <option>-</option>
                                <option>Cook Helper</option>
                                <option>Food Courier</option>
                                <option>Executive Chef</option>
                            </select>
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
                        <label for="inputSkills" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3">Jl. Buyut Risah RT 19 RW 7, Kasin, Desa Ampeldento, Kec. Karangploso, Kab. Malang</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="button" class="btn btn-danger toastrEditSuccess">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal edit data-->
<!-- MODAL HAPUS DATA-->
<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data Personel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin akan menghapus personel <b>Ibeng Abdul Latif</b>?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger toastrHapusSuccess">Hapus</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal hapus data-->
@endsection

@push('scripts')
<script src="{{ asset('front-end-master/js/demo.js') }}"></script>
<script src="{{ asset('front-end-master/js/pages/dashboard3.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('front-end-master/js/pages/dashboard2.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $('.toastrTambahSuccess').click(function() {
            toastr.success('Data berhasil ditambahkan')
        });
        $('.toastrEditSuccess').click(function() {
            toastr.success('Data berhasil diperbaharui')
        });
        $('.toastrHapusSuccess').click(function() {
            toastr.success('Data berhasil dihapus')
        });
    });
</script>
@endpush