@extends('admin::layouts.master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"/>
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
                                        <span class="caption-subject bold uppercase"> Permissions</span>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.roles.add.get') }}" class="btn sbold green">
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
                                                <th>Display Name</th>
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
                    url: "{{ route('admin.roles.data.get') }}",
                },
                columns: [

                    {data: 'name', name: 'roles.name'},
                    {data: 'display_name', name: 'roles.display_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
            
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