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
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
                            <th>Paket</th>
                            <th>Pengiriman</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paket as $p)
                        <tr>
                            <td class="products-list">
                                <div class="product-img">
                                    <img src="{{ asset('images/foods/' . $p->foto) }}" style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                                <div class="product-info">
                                    <b>{{ $p->paket }}</b>
                                    <span class="product-description">
                                        {{ $p->kategori->kategori}}
                                    </span>
                                </div>
                            </td>
                            <td>
                                @if ($p->pagi)
                                <span class="badge badge-success">pagi</span>
                                @endif
                                @if ($p->siang)
                                <span class="badge badge-warning">siang</span>
                                @endif
                                @if ($p->sore)
                                <span class="badge badge-danger">sore</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="/paket/{{ $p->id }}/edit" class="btn btn-xs bg-warning"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-xs bg-danger" data-id="{{ $p->id }}" onclick="hapusPaket(this)"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Tambah Data Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url('/paket') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="paket" class="col-sm-2 col-form-label">Nama Paket</label>
                            <div class="col-sm-10">
                                <input type="text" id="paket" name="paket" value="{{ old('paket') }}" class="form-control @error('paket') is-invalid @enderror" placeholder="Nama Paket">
                                @error('paket')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="porsi" class="col-sm-2 col-form-label">Jumlah Porsi</label>
                            <div class="col-sm-10">
                                <input type="number" id="porsi" name="porsi" value="{{ old('porsi') }}" class="form-control @error('porsi') is-invalid @enderror" placeholder="Jumlah porsi dalam paket">
                                @error('porsi')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="custom-select @error('id_kategori') is-invalid @enderror" name="id_kategori">
                                    <option value="" selected disabled hidden>-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga Paket</label>
                            <div class="col-sm-10">
                                <input type="number" id="harga" name="harga" value="{{ old('harga') }}" class="form-control @error('harga') is-invalid @enderror" placeholder="Harga Paket">
                                @error('harga')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto Paket</label>
                            <div class="col-sm-10">
                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" name="foto">
                                <label class="custom-file-label" for="foto">Choose file</label>
                                @error('foto')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="waktu" class="col-sm-2 col-form-label">Bisa dikirim pada waktu</label>
                            <div class="col-sm-10">
                                <div class="icheck-primary">
                                    <input type="hidden" name="pagi" value="0">
                                    <input type="checkbox" id="pagi" value="1" name="pagi">
                                    <label for="pagi">Pagi</label>
                                </div>
                                <div class="icheck-primary">
                                    <input type="hidden" name="siang" value="0">
                                    <input type="checkbox" id="siang" value="1" name="siang">
                                    <label for="siang">Siang</label>
                                </div>
                                <div class="icheck-primary">
                                    <input type="hidden" name="sore" value="0">
                                    <input type="checkbox" id="sore" value="1" name="sore">
                                    <label for="sore">Sore</label>
                                </div>
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

    const kelolaPaketMenu = document.getElementById('kelola-paket-menu')
    const paketMenu = document.getElementById('paket-menu')

    kelolaPaketMenu.classList.add('menu-open')
    kelolaPaketMenu.children[0].classList.add('active')
    paketMenu.classList.add('active')

    function hapusPaket(element) {
        const id = element.dataset.id
        const name = element.parentElement.previousElementSibling
                    .previousElementSibling.previousElementSibling
                    .children[1].children[0].textContent

        $('#modal-hapus').modal('show')
        document.querySelector('#modal-hapus .modal-body').innerHTML = `
            <p>Yakin akan menghapus paket <b>${name}</b>?</p>
        `
        $('.toastrHapusSuccess').on('click', function () {
            axios.delete('/paket/' + id)
                .then(response => {
                    toastr.success(response.data.message)
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
        toastr.error('Mohon perika kembali formnya!');
    </script>
@endif
@if(session('status'))
    <script>
        toastr.success(@json(session('status')));
    </script>
@endif
@endpush