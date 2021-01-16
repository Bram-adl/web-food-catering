@extends('admin.layouts.app')

@push('styles')
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('front-end-admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
@endpush

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Pengantaran</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Pengantaran</li>
        </ol>
    </div>
</div>
@endsection

@section('main-content')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                    <h3 class="card-title">Pengantaran | <span class="badge badge-info">{{ $waktu }}, {{ date('d M Y') }}</span></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
                    <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                            @foreach ($pesanan as $p)
                                @if ($p->waktu_kirim == strtolower($waktu))
                                    <li class="d-flex align-items-center justify-content-between">
                                        <!-- drag handle -->
                                        <span class="handle">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <div  class="icheck-primary d-inline ml-2">
                                                <input type="checkbox" value="" name="{{ $p->id }}" id="{{ $p->id }}">
                                                <label for="{{ $p->id }}"></label>
                                        </div>
                                        <!-- text -->
                                        <span class="text">{{ $p->nama }}</span>
                                        <small class="badge badge-danger"><i class="fa fa-pizza-slice"></i>{{ $p->porsi }} porsi</small>

                                        <span class="text">|</span>
                                        <span class="text">
                                                <a href="https://wa.me/+62{{ substr($p->wa, 1) }}" target="_link" class="text text-success">
                                                    <i class="fas fa-comment"></i>
                                                    <span>{{ $p->wa }}</span>
                                                </a>
                                        </span>

                                        <span class="text">|</span>
                                            @if ($p->lokasi == 'rumah')
                                                <a href="{{ $p->rumah_maps }}" target="_link">
                                                    {{ $p->rumah_teks }}
                                                </a>
                                            @else
                                                <a href="{{ $p->kantor_maps }}" target="_link">
                                                    {{ $p->kantor_teks }}
                                                </a>
                                            @endif

                                        <span class="text">|</span>
                                        <span>
                                            {{ $p->catatan_pelanggan ? $p->catatan_pelanggan : 'Tidak terdapat catatan pelanggan.' }}
                                        </span>
                                        
                                        <span class="text">|</span>
                                        <span class="text">
                                                <form>
                                                    <input type="text" name="keterangan" class="form-control" placeholder="Ex: Dikasih ke pengemis">
                                                </form>
                                        </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <button type="button" class="btn btn-primary float-right">Simpan</button>
                    </div>
            </div>
        </div>
    </section>
    <!-- /.Left col -->
</div>
<!-- /.row (main row) -->
@endsection

@push('scripts')
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('front-end-admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="{{ asset('front-end-admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('front-end-admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('front-end-admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('front-end-admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('front-end-admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('front-end-admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('front-end-admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('front-end-admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('front-end-admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('front-end-admin/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('front-end-admin/js/demo.js') }}"></script>
@endpush