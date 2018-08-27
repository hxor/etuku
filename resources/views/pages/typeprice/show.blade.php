@extends('layouts.app') 
@section('content')
<div class="container">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li>
                    Dashboard
                </li>
                <li>
                    Jenis Harga
                </li>
                <li class="active">
                    Detail
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading">
                    <h5>
                        Data Detail {{ $getData->title }}
                    </h5>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <tr>
                            <td>
                                Judul
                            </td>
                            <td>
                                {{ $getData->title }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                slug
                            </td>
                            <td>
                                {{ $getData->slug }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection