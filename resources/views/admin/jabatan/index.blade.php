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
        <h1>Jabatan Personel</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Jabatan</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Jabatan Personel</h3>
                <div class="card-tools">
                        <a href="#" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Jabatan</th>
                                <th>Keterangan</th>
                                <th>Warna Label</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $j)
                            <tr>
                                <td>{{ $j->jabatan }}</td>
                                <td>{{ $j->keterangan }}</td>
                                <td class="d-flex align-items-center justify-content-center"><div style="width: 50px; height: 10px; background-color: {{ $j->warna }}"></div></td>
                                <td>
                                    <a href="/jabatan/{{ $j->id }}/edit" class="btn btn-xs bg-warning"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-xs bg-danger" data-id="{{ $j->id }}" onclick="hapusJabatan(this)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
                    <h4 class="modal-title">Tambah Data Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url('/jabatan') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 col-form-label">Nama Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" id="jabatan" name="jabatan" class="form-control  @error('jabatan') is-invalid @enderror" placeholder="Nama Jabatan">
                                @error('jabatan') 
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                                @error('keterangan') 
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="warna" class="col-sm-2 col-form-label">Warna Label</label>
                            <div class="col-sm-10">
                                <input type="color" id="warna" name="warna" class="form-control  @error('warna') is-invalid @enderror">
                                @error('warna') 
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger toastrTambahSuccess">Tambahkan</button>
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
<!-- MODAL HAPUS DATA-->
<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus jabatan <b>Chief Executive Officer</b>?</p>
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
     });
</script>

<!-- page script -->
<script>
    const kelolaPersonelMenu = document.getElementById('kelola-personel-menu')
    const jabatanMenu = document.getElementById('jabatan-menu')

    kelolaPersonelMenu.classList.add('menu-open')
    kelolaPersonelMenu.children[0].classList.add('active')
    jabatanMenu.classList.add('active')

	$(function () {
		$('#example1').DataTable({
			"paging": true,
            "lengthChange": true,
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5,
			"searching": false,
			"ordering": false,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
    });
</script>

<script>
    function hapusJabatan(element) {
        const id = element.dataset.id;
        const nama = element.parentElement.previousElementSibling.previousElementSibling.innerText

        $('#modal-hapus').modal('show');
        document.querySelector('#modal-hapus .modal-body').innerHTML = `<p>Yakin akan menghapus jabatan <b>${nama}</b></p>`;

        $('.toastrHapusSuccess').on('click', function () {
            axios.delete('/jabatan/' + id)
                .then(response => {
                    toastr.success(response.data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                })
                .catch(error => {
                    console.log(error);
                })
        })
    }    
</script>

@if($errors->any())
    <script>
        $('#modal-tambah').modal('show');
        toastr.error('Mohon periksa kembali formnya.')
    </script>
@endif
@if (session('status'))
    <script>
        toastr.success(@json(session('status')))
    </script>
@endif
@endpush