@extends('admin.layouts.app')

@push('styles')
<style>
    nav ul.pagination {
        margin-bottom: 0 !important;
        display: flex;
        justify-content: center;
    }
</style>
@endpush

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Personel</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
                <h5 class="card-title mt-2">Data Personel</h5>
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
                <div class="row">
                    @foreach ($personel as $p)
                    <div class="col-12 col-sm-6 col-md-4 text-center text-md-left">
                        <div class="card bg-light">
                            <div class="card-header border-bottom-0 py-2 px-3">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <img src="{{ asset('images/personel/' . $p->foto) }}" style="width: 100px; height: 100px; object-fit: cover;" class="img-circle img-fluid">
                                    </div>
                                    <div class="col-md-7">
                                        <span class="text-muted">{{ $p->jabatan->jabatan }}</span>
                                        <h1 class="lead"><b>{{ $p->nama }}</b></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-2 pb-2 text-left">
                                <ul class="mb-0 fa-ul text-muted">
                                    <li class="mb-2">
                                        <span class="fa-li">
                                            <i class="fas fa-lg fa-id-card"></i>
                                        </span>
                                        <span class="ml-4">{{ $p->nik }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fa-li">
                                            @if ($p->jenis_kelamin == 'Laki-laki')
                                            <i class="fas fa-lg fa-male"></i>
                                            @else
                                            <i class="fas fa-lg fa-female"></i>
                                            @endif
                                        </span>
                                        <span class="ml-4">{{ $p->jenis_kelamin }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fa-li">
                                            <i class="fas fa-lg fa-envelope"></i>
                                        </span>
                                        <span class="ml-4"n><a href="mailto:{{ $p->email }}">{{ $p->email }}</a></span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fa-li">
                                            <i class="fas fa-lg fa-calendar"></i>
                                        </span>
                                        <span class="ml-4">{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="https://wa.me/62{{ substr($p->wa, 1) }}" target="_blank" class="btn bg-success">
                                        WhatsApp
                                    </a>
                                    <a href="{{ url('/personel/' . $p->id . '/edit') }}" class="btn bg-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="/personel/{{ $p->id }}" class="btn bg-danger" data-toggle="modal" data-target="#modal-hapus" onclick="event.preventDefault(); hapusPersonel(this)">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <nav aria-label="Personel Page Navigation">
                        {{ $personel->links() }}
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
                <form class="form-horizontal" action="{{ action('Admin\PersonelController@store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="number" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="NIK">
                            @error('nik')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap">
                            @error('nama')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Berakhiran @senjani.id">
                            @error('email')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" placeholder="****">
                            @error('password')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wa" class="col-sm-2 col-form-label">No WA</label>
                        <div class="col-sm-10">
                            <input type="number" name="wa" class="form-control @error('wa') is-invalid @enderror" id="wa" value="{{ old('wa') }}" placeholder="No WA">
                            @error('wa')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <!-- radio -->
                            <div class="form-group mb-0">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="laki" name="jenis_kelamin" value="Laki-laki">
                                    <label for="laki" class="custom-control-label">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                                    <label for="perempuan" class="custom-control-label">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TTL</label>
                        <div class="col-sm-6">
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir">
                            @error('tempat_lahir')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select class="custom-select @error('id_jabatan') is-invalid @enderror" name="id_jabatan">
                                <option selected hidden disabled value="">-- Pilih Jabatan --</option>
                                @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->jabatan }}</option>
                                @endforeach
                            </select>
                            @error('id_jabatan')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto">
                            <label class="custom-file-label" for="foto">Choose file</label>
                            @error('foto')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Alamat Lengkap" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Daerah</label>
                        <div class="col-sm-3">
                            <select class="custom-select @error('id_kota') is-invalid @enderror" name="id_kota">
                                <option selected hidden disabled value="">-- Pilih Kota --</option>
                                @foreach ($kota as $k)
                                <option value="{{ $k->id }}">{{ $k->kota }}</option>
                                @endforeach
                            </select>
                            @error('id_kota')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <select class="custom-select @error('id_kecamatan') is-invalid @enderror" name="id_kecamatan">
                                <option selected hidden disabled value="">-- Pilih Kecamatan --</option>
                                @foreach ($kecamatan as $k)
                                <option value="{{ $k->id }}">{{ $k->kecamatan }}</option>
                                @endforeach
                            </select>
                            @error('id_kecamatan')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <select class="custom-select @error('id_kelurahan') is-invalid @enderror" name="id_kelurahan">
                                <option selected hidden disabled value="">-- Pilih Kelurahan --</option>
                                @foreach ($kelurahan as $k)
                                <option value="{{ $k->id }}">{{ $k->kelurahan }}</option>
                                @endforeach
                            </select>
                            @error('id_kelurahan')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-danger toastrTambahSuccess">Tambahkan</button>
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
@endsection

@push('scripts')
<script src="{{ asset('front-end-admin/js/demo.js') }}"></script>
<script src="{{ asset('front-end-admin/js/pages/dashboard3.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('front-end-admin/plugins/chart.js/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('front-end-admin/js/pages/dashboard2.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    function hapusPersonel(element) {
        const id = element.href.split('/')[element.href.split('/').length - 1]
        const name = element.parentElement.parentElement
            .previousElementSibling.previousElementSibling
            .children[0].children[1].children[1].innerText;

        Swal.fire({
            title: `Apakah kamu yakin ingin menghapus ${name}?`,
            text: "Personel tidak dapat kembali lagi jika kamu hapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus personel!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if(result.isConfirmed) {
                axios.delete('/personel/' + id)
                    .then(response => {
                        Swal.fire(
                            'Berhasil!',
                            'Personel telah dihapus.',
                            'success'
                        )
                        setTimeout(() => {
                            location.reload()
                        }, 1000)
                    })
            }
        })
    }
</script>

@if ($errors->any())
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
        })

        Toast.fire({
            icon: 'error',
            title: 'Mohon periksa kembali form nya.'
        })
    </script>
@endif

@if (session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
        })

        Toast.fire({
            icon: 'success',
            title: @json(session('status'))
        })
    </script>
@endif
@endpush