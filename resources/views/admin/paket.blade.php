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
        <h1>Paket</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Paket</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <!-- PRODUCT LIST -->
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Data Paket</h3>
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
                                <th>Paket</th>
                                <th>Pengiriman</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="products-list">
                                        <div class="product-img">
                                            <img src="{{ asset('images/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <b>Nasi Putih - 6 Porsi</b>
                                            <span class="product-description">
                                                Reusable Box
                                            </span>
                                        </div>
                                </td>
                                <td>
                                        <span class="badge badge-success">pagi</span>
                                        <span class="badge badge-warning">siang</span>
                                        <span class="badge badge-danger">sore</span>
                                </td>
                                <td align="right">Rp. 120.000</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Paket</th>
                                <th>Pengiriman</th>
                                <th>Harga</th>
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
                    <h4 class="modal-title">Tambah Data Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="paket" class="col-sm-2 col-form-label">Nama Paket</label>
                                <div class="col-sm-10">
                                    <input type="text" name="paket" class="form-control" placeholder="Nama Paket">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="porsi" class="col-sm-2 col-form-label">Jumlah Porsi</label>
                                <div class="col-sm-10">
                                    <input type="number" name="porsi" class="form-control" placeholder="Jumlah porsi dalam paket">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option>Bento Box</option>
                                        <option>Reusable Box</option>
                                        <option>Family Pack</option>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Foto Paket</label>
                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input" name="foto">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="waktu" class="col-sm-2 col-form-label">Bisa dikirim pada waktu</label>
                                <div class="col-sm-10">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="waktu">
                                        <label for="waktu">Pagi</label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="waktu">
                                        <label for="waktu">Siang</label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="waktu">
                                        <label for="waktu">Sore</label>
                                    </div>
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
                    <h4 class="modal-title">Edit Data Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="paket" class="col-sm-2 col-form-label">Nama Paket</label>
                                <div class="col-sm-10">
                                    <input type="text" name="paket" class="form-control" value="Reusable Box - Nasi Putih">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="porsi" class="col-sm-2 col-form-label">Jumlah Porsi</label>
                                <div class="col-sm-10">
                                    <input type="number" name="porsi" class="form-control" value="6">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option>Bento Box</option>
                                        <option>Reusable Box</option>
                                        <option>Family Pack</option>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Foto Paket</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto">
                                        <label class="custom-file-label" for="customFile">Kosongkan jika tidak ingin mengganti foto paket</label>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="waktu" class="col-sm-2 col-form-label">Bisa dikirim pada waktu</label>
                                <div class="col-sm-10">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="waktu" checked="">
                                        <label for="waktu">Pagi</label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="waktu" checked="">
                                        <label for="waktu">Siang</label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="waktu" checked="">
                                        <label for="waktu">Sore</label>
                                    </div>
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
                    <h4 class="modal-title">Hapus Data Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus paket <b>Reusable Box - Nasi Putih - 6 Porsi</b>?</p>
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
<script src="js/demo.js"></script>
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