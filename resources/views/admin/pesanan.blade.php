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
        <h1>Pesanan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title" style="padding-right: 10px">Data Pesanan</h3>
                    <button type="button" class="btn btn-info btn-sm daterange" data-toggle="tooltip" title="Date range">
                        <i class="far fa-calendar-alt"></i> Pilih Tanggal
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                            <i class="fas fa-comment"></i> WhatsApps
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Pagi</a>
                            <a href="#" class="dropdown-item">Siang</a>
                            <a href="#" class="dropdown-item">Sore</a>
                        </div>
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
            </div>
            <!-- /.card-body -->
            <div class="card-body p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#pagi" data-toggle="tab"><i class="fas fa-cloud-sun"></i> Pagi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#siang" data-toggle="tab"><i class="fas fa-sun"></i> Siang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#sore" data-toggle="tab"><i class="fas fa-cloud-moon"></i> Sore</a></li>
                    </ul>
                    <hr>
                    <div class="tab-content">
                        <div class="active tab-pane" id="pagi">
                            <!-- /.nav-tabs-custom -->
                            <div class="card-body">
                                <table id="tabelPagi" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pelanggan</th>
                                                <th>Paket</th>s
                                                <th>Porsi</th>
                                                <th>Alergi/Keterangan</th>
                                                <th>Catatan</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="https://wa.me/628971175261" target="_blank">Olly Rizqi Hanifah</a>
                                                </td>
                                                <td>
                                                    Reusable Box - Nasi Putih
                                                </td>
                                                <td align="right">3</td>
                                                <td>
                                                    Tanpa sayur yang pahit
                                                </td>
                                                <td>
                                                    Didonasikan buat pengemis di jalan yaa...
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Pelanggan</th>
                                                <th>Paket</th>
                                                <th>Porsi</th>
                                                <th>Alergi/Keterangan</th>
                                                <th>Catatan</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="siang">
                            <h3>Siang</h3>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="sore">
                            <h3>Sore</h3>
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

<!-- /.content -->
<!-- MODAL EDIT DATA-->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Pesanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal"><div class="form-group row">
                        <label for="pelanggan" class="col-sm-2 col-form-label">Pelanggan</label>
                        <div class="col-sm-10">
                                <input type="text" name="pelanggan" class="form-control" value="Olly Rizqi Hanifah" disabled="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paket" class="col-sm-2 col-form-label">Jumlah Porsi</label>
                        <div class="col-sm-10">
                                <input type="number" name="porsi" class="form-control" value="3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="alamat-teks">Tanpa sayur yang pahit</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                                <button type="button" class="btn btn-danger toastrTambahSuccess">Tambahkan</button>
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
                <h4 class="modal-title">Hapus Data Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin akan menghapus pesanan atas nama <b>Olly Rizqi Hanifah</b>?</p>
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
<script src="{{ asset('front-end-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('front-end-admin/js/demo.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('front-end-admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('front-end-admin/plugins/toastr/toastr.min.js') }}"></script>

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
        $("#tabelPagi").DataTable({
            "responsive": true,
            "autoWidth": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });
</script>
@endpush