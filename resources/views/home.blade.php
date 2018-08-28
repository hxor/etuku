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
                    Dashboard / Daftar Harga
                </li>
            </ol>
        </div>
    </div>

    @foreach ($typePrice as $typePrice)
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-border panel-custom">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar {{ $typePrice->title }}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach ($market as $place) 
                        <div class="row">
                            <h4>{{ $place->title }}</h4>
                            @foreach ($commodity->get() as $com)
                                <div class="col-md-6 col-sm-6 col-lg-3">
                                    <div class="card-box widget-box-1 bg-white">
                                        <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Harga Terbaru"></i>
                                        <h4 class="text-dark">{{ $com->title }}</h4>
                                        <h2 class="text-primary text-center">Rp<span data-plugin="counterup">{{ number_format($new = lastPrice($typePrice->id, $place->id, $com->id),0, ',', '.') }}</span></h2>
                                        <p class="text-muted">
                                            Harga Sebelumnya: Rp{{ number_format($old = secondPrice($typePrice->id, $place->id, $com->id),0, ',', '.') }}
                                            <span class="pull-right">
                                                {!! getGap($old, $new) !!}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection

@push('scripts')
    <!-- jQuery  -->
    <script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
    
    {{-- Plugins --}}
    {{-- <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    
    <script>
        $('.sparkline2').sparkline([3, 6, 7, 8, 4], {
            type: 'bar',
            height: '38',
            barWidth: '15',
            barSpacing: '3',
            barColor: '#5d9cec'
        });
    </script> --}}
@endpush
