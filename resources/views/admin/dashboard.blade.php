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
                <h3>5</h3>
                <p>Total Personel</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="personel.html" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>22</h3>
                <p>Total Paket</p>
            </div>
            <div class="icon">
                <i class="ion ion-pizza"></i>
            </div>
            <a href="paket.html" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>1.364</h3>
                <p>Total Pelanggan</p>
            </div>
            <div class="icon">
                <i class="ion ion-heart"></i>
            </div>
            <a href="pelanggan.html" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>82.543</h3>
                <p>Porsi Terkirim</p>
            </div>
            <div class="icon">
                <i class="ion ion-location"></i>
            </div>
            <a href="pesanan.html" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
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
                            <span class="float-right"><b>202</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->

                        <div class="progress-group">
                            Registrasi
                            <span class="float-right"><b>82</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: 41%"></div>
                            </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Membeli</span>
                            <span class="float-right"><b>76</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: 38%"></div>
                            </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                            Membayar
                            <span class="float-right"><b>73</b> orang</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 36%"></div>
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
                        <tr>
                            <td>
                                <img src="img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Nasi Merah 24x Makan
                            </td>
                            <td>
                                <small class="text-success mr-1">
                                    <i class="fas fa-arrow-up"></i>
                                    21%
                                </small>
                                162 terjual
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Nasi Putih 12x Makan
                            </td>
                            <td>
                                <small class="text-success mr-1">
                                    <i class="fas fa-arrow-up"></i>
                                    12%
                                </small>
                                144 terjual
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Nasi Putih 24x Makan
                            </td>
                            <td>
                                <small class="text-warning mr-1">
                                    <i class="fas fa-arrow-down"></i>
                                    0.5%
                                </small>
                                125 terjual
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Tanpa Nasi 6x makan
                            </td>
                            <td>
                                <small class="text-danger mr-1">
                                    <i class="fas fa-arrow-down"></i>
                                    3%
                                </small>
                                58 terjual
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                Tanpa Nasi 6x makan
                            </td>
                            <td>
                                <small class="text-danger mr-1">
                                    <i class="fas fa-arrow-down"></i>
                                    3%
                                </small>
                                58 terjual
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
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
                        <span class="text-bold text-lg">Rp. 42.482.000</span>
                        <span>pendapatan bulan ini</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 33.1%
                        </span>
                        <span class="text-muted">dibanding bulan sebelumnya</span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Tahun ini
                    </span>

                    <span>
                        <i class="fas fa-square text-gray"></i> Tahun sebelumnya
                    </span>
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

<!-- PAGE SCRIPTS -->
<script src="{{ asset('front-end-admin/js/pages/dashboard2.js') }}"></script>
@endpush