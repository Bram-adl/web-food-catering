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
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
                    <a href="#" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah">
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
                        @foreach ($pelanggan as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>
                                <a href="mailto:{{ $p->email }}">{{ $p->email }}</a>
                                <br>
                                <a href="{{ $p->wa ? 'https://wa.me/+62' . substr($p->wa, 1) : '#' }}" target="_link">081211007651</a>
                            </td>
                            <td>
                                @if ($p->rumah_teks)
                                    @if ($p->rumah_maps)
                                        <a href="{{ $p->rumah_maps ? $p->rumah_maps : '#' }}" target="_link">
                                            {{ $p->rumah_teks }}
                                        </a>
                                    @else
                                        {{ $p->rumah_teks }}
                                    @endif
                                @else
                                    <span class="text-muted">Belum menyimpan data</span>
                                @endif
                            </td>
                            <td>
                                @if ($p->kantor_teks)
                                    @if ($p->kantor_maps)
                                        <a href="{{ $p->kantor_maps ? $p->kantor_maps : '#' }}" target="_link">
                                            {{ $p->kantor_teks }}
                                        </a>
                                    @else
                                        {{ $p->kantor_teks }}
                                    @endif
                                @else
                                    <span class="text-muted">Belum menyimpan data</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-success">{{ $p->porsi ? $p->porsi : 0 }}</span>
                            </td>
                            <td>{{ $p->keterangan ? $p->keterangan : '-' }}</td>
                            <td>
                                    <a href="/pelanggan/{{ $p->id }}/edit" class="btn btn-xs bg-warning"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-xs bg-danger" data-id="{{ $p->id }}" onclick="hapusPelanggan(this)"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Tambah Data Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url('/pelanggan') }}" method="POST">
                    @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap">
                                @error('nama')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wa" class="col-sm-2 col-form-label">No WhatsApp</label>
                            <div class="col-sm-10">
                                <input type="number" name="wa" value="{{ old('wa') }}" class="form-control @error('wa') is-invalid @enderror" placeholder="No WA">
                                @error('wa')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rumah_teks" class="col-sm-2 col-form-label">Alamat Rumah</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('rumah_teks') is-invalid @enderror" name="rumah_teks" value="{{ old('rumah_teks') }}" rows="3" placeholder="Alamat Lengkap"></textarea>
                                @error('rumah_teks')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Daerah Rumah</label>
                            <div class="col-sm-3">
                                <select class="custom-select @error('rumah_kota') is-invalid @enderror" name="rumah_kota">
                                    <option selected hidden value="">-- Pilih Kota --</option>
                                    @foreach ($kota as $k)
                                    <option value="{{ $k->id }}">{{ $k->kota }}</option>
                                    @endforeach
                                </select>
                                @error('rumah_kota')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <select class="custom-select @error('rumah_kecamatan') is-invalid @enderror" name="rumah_kecamatan">
                                    <option selected hidden value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatan as $k)
                                    <option value="{{ $k->id }}">{{ $k->kecamatan }}</option>
                                    @endforeach
                                </select>
                                @error('rumah_kecamatan')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <select class="custom-select @error('rumah_kelurahan') is-invalid @enderror" name="rumah_kelurahan">
                                    <option selected hidden value="">-- Pilih Kelurahan --</option>
                                    @foreach ($kelurahan as $k)
                                    <option value="{{ $k->id }}">{{ $k->kelurahan }}</option>
                                    @endforeach
                                </select>
                                @error('rumah_kelurahan')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rumah_maps" class="col-sm-2 col-form-label">Link GMaps Rumah</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('rumah_maps') is-invalid @enderror" name="rumah_maps" value="{{ old('rumah_maps') }}" placeholder="link GMaps">
                                @error('rumah_maps')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kantor_teks" class="col-sm-2 col-form-label">Alamat Kantor</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('kantor_teks') is-invalid @enderror" rows="3" name="kantor_teks" value="{{ old('kantor_teks') }}" placeholder="Alamat Lengkap"></textarea>
                                @error('kantor_teks')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Daerah Kantor</label>
                            <div class="col-sm-3">
                                <select class="custom-select @error('kantor_kota') is-invalid @enderror" name="kantor_kota">
                                    <option selected hidden value="">-- Pilih Kota --</option>
                                    @foreach ($kota as $k)
                                    <option value="{{ $k->id }}">{{ $k->kota }}</option>
                                    @endforeach
                                </select>
                                @error('kantor_kota')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <select class="custom-select @error('kantor_kecamatan') is-invalid @enderror" name="kantor_kecamatan">
                                    <option selected hidden value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatan as $k)
                                    <option value="{{ $k->id }}">{{ $k->kecamatan }}</option>
                                    @endforeach
                                </select>
                                @error('kantor_kecamatan')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <select class="custom-select @error('kantor_kelurahan') is-invalid @enderror" name="kantor_kelurahan">
                                    <option selected hidden value="">-- Pilih Kelurahan --</option>
                                    @foreach ($kelurahan as $k)
                                    <option value="{{ $k->id }}">{{ $k->kelurahan }}</option>
                                    @endforeach
                                </select>
                                @error('kantor_kelurahan')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kantor_maps" class="col-sm-2 col-form-label">Link GMaps Kantor</label>
                            <div class="col-sm-10">
                                <input class="form-control @error('kantor_maps') is-invalid @enderror" name="kantor_maps" value="{{ old('kantor_maps') }}" placeholder="link GMaps"></input>
                                @error('kantor_maps')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Alergi & Keterangan Lain</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan') }}" rows="3" placeholder="Keterangan"></textarea>
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

    const pelangganMenu = document.getElementById('pelanggan-menu');
    pelangganMenu.classList.add('active');
</script>

<!-- page script -->
<script>
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

    function hapusPelanggan(element) {
        const id = element.dataset.id;
        const name = element.parentElement.parentElement.children[0].innerText

        $('#modal-hapus').modal('show');
        document.querySelector('#modal-hapus .modal-body').innerHTML = `
            <p>Yakin akan menghapus pelanggan <b>${name}</b>?</p>
        `;
        $('.toastrHapusSuccess').on('click', function () {
            axios.delete('/pelanggan/' + id)
                .then(({data}) => {
                    toastr.success(data.message)
                    setTimeout(() => {
                        location.reload()
                    }, 1000);
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
        toastr.error('Mohon periksa kembali formnya!');
    </script>
@endif

@if(session('status'))
    <script>
        toastr.success(@json(session('status')));
    </script>
@endif
@endpush