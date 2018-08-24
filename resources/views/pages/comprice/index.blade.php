@extends('layouts.app')

@push('styles')
    {{-- DataTables --}}
    <link href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}"" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}"" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.css') }}"" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="container">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li>
                    Dashboard
                </li>
                <li class="active">
                    Input {{ $data->title }} Komoditas
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-border panel-custom">
                <div class="panel-heading">
                    <h5>
                        Daftar Komoditas
                        <a href="{{ route('admin.price.create', $data->slug) }}" class="btn btn-primary pull-right" style="margin-top: -8px;">Tambah</a>
                    </h5>
                </div>
                <div class="panel-body table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Komoditas</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Selisih</th>
                                <th>Pasar</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    {{-- DataTables --}}
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>    
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script>
        $(function() {
            $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('table.com.price', $data->slug) }}",
                    columns: [
                        {data: 'DT_Row_Index', name: 'id'},
                        {data: 'com.title', name: 'com.title'},
                        {data: 'com.com_unit.title', name: 'com.com_unit.title'},
                        {data: 'price', name: 'price'},
                        {data: 'status', name: 'status'},
                        {data: 'gap', name: 'gap'},
                        {data: 'market.title', name: 'market.title'},
                        {data: 'date', name: 'date'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
            });
        });
    </script>
@endpush