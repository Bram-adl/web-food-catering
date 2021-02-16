@extends('admin.layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div><!-- /.col -->
</div>
@endsection

@section('main-content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jml_personel }}</h3>
                <p>Total Personel</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="/personel" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $jml_paket }}</h3>
                <p>Total Paket</p>
            </div>
            <div class="icon">
                <i class="ion ion-pizza"></i>
            </div>
            <a href="/paket" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $jml_pelanggan }}</h3>
                <p>Total Pelanggan</p>
            </div>
            <div class="icon">
                <i class="ion ion-heart"></i>
            </div>
            <a href="/pelanggan" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $jml_pengiriman }}</h3>
                <p>Porsi Terkirim</p>
            </div>
            <div class="icon">
                <i class="ion ion-location"></i>
            </div>
            <a href="/pengantaran" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Ringkasan Laporan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong>Pengunjung 7 Bulan Terakhir</strong>
                        </p>                    
                        <div class="card-body">
                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                            </div>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Perilaku Pengunjung</strong>
                        </p>

                        <div class="progress-group">
                            Berkunjung
                            <span class="float-right"><b>{{ $number_of_visitors }}</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: calc({{ $number_of_visitors }}pt / 100)"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->

                        <div class="progress-group">
                            Registrasi
                            <span class="float-right"><b>{{ $jml_pendaftar_dlm_tujuh_bulan }}</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: calc({{ $jml_pendaftar_dlm_tujuh_bulan }}pt / 100)"></div>
                            </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Membeli</span>
                            <span class="float-right"><b>{{ $jml_pembelian_dlm_tujuh_bulan }}</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: calc({{ $jml_pembelian_dlm_tujuh_bulan }}pt / 100)"></div>
                            </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                            Membayar
                            <span class="float-right"><b>{{ $jml_pembayaran_dlm_tujuh_bulan }}</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: calc({{ $jml_pembayaran_dlm_tujuh_bulan }}pt / 100)"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Paket Paling Laku</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th align="center">PAKET</th>
                            <th>TERJUAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian_terbanyak as $p)
                        <tr>
                            <td>
                                <img src="/images/foods/{{ $p->foto }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                                {{ $p->paket }}
                            </td>
                            <td>
                                {{ $p->jumlah_pembelian }} terjual
                            </td>
                            <td>
                                <a href="/images/foods/{{ $p->foto }}" class="text-muted">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Performa Penjualan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Rp. {{ number_format($pendapatan_bulan_ini[0]->total, 0, ',', '.') }}</span>
                        <span>pendapatan bulan ini</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                            @if ($pendapatan_bulan_ini[0]->total > $pendapatan_bulan_sebelumnya[0]->total)
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 
                                {{$perbandingan_total}}%
                            </span>
                            @else
                            <span class="text-danger">
                                <i class="fas fa-arrow-down"></i> 
                                {{100 - $perbandingan_total}}%
                            </span>
                            @endif
                        <span class="text-muted">dibanding bulan sebelumnya</span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->
@endsection

@push('scripts')
<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('front-end-admin/js/demo.js') }}"></script>
<script src="{{ asset('front-end-admin/js/pages/dashboard3.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('front-end-admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- SweetAlert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('front-end-admin/js/pages/dashboard2.js') }}"></script>

<script>
    const dashboardMenu = document.getElementById('dashboard-menu')
    dashboardMenu.classList.add('active')
</script>

<script>
    //-------------
    //- BAR CHART -
    //-------------
    var jan_thn_ini = +@json($pendapatan_januari_tahun_ini) || 0;
    var feb_thn_ini = +@json($pendapatan_februari_tahun_ini) || 0;
    var maret_thn_ini = +@json($pendapatan_maret_tahun_ini) || 0;
    var april_thn_ini = +@json($pendapatan_april_tahun_ini) || 0;
    var mei_thn_ini = +@json($pendapatan_mei_tahun_ini) || 0;
    var juni_thn_ini = +@json($pendapatan_juni_tahun_ini) || 0;
    var juli_thn_ini = +@json($pendapatan_juli_tahun_ini) || 0;
    var agustus_thn_ini = +@json($pendapatan_agustus_tahun_ini) || 0;
    var september_thn_ini = +@json($pendapatan_september_tahun_ini) || 0;
    var oktober_thn_ini = +@json($pendapatan_oktober_tahun_ini) || 0;
    var november_thn_ini = +@json($pendapatan_november_tahun_ini) || 0;
    var desember_thn_ini = +@json($pendapatan_desember_tahun_ini) || 0;

    var jan_thn_sebelumnya = +@json($pendapatan_januari_tahun_sebelumnya) || 0;
    var feb_thn_sebelumnya = +@json($pendapatan_februari_tahun_sebelumnya) || 0;
    var maret_thn_sebelumnya = +@json($pendapatan_maret_tahun_sebelumnya) || 0;
    var april_thn_sebelumnya = +@json($pendapatan_april_tahun_sebelumnya) || 0;
    var mei_thn_sebelumnya = +@json($pendapatan_mei_tahun_sebelumnya) || 0;
    var juni_thn_sebelumnya = +@json($pendapatan_juni_tahun_sebelumnya) || 0;
    var juli_thn_sebelumnya = +@json($pendapatan_juli_tahun_sebelumnya) || 0;
    var agustus_thn_sebelumnya = +@json($pendapatan_agustus_tahun_sebelumnya) || 0;
    var september_thn_sebelumnya = +@json($pendapatan_september_tahun_sebelumnya) || 0;
    var oktober_thn_sebelumnya = +@json($pendapatan_oktober_tahun_sebelumnya) || 0;
    var november_thn_sebelumnya = +@json($pendapatan_november_tahun_sebelumnya) || 0;
    var desember_thn_sebelumnya = +@json($pendapatan_desember_tahun_sebelumnya) || 0;

    var dataTahunIni = [
        jan_thn_ini, feb_thn_ini, maret_thn_ini, april_thn_ini, mei_thn_ini, juni_thn_ini, juli_thn_ini,
        agustus_thn_ini, september_thn_ini, oktober_thn_ini, november_thn_ini, desember_thn_ini,
    ];

    var dataTahunSebelumnya = [
        jan_thn_sebelumnya, feb_thn_sebelumnya, maret_thn_sebelumnya, april_thn_sebelumnya, mei_thn_sebelumnya, juni_thn_sebelumnya, juli_thn_sebelumnya,
        agustus_thn_sebelumnya, september_thn_sebelumnya, oktober_thn_sebelumnya, november_thn_sebelumnya, desember_thn_sebelumnya,
    ];
    
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = {
        labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [
            {
                label               : 'Tahun Ini',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : dataTahunIni,
            },
            {
                label               : 'Tahun Sebelumnya',
                backgroundColor     : 'rgba(210, 214, 222, 1)',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : dataTahunSebelumnya,
            },
        ]
    }
    var temp0 = barChartData.datasets[0]
    var temp1 = barChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
</script>

@if (session('status'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    })

    Toast.fire({
        icon: 'success',
        title: @json(session('status')),
    })
</script>
@endif
@endpush