<div class="form-group{{ $errors->has('commodity_category_id') ? ' has-error' : '' }}">
    {!! Form::label('commodity_category_id', 'Jenis Komoditas') !!}
    {!! Form::select('commodity_category_id', \App\Models\CommodityCategory::pluck('title', 'id'), null, ['id' => 'commodity_category_id', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('commodity_category_id') }}</small>
</div>

<div class="form-group{{ $errors->has('unit_id') ? ' has-error' : '' }}">
    {!! Form::label('unit_id', 'Jenis Komoditas') !!}
    {!! Form::select('unit_id', \App\Models\Unit::pluck('title', 'id'), null, ['id' => 'unit_id', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('unit_id') }}</small>
</div>

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['onkeyup' => 'createslug()', 'id' => 'title', 'class' => 'form-control', 'required' => 'required ', 'autofocus']) !!}
    <small class="text-danger">{{ $errors->first('title') }}</small>
</div>

<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    {!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control',
    'required' => 'required ']) !!}
    <small class="text-danger">{{ $errors->first('slug') }}</small>
</div>

@push('scripts')
    <script type="text/javascript">
            function createslug()
            {
                var judul = $('#title').val();
                $('#slug').val(slugify(judul));
            }
 
            function slugify(text)
            {
                return text.toString().toLowerCase()
                        .replace(/\s+/g, '-')           // Replace spaces with -
                        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                        .replace(/^-+/, '')             // Trim - from start of text
                        .replace(/-+$/, '');            // Trim - from end of text
            }
    </script>
@endpush