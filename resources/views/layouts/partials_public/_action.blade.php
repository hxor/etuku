{!! Form::model($model, ['url' => $delete_url, 'method' => 'DELETE']) !!}
    <a href="{{ $show_url }}" class="btn btn-info btn-custom btn-xs waves-effect">Show</a>
    <a href="{{ $edit_url }}" class="btn btn-white btn-custom btn-xs waves-effect">Edit</a>
    <button 
        type="submit" 
        class="btn btn-danger btn-custom btn-xs waves-effect"
        onclick="return confirm('Are you sure want to delete this data ?')"
    >Delete</button>
{!! Form::close() !!}