@extends('layouts.public')

@push('styles')
    
@endpush

@section('content')
<div class="container">
    <!-- Page-Title -->
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="modal" data-target="#search-modal">Cari <span class="m-l-5"><i class="fa fa-search"></i></span></button>
        </div>

        <h4 class="page-title">Harga Komoditas {{ $commodity->title }}</h4>
        <ol class="breadcrumb">
            <li>
                <a href="#">Beranda</a>
            </li>
            <li>
                <a href="#">{{ $market->title }}</a>
            </li>
            <li class="active">
                {{ $typePrice->title }}
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $typePrice->title }} {{ $commodity->title }} di {{ $market->title }}</h3>
                </div>
                <div class="panel-body">
                    <div class="">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Harga Terbaru"></i>
                            <h4 class="text-dark">{{ $commodity->title }}</h4>
                            <h2 class="text-primary text-center">Rp<span data-plugin="counterup">{{ number_format($new = lastPrice($typePrice->id, $market->id, $commodity->id),0, ',', '.') }}</span></h2>
                            <p class="text-muted">
                                Harga Sebelumnya: Rp{{ number_format($old = secondPrice($typePrice->id, $market->id, $commodity->id),0, ',', '.') }}
                                <span class="pull-right">
                                    {!! getGap($old, $new) !!}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $typePrice->title }} {{ $commodity->title }} di {{ $market->title }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table tabel-hover">
                        <tr>
                            <td>Tanggal</td>
                            <td>Harga</td>
                            <td>Status</td>
                            <td>Selisih</td>
                        </tr>
                        @foreach (App\Models\CommodityPrice::where('type_price_id', $typePrice->id)
                        ->where('commodity_id', $commodity->id)->where('market_id', $market->id)->orderBy('date', 'DESC')->get() as $row)
                            <tr>
                                <td>{{ $row->date }}</td>
                                <td>{{ $row->price }}</td>
                                @if ($row->status == 'up')
                                    <td>Naik</td>
                                @elseif($row->status == 'down')
                                    <td>Turun</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ $row->gap }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    

</div>

{{-- Modal Search --}}
<div id="search-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <form action="{{ url('/search') }}">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">Cari Harga Komoditas</h4> 
                </div> 
                <div class="modal-body"> 
                    <div class="row">
                        <div class="form-group{{ $errors->has('market') ? ' has-error' : '' }}">
                            {!! Form::label('market', 'Pilih Pasar') !!}
                            {!! Form::select('market', $markets, null, ['id' => 'market', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('market') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            {!! Form::label('price', 'Pilih Jenis Harga') !!}
                            {!! Form::select('price',$typePrices, null, ['id' => 'price', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('price') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('commodity') ? ' has-error' : '' }}">
                            {!! Form::label('commodity', 'Pilih Komoditas') !!}
                            {!! Form::select('commodity', ['0' => 'Semua'] + $commodities, null, ['id' => 'commodity', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('commodity') }}</small>
                        </div>
                    </div> 
                </div> 
                <div class="modal-footer">  
                    <button type="submit" class="btn btn-info waves-effect waves-light">Cari</button> 
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->
@endsection

@push('scripts')
@endpush
