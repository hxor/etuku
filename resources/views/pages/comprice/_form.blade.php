@push('styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

<div class="form-group{{ $errors->has('type_price_id') ? ' has-error' : '' }}">
    {!! Form::label('type_price_id', 'Jenis Harga') !!}
    {!! Form::select('type_price_id', [$data->id => $data->title], null, ['id' => 'type_price_id', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('type_price_id') }}</small>
</div>

<div class="form-group{{ $errors->has('commodity_id') ? ' has-error' : '' }}">
    {!! Form::label('commodity_id', 'Komoditas') !!}
    {!! Form::select('commodity_id', \App\Models\Commodity::pluck('title', 'id'), null, ['id' => 'commodity_id', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('commodity_id') }}</small>
</div>

<div class="form-group{{ $errors->has('market_id') ? ' has-error' : '' }}">
    {!! Form::label('market_id', 'Sumber Pasar') !!}
    {!! Form::select('market_id', \App\Models\Market::pluck('title', 'id'), null, ['id' => 'market_id', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('market_id') }}</small>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    {!! Form::label('price', 'Harga') !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required', 'autofocus']) !!}
    <small class="text-danger">{{ $errors->first('price') }}</small>
</div>

<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
    {!! Form::label('date', 'Tanggal') !!}
    <div class="input-group">
        {!! Form::text('date', null, ['id' => 'datepicker-autoclose', 'class' => 'form-control', 'required' => 'required ', 'placeholder'=>"yyyy-mm-dd"]) !!}
        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
    </div>
    <!-- input-group -->
    {{-- {!! Form::text('date', null, ['id' => 'date', 'class' => 'form-control', 'required' => 'required ']) !!} --}}
    <small class="text-danger">{{ $errors->first('date') }}</small>
</div>

@push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
				
            jQuery('#datepicker-autoclose').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            });
            
        });
    </script>
@endpush