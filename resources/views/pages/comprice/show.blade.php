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
                        Harga Komoditas
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
                            Data Detail {{ $getData->com->title }}
                        </h5>
                    </div>
                    <div class="panel-body table-responsive">
                         <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                             <tr>
                                <td>
                                    Komoditas
                                </td>
                                <td>
                                    {{ $getData->com->title }}
                                </td>
                             </tr>
                             <tr>
                                <td>
                                    Jenis Komoditas
                                </td>
                                <td>
                                    {{ $getData->com->comCat->typeCom->title }}
                                </td>
                             </tr>
                             <tr>
                                 <td>
                                     Sumber Data
                                 </td>
                                 <td>
                                     {{ $getData->market->title }}
                                 </td>
                             </tr>
                             <tr>
                                 <td>Harga </td>
                                 <td>
                                     {{ $getData->price }} / {{ $getData->com->comUnit->title }}
                                 </td>
                             </tr>
                             <tr>
                                 <td>Tanggal</td>
                                 <td>{{ $getData->date->format('d/m/Y') }}</td>
                             </tr>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
@endsection