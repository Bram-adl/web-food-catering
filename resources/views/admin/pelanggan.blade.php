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
        <h1>Pelanggan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Pelanggan</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">Data Pelanggan</h3>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Rumah</th>
                                <th>Kantor</th>
                                <th>Porsi</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Olly Rizqi Hanifah</td>
                                <td>
                                        <a href="mailto:orizqihanifah@gmail.com">orizqihanifah@gmail.com</a>
                                        <br>
                                        <a href="https://wa.me/628971175261" target="_link">08971175261</a>
                                </td>
                                <td>
                                        <a href="https://g.page/senjanikitchen?share" target="_link">
                                            Jl. Batok No. 18, Klojen Kota Malang
                                        </a>
                                </td>
                                <td>
                                        <a href="https://g.page/senjanikitchen?share" target="_link">
                                            Jl. Batok No. 18, Klojen Kota Malang
                                        </a>
                                </td>
                                <td align="right">
                                        <span class="badge badge-danger">3</span>
                                </td>
                                <td>Saya bisa makan sayur apa aja kecuali yang pahit seperti pare</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tasya Aryanti</td>
                                <td>
                                        <a href="mailto:tasyaaryanti@gmail.com">tasyaaryanti@gmail.com</a>
                                        <br>
                                        <a href="https://wa.me/6282234898017" target="_link">082234898017</a>
                                </td>
                                <td>
                                        <a href="https://g.page/senjanikitchen" target="_link">
                                            Jl. batujajar gg.1 no.28, penanggungan, klojen. depannya pom bensin jl.bandung, blakangnya les"an ruang guru
                                        </a>
                                </td>
                                <td>
                                        <a href="https://g.page/senjanikitchen" target="_link">
                                            Jl. batujajar gg.1 no.28, penanggungan, klojen. depannya pom bensin jl.bandung, blakangnya les"an ruang guru
                                        </a>
                                </td>
                                <td align="right">
                                        <span class="badge badge-warning">6</span>
                                </td>
                                <td>kl ayam goreng, tidak mau bagian dada</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Riza Setiawan</td>
                                <td>
                                        <a href="mailto:rizasetiawan@gmail.com">rizasetiawan@gmail.com</a>
                                        <br>
                                        <a href="https://wa.me/6281211007651" target="_link">081211007651</a>
                                </td>
                                <td>
                                        <a href="https://g.page/senjanikitchen" target="_link">
                                            jalan bendungan nawangan no.10
                                        </a>
                                </td>
                                <td>
                                        <a href="https://g.page/senjanikitchen" target="_link">
                                            jalan bendungan nawangan no.10
                                        </a>
                                </td>
                                <td align="right">
                                        <span class="badge badge-success">7</span>
                                </td>
                                <td>Makan saya banyak</td>
                                <td>
                                        <a href="#" class="btn btn-xs bg-warning" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs bg-danger" data-toggle="modal" data-target="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Porsi</th>
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
                    <h4 class="modal-title">Tambah Data Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="hp" class="col-sm-2 col-form-label">No WhatsApp</label>
                                <div class="col-sm-10">
                                    <input type="number" name="hp" class="form-control" placeholder="No HP">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Alamat Rumah</label>
                                <div class="col-sm-10">
                                    <p>Kota, Kecamatan, Kelurahan/Desa</p>
                                    <textarea class="form-control" rows="3" placeholder="Alamat Lengkap"></textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Link GMaps Rumah</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="link GMaps"></textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Alamat Kantor</label>
                                <div class="col-sm-10">
                                    <p>Kota, Kecamatan, Kelurahan/Desa</p>
                                    <textarea class="form-control" rows="3" placeholder="Alamat Lengkap"></textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Link GMaps Kantor</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="link GMaps"></textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Alergi & Keterangan Lain</label>
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
                    <h4 class="modal-title">Edit Data Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="Olly Rizqi Hanifah">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" value="orizqihanifah@gmail.com">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" placeholder="Hanya diisi jika ingin mengganti password">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="hp" class="col-sm-2 col-form-label">No WhatsApp</label>
                                <div class="col-sm-10">
                                    <input type="number" name="hp" class="form-control" value="08971175261">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Alamat Rumah</label>
                                <div class="col-sm-10">
                                    <p>Kota, Kecamatan, Kelurahan/Desa</p>
                                    <textarea class="form-control" rows="3" placeholder="Alamat Lengkap">Jl. Batok No. 18, Klojen Kota Malang</textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Link GMaps Rumah</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Alamat Lengkap">https://g.page/senjanikitchen</textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Alamat Kantor</label>
                                <div class="col-sm-10">
                                    <p>Kota, Kecamatan, Kelurahan/Desa</p>
                                    <textarea class="form-control" rows="3" placeholder="Alamat Lengkap">Jl. Batok No. 18, Klojen Kota Malang</textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Link GMaps Kantor</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Alamat Lengkap">https://g.page/senjanikitchen</textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Alergi & Keterangan Lain</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="Keterangan">Saya bisa makan sayur apa aja kecuali yang pahit seperti pare</textarea>
                                </div>
                        </div>
                        <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="button" class="btn btn-danger toastrTambahSuccess">Update</button>
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
                    <h4 class="modal-title">Hapus Data Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus pelanggan <b>Olly Rizqi Hanifah</b>?</p>
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