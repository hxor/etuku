@extends('layouts.app')

@push('styles')
    
@endpush

@section('content')
<div class="container">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li class="active">
                    Dashboard
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-border panel-custom">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Harga Komoditas Kota Cirebon</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on right"></i>
                            <h4 class="text-dark">Income status</h4>
                            <h2 class="text-primary text-center">$<span data-plugin="counterup">31570</span></h2>
                            <p class="text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-down text-success m-r-5"></i>10.25%</span></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on right"></i>
                            <h4 class="text-dark">Sales status</h4>
                            <h2 class="text-pink text-center">
                                <div id="sparkline2"><canvas width="250" height="38" style="display: inline-block; width: 250px; height: 38px; vertical-align: top;"></canvas></div>
                            </h2>
                            <p class="text-muted">Total sales: 2398 <span class="pull-right"><i class="fa fa-caret-up text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on right"></i>
                            <h4 class="text-dark">Income status</h4>
                            <h2 class="text-success text-center">$<span data-plugin="counterup">3652</span></h2>
                            <p class="text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on right"></i>
                            <h4 class="text-dark">Sales status</h4>
                            <h2 class="text-dark text-center"><span data-plugin="counterup">852</span></h2>
                            <p class="text-muted">Total sales: 2398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <!-- jQuery  -->
    <script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
    
    {{-- Plugins --}}
    <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    
    <script>
        $('#sparkline2').sparkline([3, 6, 7, 8, 4], {
                type: 'bar',
                height: '38',
                barWidth: '15',
                barSpacing: '3',
                barColor: '#5d9cec'
            });
    </script>
@endpush
