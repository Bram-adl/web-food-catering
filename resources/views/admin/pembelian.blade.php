@extends('admin.layouts.app')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Pembelian</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Pembelian</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Data Pembelian</h3>
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
            <div class="card-body p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#semua" data-toggle="tab"><i class="fas fa-shopping-bag"></i> Semua</a></li>
                        <li class="nav-item"><a class="nav-link" href="#verifikasi" data-toggle="tab"><i class="fas fa-search-dollar"></i> Verifikasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#belum" data-toggle="tab"><i class="fas fa-hand-holding-usd"></i> Belum Bayar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#sudah" data-toggle="tab"><i class="fa fa-money-bill"></i> Aktif</a></li>
                        <li class="nav-item"><a class="nav-link" href="#selesai" data-toggle="tab"><i class="fas fa-check-double"></i> Selesai</a></li>
                    </ul>
                    <hr>
                    <div class="tab-content">
                        <div class="active tab-pane" id="semua">
                            <!-- /.nav-tabs-custom -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pelangan</th>
                                                <th>Paket</th>
                                                <th>Bukti Bayar</th>
                                                <th>Status</th>
                                                <th>Waktu</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="https://wa.me/628971175261" target="_link">Olly Rizqi Hanifah</a>
                                                </td>
                                                <td>
                                                    Reusable Box - Nasi Putih - 6 Porsi<br>
                                                    <b>Rp. 840.012</b>
                                                </td>
                                                <td>
                                                    <a href="img/pembelian/default-150x150.png" target="_blank"><img src="img/pembelian/default-150x150.png"></a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Aktif</span>
                                                    <br>
                                                    <span class="badge badge-warning">Proses verifikasi</span>
                                                    <br>
                                                    <span class="badge badge-info">Belum bayar</span>
                                                    <br>
                                                    <span class="badge badge-danger">Selesai</span>
                                                </td>
                                                <td>2020-11-23 08:15:30</td>
                                                <td>
                                                    <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Pelangan</th>
                                                <th>Paket</th>
                                                <th>Bukti Bayar</th>
                                                <th>Status</th>
                                                <th>Waktu</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="verifikasi">
                            <h3>Verifikasi</h3>
                        </div>
                        <div class="tab-pane" id="belum">
                            <h3>Belum</h3>
                        </div>
                        <div class="tab-pane" id="sudah">
                            <h3>Sudah</h3>
                        </div>
                        <div class="tab-pane" id="selesai">
                            <h3>Selesai</h3>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-4">
        <!-- MAP & BOX PANE -->
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Grafik Pembelian Pelanggan</h3>
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
    <div class="col-lg-4">
        <!-- MAP & BOX PANE -->
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Grafik Pembelian Paket</h3>
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
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Grafik Status Pembelian</h3>
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

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="pelanggan" class="col-sm-2 col-form-label">Pelanggan</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="pelanggan">
                                        <option>Olly Rizqi Hanifah</option>
                                        <option>Tasya Aryanti</option>
                                        <option>Riza Setiawan</option>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="paket" class="col-sm-2 col-form-label">Paket</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option>Daily Catering | Reusable Box - Nasi Putih - 6 Porsi</option>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Bukti Bayar</label>
                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input" name="foto">
                                    <label class="custom-file-label" for="foto">Kosongkan jika tidak ingin mengganti bukti bayar</label>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option>Belum bayar</option>
                                        <option>Proses verifikasi</option>
                                        <option>Aktif</option>
                                        <option>Selesai</option>
                                    </select>
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
<!-- MODAL EDIT DATA-->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="pelanggan" class="col-sm-2 col-form-label">Pelanggan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="Olly Rizqi Hanifah" disabled="">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="paket" class="col-sm-2 col-form-label">Paket</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option>Daily Catering | Reusable Box - Nasi Putih - 6 Porsi</option>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Bukti Bayar</label>
                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input" name="foto">
                                    <label class="custom-file-label" for="foto">Kosongkan jika tidak ingin mengganti bukti bayar</label>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option>Belum bayar</option>
                                        <option>Proses verifikasi</option>
                                        <option>Aktif</option>
                                        <option>Selesai</option>
                                    </select>
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
                    <h4 class="modal-title">Hapus Data Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus pembelian?</p>
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
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>

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

<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
    });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
    });
});
</script>     
@endpush