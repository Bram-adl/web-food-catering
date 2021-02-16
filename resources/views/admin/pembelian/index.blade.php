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
        <h1>Pembelian</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Pembelian</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pembelian</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="nav nav-pills m-4">
                    <li class="nav-item"><a class="nav-link active" href="#semua" data-toggle="tab"><i class="fas fa-shopping-bag"></i> Semua</a></li>
                    <li class="nav-item"><a class="nav-link" href="#belum" data-toggle="tab"><i class="fas fa-hand-holding-usd"></i> Belum Bayar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#verifikasi" data-toggle="tab"><i class="fas fa-search-dollar"></i> Verifikasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aktif" data-toggle="tab"><i class="fa fa-money-bill"></i> Aktif</a></li>
                    <li class="nav-item"><a class="nav-link" href="#selesai" data-toggle="tab"><i class="fas fa-check-double"></i> Selesai</a></li>
                </ul>
                <hr>
                <div class="tab-content pt-2 px-4 pb-4">
                    <div class="active tab-pane" id="semua">
                        <!-- /.nav-tabs-custom -->
                        <div class="card-body p-0">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Unik</th>
                                        <th>Pelangan</th>
                                        <th>Paket</th>
                                        <th>Lokasi</th>
                                        <th>Alamat Pengiriman</th>
                                        <th>Waktu Pengiriman</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Bukti Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pembelian as $p)
                                    <tr>
                                        <td>
                                            {{ $p->kode_unik }}
                                        </td>
                                        <td>
                                            <a href="https://wa.me/+62{{ $p->pelanggan->wa }}" target="_link">{{ $p->pelanggan->nama }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $p->paket->paket }}</span>
                                            <br>
                                            <b>Rp. {{ number_format($p->paket->harga, 0, ',', '.') }}</b>
                                        </td>
                                        <td>
                                            {{ strtoupper(substr($p->lokasi, 0, 1)) . substr($p->lokasi, 1) }}
                                        </td>
                                        <td>
                                            {{ $p->alamat }}
                                        </td>
                                        <td>
                                            @php
                                                $hari = explode('|', $p->waktu_pengiriman)[0];
                                                $waktu = explode('|', $p->waktu_pengiriman)[1];
                                                $perhari = explode(':', $hari)[1];
                                                $perwaktu = explode(':', $waktu)[1];
                                            @endphp
                                            <strong>{{ $perhari }}</strong>
                                            <div class="d-flex align-items-center justify-center">
                                                @foreach (explode(',', $perwaktu) as $w)
                                                    @if (trim($w) == 'pagi')
                                                        <span class="badge badge-primary">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'siang')
                                                        <span class="badge badge-success">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'sore')
                                                        <span class="badge badge-warning">{{ $w }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $bulan = [
                                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                                ];
                                                $tanggal = date('d-m-Y', strtotime($p->tanggal_mulai));
                                                $explode = explode('-', $tanggal);

                                                $test = $explode[0] . ' ' . $bulan[(int)$explode[1] - 1] . ' ' .$explode[2];
                                                echo $test;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="{{ $p->bukti_bayar ? '/images/bukti/' . $p->bukti_bayar : '#' }}" target="_blank"><img style="width: 50px; height: 50px; object-fit: cover;" src="{{ $p->bukti_bayar ? asset('images/bukti/' . $p->bukti_bayar) : asset('images/default-150x150.png') }}"></a>
                                        </td>
                                        <td>
                                            @if ($p->status == 'Aktif')
                                            <span class="badge badge-success">Aktif</span>
                                            <br>
                                            @elseif ($p->status == 'Belum bayar')
                                            <!-- Belum bayar = belum mengunggah bukti pembayaran -->
                                            <span class="badge badge-info">Belum bayar</span>
                                            <br>
                                            @elseif ($p->status == 'Proses verifikasi')
                                            <!-- Proses verifikasi = sudah mengunggah tetapi belum di-approve admin -->
                                            <span class="badge badge-warning">Proses verifikasi</span>
                                            <br>
                                            @elseif ($p->status == 'Selesai')
                                            <!-- Selsai = sudah di-approve oleh admin -->
                                            <span class="badge badge-danger">Selesai</span>
                                            @else
                                            <span class="badge badge-secondary">Batal</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="tab-pane" id="belum">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Unik</th>
                                    <th>Pelangan</th>
                                    <th>Paket</th>
                                    <th>Lokasi</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Waktu Pengiriman</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Bukti Bayar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembelian as $p)
                                    @if ($p->status == 'Belum bayar')
                                    <tr>
                                        <td>
                                            {{ $p->kode_unik }}
                                        </td>
                                        <td>
                                            <a href="https://wa.me/+62{{ $p->pelanggan->wa }}" target="_link">{{ $p->pelanggan->nama }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $p->paket->paket }}</span>
                                            <br>
                                            <b>Rp. {{ number_format($p->paket->harga, 0, ',', '.') }}</b>
                                        </td>
                                        <td>
                                            {{ strtoupper(substr($p->lokasi, 0, 1)) . substr($p->lokasi, 1) }}
                                        </td>
                                        <td>
                                            {{ $p->alamat }}
                                        </td>
                                        <td>
                                            @php
                                                $hari = explode('|', $p->waktu_pengiriman)[0];
                                                $waktu = explode('|', $p->waktu_pengiriman)[1];

                                                $perhari = explode(':', $hari)[1];
                                                $perwaktu = explode(':', $waktu)[1];
                                            @endphp
                                            <strong>{{ $perhari }}</strong>
                                            <div class="d-flex align-items-center justify-center">
                                                @foreach (explode(',', $perwaktu) as $w)
                                                    @if (trim($w) == 'pagi')
                                                        <span class="badge badge-primary">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'siang')
                                                        <span class="badge badge-success">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'sore')
                                                        <span class="badge badge-warning">{{ $w }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $bulan = [
                                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                                ];
                                                $tanggal = date('d-m-Y', strtotime($p->tanggal_mulai));
                                                $explode = explode('-', $tanggal);

                                                $test = $explode[0] . ' ' . $bulan[(int)$explode[1] - 1] . ' ' .$explode[2];
                                                echo $test;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="{{ $p->bukti_bayar ? '/images/bukti/' . $p->bukti_bayar : '#' }}" target="_blank"><img style="width: 50px; height: 50px; object-fit: cover;" src="{{ $p->bukti_bayar ? asset('images/bukti/' . $p->bukti_bayar) : asset('images/default-150x150.png') }}"></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm bg-danger" onclick="batalkanPembelian(this)">Batalkan</button>
                                            <form action="{{ url('/pembelian/batalkan/' . $p->id) }}" method="POST" class="d-none">@csrf</form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="verifikasi">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Unik</th>
                                    <th>Pelangan</th>
                                    <th>Paket</th>
                                    <th>Lokasi</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Waktu Pengiriman</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Bukti Bayar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembelian as $p)
                                    @if ($p->status == 'Proses verifikasi')
                                    <tr>
                                        <td>
                                            {{ $p->kode_unik }}
                                        </td>
                                        <td>
                                            <a href="https://wa.me/+62{{ $p->pelanggan->wa }}" target="_link">{{ $p->pelanggan->nama }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $p->paket->paket }}</span>
                                            <br>
                                            <b>Rp. {{ number_format($p->paket->harga, 0, ',', '.') }}</b>
                                        </td>
                                        <td>
                                            {{ strtoupper(substr($p->lokasi, 0, 1)) . substr($p->lokasi, 1) }}
                                        </td>
                                        <td>
                                            {{ $p->alamat }}
                                        </td>
                                        <td>
                                            @php
                                                $hari = explode('|', $p->waktu_pengiriman)[0];
                                                $waktu = explode('|', $p->waktu_pengiriman)[1];

                                                $perhari = explode(':', $hari)[1];
                                                $perwaktu = explode(':', $waktu)[1];
                                            @endphp
                                            <strong>{{ $perhari }}</strong>
                                            <div class="d-flex align-items-center justify-center">
                                                @foreach (explode(',', $perwaktu) as $w)
                                                    @if (trim($w) == 'pagi')
                                                        <span class="badge badge-primary">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'siang')
                                                        <span class="badge badge-success">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'sore')
                                                        <span class="badge badge-warning">{{ $w }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $bulan = [
                                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                                ];
                                                $tanggal = date('d-m-Y', strtotime($p->tanggal_mulai));
                                                $explode = explode('-', $tanggal);

                                                $test = $explode[0] . ' ' . $bulan[(int)$explode[1] - 1] . ' ' .$explode[2];
                                                echo $test;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="{{ $p->bukti_bayar ? '/images/bukti/' . $p->bukti_bayar : '#' }}" target="_blank"><img style="width: 50px; height: 50px; object-fit: cover;" src="{{ $p->bukti_bayar ? asset('images/bukti/' . $p->bukti_bayar) : asset('images/default-150x150.png') }}"></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm bg-success" onclick="verifikasiPembelian(this)">Verifikasi</button>
                                            <form action="{{ url('/pembelian/verifikasi/' . $p->id) }}" method="POST" class="d-none">@csrf</form>
                                            <button class="btn btn-sm bg-danger" onclick="batalkanPembelian(this)">Batalkan</button>
                                            <form action="{{ url('/pembelian/batalkan/' . $p->id) }}" method="POST" class="d-none">@csrf</form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>    
                    <div class="tab-pane" id="aktif">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Unik</th>
                                    <th>Pelangan</th>
                                    <th>Paket</th>
                                    <th>Lokasi</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Waktu Pengiriman</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Bukti Bayar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembelian as $p)
                                    @if ($p->status == 'Aktif')
                                    <tr>
                                        <td>
                                            {{ $p->kode_unik }}
                                        </td>
                                        <td>
                                            <a href="https://wa.me/+62{{ $p->pelanggan->wa }}" target="_link">{{ $p->pelanggan->nama }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $p->paket->paket }}</span>
                                            <br>
                                            <b>Rp. {{ number_format($p->paket->harga, 0, ',', '.') }}</b>
                                        </td>
                                        <td>
                                            {{ strtoupper(substr($p->lokasi, 0, 1)) . substr($p->lokasi, 1) }}
                                        </td>
                                        <td>
                                            {{ $p->alamat }}
                                        </td>
                                        <td>
                                            @php
                                                $hari = explode('|', $p->waktu_pengiriman)[0];
                                                $waktu = explode('|', $p->waktu_pengiriman)[1];

                                                $perhari = explode(':', $hari)[1];
                                                $perwaktu = explode(':', $waktu)[1];
                                            @endphp
                                            <strong>{{ $perhari }}</strong>
                                            <div class="d-flex align-items-center justify-center">
                                                @foreach (explode(',', $perwaktu) as $w)
                                                    @if (trim($w) == 'pagi')
                                                        <span class="badge badge-primary">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'siang')
                                                        <span class="badge badge-success">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'sore')
                                                        <span class="badge badge-warning">{{ $w }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $bulan = [
                                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                                ];
                                                $tanggal = date('d-m-Y', strtotime($p->tanggal_mulai));
                                                $explode = explode('-', $tanggal);

                                                $test = $explode[0] . ' ' . $bulan[(int)$explode[1] - 1] . ' ' .$explode[2];
                                                echo $test;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="{{ $p->bukti_bayar ? '/images/bukti/' . $p->bukti_bayar : '#' }}" target="_blank"><img style="width: 50px; height: 50px; object-fit: cover;" src="{{ $p->bukti_bayar ? asset('images/bukti/' . $p->bukti_bayar) : asset('images/default-150x150.png') }}"></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm bg-primary" onclick="selesaikanPembelian(this)">Selesai</button>
                                            <form action="{{ url('/pembelian/selesai/' . $p->id) }}" method="POST" class="d-none">@csrf</form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="selesai">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Unik</th>
                                    <th>Pelangan</th>
                                    <th>Paket</th>
                                    <th>Lokasi</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Waktu Pengiriman</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Bukti Bayar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembelian as $p)
                                    @if ($p->status == 'Selesai')
                                    <tr>
                                        <td>
                                            {{ $p->kode_unik }}
                                        </td>
                                        <td>
                                            <a href="https://wa.me/+62{{ $p->pelanggan->wa }}" target="_link">{{ $p->pelanggan->nama }}</a>
                                        </td>
                                        <td>
                                            <span>{{ $p->paket->paket }}</span>
                                            <br>
                                            <b>Rp. {{ number_format($p->paket->harga, 0, ',', '.') }}</b>
                                        </td>
                                        <td>
                                            {{ strtoupper(substr($p->lokasi, 0, 1)) . substr($p->lokasi, 1) }}
                                        </td>
                                        <td>
                                            {{ $p->alamat }}
                                        </td>
                                        <td>
                                            @php
                                                $hari = explode('|', $p->waktu_pengiriman)[0];
                                                $waktu = explode('|', $p->waktu_pengiriman)[1];

                                                $perhari = explode(':', $hari)[1];
                                                $perwaktu = explode(':', $waktu)[1];
                                            @endphp
                                            <strong>{{ $perhari }}</strong>
                                            <div class="d-flex align-items-center justify-center">
                                                @foreach (explode(',', $perwaktu) as $w)
                                                    @if (trim($w) == 'pagi')
                                                        <span class="badge badge-primary">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'siang')
                                                        <span class="badge badge-success">{{ $w }}</span>
                                                    @endif
                                                    @if (trim($w) == 'sore')
                                                        <span class="badge badge-warning">{{ $w }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $bulan = [
                                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                                ];
                                                $tanggal = date('d-m-Y', strtotime($p->tanggal_mulai));
                                                $explode = explode('-', $tanggal);

                                                $test = $explode[0] . ' ' . $bulan[(int)$explode[1] - 1] . ' ' .$explode[2];
                                                echo $test;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="{{ $p->bukti_bayar ? '/images/bukti/' . $p->bukti_bayar : '#' }}" target="_blank"><img style="width: 50px; height: 50px; object-fit: cover;" src="{{ $p->bukti_bayar ? asset('images/bukti/' . $p->bukti_bayar) : asset('images/default-150x150.png') }}"></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm bg-success" data-id="{{ $p->id }}" onclick="hapusPembelian(this)">Hapus</button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Pembelian Pelanggan</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="pembelianPelanggan" style="height: 250px; min-height: 250px; display: block; width: 371px;" width="742" height="500" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Pembelian Paket</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="pembelianPaket" style="height: 230px; min-height: 230px; display: block; width: 371px;" width="742" height="460" class="chartjs-render-monitor"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" action="{{ url('/pembelian') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="pelanggan" class="col-sm-2 col-form-label">Pelanggan</label>
                        <div class="col-sm-10">
                            <select class="custom-select @error('id_pelanggan') is-invalid @enderror" name="id_pelanggan">
                                <option value="" selected hidden disabled>-- Pilih Pelanggan --</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_pelanggan')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paket" class="col-sm-2 col-form-label">Paket</label>
                        <div class="col-sm-10">
                            <select class="custom-select @error('id_paket') is-invalid @enderror" name="id_paket">
                                <option value="" selected hidden disabled>-- Pilih Paket --</option>
                                @foreach($paket as $p)
                                    <option value="{{ $p->id }}">{{ $p->paket }}</option>
                                @endforeach
                            </select>
                            @error('id_paket')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bukti_bayar" class="col-sm-2 col-form-label">Bukti Bayar</label>
                        <div class="col-sm-10">
                            <input type="file" class="custom-file-input @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar" name="bukti_bayar">
                            <label class="custom-file-label text-muted" for="bukti_bayar">Kosongkan jika tidak ingin mengganti bukti bayar</label>
                            @error('bukti_bayar')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="status">
                                <option value="Belum bayar" selected>Belum bayar</option>
                                <option value="Proses verifikasi">Proses verifikasi</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambahkan Data</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- MODAL HAPUS DATA-->
<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin akan menghapus pembelian?</p>
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
<!-- ChartJS -->
<script src="{{ asset('front-end-admin/plugins/chart.js/Chart.min.js') }}"></script>

<script>
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // data pembelian
    let dataPembelian = @json($data_pembelian);

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#pembelianPelanggan').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Jumlah Pembelian',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
            @json($pbl_jan), @json($pbl_feb), @json($pbl_mar), @json($pbl_apr), @json($pbl_mei), @json($pbl_jun), 
            @json($pbl_jul), @json($pbl_ags), @json($pbl_sep), @json($pbl_okt), @json($pbl_nov), @json($pbl_des), 
          ]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var paket = @json($paket);
    var data_paket = paket.map(p => p.paket);

    var pembelian = @json($pembelian);

    let data_pembelian = [];

    for (let i = 0; i < pembelian.length; i++) {
        data_pembelian.push(pembelian[i].id_paket);
    }
    
    let counts = {};
    let source = {};

    for (let i = 0; i < paket.length; i++) {
        source[i + 1] = 0;
    }

    data_pembelian.forEach(function(x) { counts[x] = (counts[x] || 0)+1; });

    let data_final_pembelian_paket = Object.assign(source, counts);
    let count_data_pembelian_paket = Object.values(data_final_pembelian_paket);

    let backgroundColor = [];

    function generateColor() {
        let color = '#';
        const HEX = [
            '0', '1', '2', '3', '4', '5', '6', '7', 
            '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'
        ];
        
        for (let i = 0; i < 6; i++) {
            const random = Math.floor(Math.random() * HEX.length);
            color += HEX[random];
        }

        return color;
    }

    for (let i = 0; i < paket.length; i++) {
        backgroundColor.push(generateColor());
    }

    var donutChartCanvas = $('#pembelianPaket').get(0).getContext('2d')
    var donutData        = {
      labels: data_paket,
      datasets: [
        {
          data: count_data_pembelian_paket,
          backgroundColor : backgroundColor,
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })
</script>

<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
        });
    });

    const pembelianMenu = document.getElementById('pembelian-menu');
    pembelianMenu.classList.add('active');
</script>

<!-- page script -->
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [5, 10, 15, 20],
            "lengthPage": 5,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function hapusPembelian(element) {
        const id = element.dataset.id;
        
        $('#modal-hapus').modal('show');
        $('.toastrHapusSuccess').on('click', function () {
            axios.delete('/pembelian/' + id)
                .then(({data}) => {
                    toastr.success(data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
        });
    }

    function verifikasiPembelian(element) {
        let verifikasi = confirm('Yakin verifikasi pembelian?');

        if (verifikasi) {
            element.nextElementSibling.submit();
        }
    }

    function batalkanPembelian(element) {
        let batalkan = confirm('Batalkan pembelian?');
        if (batalkan) {
            element.nextElementSibling.submit();
        }
    }

    function selesaikanPembelian(element) {
        let selesai = confirm('Apakah pembelian telah selsai ?');

        if (selesai) {
            element.nextElementSibling.submit();
        }
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