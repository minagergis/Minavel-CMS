@extends('admin::layouts.master')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/dist/css/bootstrap-formhelpers.min.css') }}"/>
@stop

@section('content')


                    <!-- BEGIN PAGE BASE CONTENT -->

                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Zones</span>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.zone.add.get') }}" class="btn sbold green">
                                                Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                @if(isset($language_icon))
                                                    @foreach($language_icon as $i)
                                                        <th><i class="glyphicon bfh-flag-{{ $i }}"></th>
                                                    @endforeach
                                                @endif
                                                <th>Action</tDh>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->

@stop
@section('scripts')

    <script src="{{ asset('public/assets/admin/global/scripts/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>

    <script type="text/javascript">

        $(function () {

            var oTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.zone.data.get') }}",
                },
                columns: [

                    {data: 'name', name: 'zone_translations.name'},
                    @if(isset($language_available))
                        @foreach($language_available as $l)
                        {
                            data: '{{{ $l }}}', name: 'zone.id', orderable: false, searchable: false
                        },
                        @endforeach
                    @endif

                    {
                        data: 'action', name: 'action', orderable: false, searchable: false
                    }
                ]
            });
            oTable.draw();
            $('#search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });

        });

    </script>

@stop