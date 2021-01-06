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
        <h1>Kategori Paket</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item"><a href="personel.html">Paket</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Data Kategori Paket</h3>
                    <div class="card-tools">
                        <a href="#" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bento Box</td>
                                <td>Katering harian dengan kemasan sekali pakai, sehingga lebih higienis.</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Reusable Box</td>
                                <td>Katering harian dengan kemasan yang bisa digunakan ulang dan harus dikembalikan sekaligus pengantaran. Sehingga tidak ada sampah kemasan sama sekali</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Family Pack</td>
                                <td>Katering harian yang cocok untuk keluarga, karena tidak hanya satu porsi saja, melainkan bisa memilih antara 2-4 porsi</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                    </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Kategori Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kategori" class="form-control" placeholder="Nama Jabatan">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Keterangan"></textarea>
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
<!-- /.modal tambah data -->
<!-- MODAL EDIT DATA-->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Kategori Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jabatan" class="form-control" value="Daily Catering">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3">Katering harian yang biasa dikirim setiap hari baik pagi, siang dan atau sore dengan menu yang sudah terjadwal</textarea>
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
                    <h4 class="modal-title">Hapus Data Kategori Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus kategori paket <b>Daily Catering</b>?</p>
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