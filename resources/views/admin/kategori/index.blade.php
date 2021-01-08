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
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/paket">Paket</a></li>
            <li class="breadcrumb-item active">Kategori Paket</li>
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
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $k)
                        <tr>
                            <td>{{ $k->kategori }}</td>
                            <td>{{ $k->keterangan }}</td>
                            <td>
                                    <a href="{{ url('/kategori/' . $k->id . '/edit') }}" class="btn btn-xs bg-warning"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-xs bg-danger" data-id="{{ $k->id }}" onclick="hapusKategori(this)"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Tambah Data Kategori Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url('/kategori') }}" method="POST">
                    @csrf
                        <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" placeholder="Nama Kategori">
                                    @error('kategori')                                    
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" name="keterangan" placeholder="Keterangan"></textarea>
                                    @error('keterangan')
                                        <span class="text-danger text-sm">{{ $message }}</span>
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
    <div class="modal-dialog">
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

    const kelolaPaketMenu = document.getElementById('kelola-paket-menu')
    const kategoriMenu = document.getElementById('kategori-menu')

    kelolaPaketMenu.classList.add('menu-open')
    kelolaPaketMenu.children[0].classList.add('active')
    kategoriMenu.classList.add('active')
</script>

<!-- page script -->
<script>
$(function () {
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

function hapusKategori(element) {
    const id = element.dataset.id;
    const name = element.parentElement.previousElementSibling.previousElementSibling.textContent;

    $('#modal-hapus').modal('show');
    document.querySelector('#modal-hapus .modal-body').innerHTML = `
        <p>Yakin akan menghapus kategori paket <b>${name}</b>?</p>
    `;
    $('.toastrHapusSuccess').on('click', function () {
        axios.delete('/kategori/' + id)
            .then(({data}) => {
                toastr.success(data.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            })
            .catch(error => {
                console.log(error);
            })
    });
}
</script>

@if($errors->any())
    <script>
        $('#modal-tambah').modal('show');
        toastr.error('Mohon periksa kembali formnya!');
    </script>
@endif
@if(session('status'))
    <script>
        toastr.success(@json(session('status')));
    </script>
@endif
@endpush