@extends('admin.layouts.app')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Datepicker -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/datepicker/datepicker.min.css') }}">
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
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <h3 class="card-title">Data Pesanan | <span class="badge badge-info">{{ $tanggal }}</span></h3>

                <div class="">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                            <i class="fas fa-comment mr-1"></i>
                            <span>WhatsApps</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Pagi</a>
                            <a href="#" class="dropdown-item">Siang</a>
                            <a href="#" class="dropdown-item">Sore</a>
                        </div>
                    </div>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-body p-0">
                <div class="m-4 d-md-flex align-items-center justify-content-between">
                    <ul class="nav nav-pills" style="flex: 1 !important;">
                        <li class="nav-item"><a class="nav-link" href="#pagi" data-toggle="tab"><i class="fas fa-cloud-sun"></i>Pagi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#siang" data-toggle="tab"><i class="fas fa-sun"></i>Siang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#sore" data-toggle="tab"><i class="fas fa-cloud-moon"></i>Sore</a></li>
                    </ul>

                    <form action="{{ url('pesanan/cari') }}" method="get">
                        <div class="input-group" style="max-width: 300px !important;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-calendar-alt"></i> 
                                </span>
                            </div>
                            <input data-toggle="datepicker" class="form-control" placeholder="Pilih tanggal" type="text" name="tanggal" autocomplete="off">
                        </div>
                    </form>
                </div>

                <hr class="my-0">
                
                <div class="tab-content">
                    <div class="tab-pane" id="pagi">
                        <!-- /.nav-tabs-custom -->
                        <div class="row p-4">
                            <div class="col-12">
                                <table id="tabelPagi" class="table table-bordered table-striped">
                                <thead>
                                        <tr>
                                            <th>Pelanggan</th>
                                            <th>Paket</th>
                                            <th>Porsi Pengiriman</th>
                                            <th>Alergi/Keterangan</th>
                                            <th>Catatan Pelanggan</th>
                                            <th>Sisa Porsi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan as $p)
                                            @if ($p->waktu_kirim == 'pagi')
                                                <tr>
                                                    <td>
                                                        <a href="https://wa.me/+62{{ substr($p->wa, 1) }}" target="_blank">{{ $p->nama }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $p->paket }}
                                                    </td>
                                                    <td align="right">
                                                        {{ $p->porsi }}
                                                    </td>
                                                    <td>
                                                        {{ $p->keterangan }}
                                                    </td>
                                                    <td>
                                                        {{ $p->catatan_pelanggan ? $p->catatan_pelanggan : '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $p->sisa_porsi }}
                                                    </td>
                                                    <td class="d-flex">
                                                        <form action="/pesanan/serve/{{ $p->id }}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-block btn-sm btn-primary" style="white-space: nowrap;" type="submit">Siap</button>
                                                        </form>
                                                        <a href="/pesanan/ganti_jadwal/{{ $p->id }}" class="btn btn-block btn-sm btn-success" style="white-space: nowrap;">Ganti Jadwal</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="siang">
                        <!-- /.nav-tabs-custom -->
                        <div class="row p-4">
                            <div class="col-md-12">
                                <table id="tabelSiang" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pelanggan</th>
                                            <th>Paket</th>
                                            <th>Porsi Pengiriman</th>
                                            <th>Alergi/Keterangan</th>
                                            <th>Catatan Pelanggan</th>
                                            <th>Sisa Porsi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan as $p)
                                            @if ($p->waktu_kirim == 'siang')
                                                <tr>
                                                    <td>
                                                        <a href="https://wa.me/+62{{ substr($p->wa, 1) }}" target="_blank">{{ $p->nama }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $p->paket }}
                                                    </td>
                                                    <td align="right">
                                                        {{ $p->porsi }}
                                                    </td>
                                                    <td>
                                                        {{ $p->keterangan }}
                                                    </td>
                                                    <td>
                                                        {{ $p->catatan_pelanggan ? $p->catatan_pelanggan : '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $p->sisa_porsi }}
                                                    </td>
                                                    <td class="d-flex">
                                                        <form action="/pesanan/serve/{{ $p->id }}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-block btn-sm btn-primary" style="white-space: nowrap;" type="submit">Siap</button>
                                                        </form>
                                                        <a href="/pesanan/ganti_jadwal/{{ $p->id }}" class="btn btn-block btn-sm btn-success" style="white-space: nowrap;">Ganti Jadwal</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="sore">
                        <!-- /.nav-tabs-custom -->
                        <div class="row p-4">
                            <div class="col-md-12">
                                <table id="tabelSore" class="table table-bordered table-striped">
                                <thead>
                                        <tr>
                                            <th>Pelanggan</th>
                                            <th>Paket</th>
                                            <th>Porsi Pengiriman</th>
                                            <th>Alergi/Keterangan</th>
                                            <th>Catatan Pelanggan</th>
                                            <th>Sisa Porsi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan as $p)
                                            @if ($p->waktu_kirim == 'sore')
                                                <tr>
                                                    <td>
                                                        <a href="https://wa.me/+62{{ substr($p->wa, 1) }}" target="_blank">{{ $p->nama }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $p->paket }}
                                                    </td>
                                                    <td align="right">
                                                        {{ $p->porsi }}
                                                    </td>
                                                    <td>
                                                        {{ $p->keterangan }}
                                                    </td>
                                                    <td>
                                                        {{ $p->catatan_pelanggan ? $p->catatan_pelanggan : '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $p->sisa_porsi }}
                                                    </td>
                                                    <td>
                                                        <form action="/pesanan/serve/{{ $p->id }}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-block btn-sm btn-primary" style="white-space: nowrap;" type="submit">Siap</button>
                                                        </form>
                                                        <a href="/pesanan/ganti_jadwal/{{ $p->id }}" class="btn btn-block btn-sm btn-success" style="white-space: nowrap;">Ganti Jadwal</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
@endsection

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('front-end-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Datepicker -->
<script src="{{ asset('front-end-admin/plugins/datepicker/datepicker.min.js') }}"></script>
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

        const time = new Date()
        const hours = time.getHours();

        if (hours >= 17  || hours < 7) {
            const tabPagi = document.getElementById('pagi');
            const hrefPagi = document.querySelector('[href="#pagi"]');
            tabPagi.classList.add('active');
            hrefPagi.classList.add('active');
        } else if (hours >= 7 || hours < 11) {
            const tabSiang = document.getElementById('siang');
            const hrefSiang = document.querySelector('[href="#siang"]');
            tabSiang.classList.add('active');
            hrefSiang.classList.add('active');
        } else {
            const tabSore = document.getElementById('sore');
            const hrefSore = document.querySelector('[href="#sore"]');
            tabSore.classList.add('active');
            hrefSore.classList.add('active');
        }
    });

    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd',
    });
    
    $('[data-toggle="datepicker"]').on('pick.datepicker', function (e) {
        // Y-m-d = 2021-01-18
        let time = e.date;
        
        let year = time.getFullYear();
        let month = time.getMonth();
        let date = time.getDate();
        
        // format month
        if (month < 9) {
            month = '0' + (month + 1);
        } else {
            month = month + 1;
        }

        // format date
        if (date < 10) {
            date = '0' + (date);
        }

        e.target.value = `${year}-${month}-${date}`;
        e.target.parentElement.parentElement.submit();
    })

    function siapAntar(element) {
        axios.post('/pengantaran/serve', {
            id_pesanan: element.dataset.id,
        })
            .then(({ data }) => {
                if (data.success) {
                    toastr.success(data.message);
                }
            })
    }

    const pesananMenu = document.getElementById('pesanan-menu');
    pesananMenu.classList.add('active');
</script>

<!-- page script -->
<script>
    $(function () {
        $("#tabelPagi").DataTable({
            "responsive": true,
            "autoWidth": true,
            "paging": true,
            "lengthMenu": [5, 10, 15, 20],
            "lengthPage": 5,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
        $("#tabelSiang").DataTable({
            "responsive": true,
            "autoWidth": true,
            "paging": true,
            "lengthMenu": [5, 10, 15, 20],
            "lengthPage": 5,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
        $("#tabelSore").DataTable({
            "responsive": true,
            "autoWidth": true,
            "paging": true,
            "lengthMenu": [5, 10, 15, 20],
            "lengthPage": 5,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });
</script>

@if (session('status'))
    <script>
        toastr.success(@json(session('status')));
    </script>
@endif
@endpush