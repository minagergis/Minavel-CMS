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
                        <i class="fa fa-comments font-dark"></i>
                        <span class="caption-subject bold uppercase">
                            Comments
                            @if(count($post) > 0)
                                   on “<a href="{{ route('admin.posts.edit.get', $post->id) }}">{{ $post->post_title }}</a>”
                            @endif
                        </span>
                    </div>
                </div>
                <div class="portlet-body responsive">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
                        <thead>
                        <tr>
                            <th width="25%">Author</th>
                            <th>Comment</th>
                            <th>In Response To</th>
                            <th>Submitted On</th>
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
                    url: "{{ route('admin.comments.data.get' ) }}@if(\Request::get('p') != NULL && \Request::get('type') != NULL)?p={{ \Request::get('p') }}&type={{ \Request::get('type') }}@endif",

                },
                columns: [

                    {data: 'comment_author', name: 'comments.comment_author'},
                    {data: 'comment_content', name: 'comments.comment_content'},
                    {data: 'obj_id', name: 'comments.obj_id', orderable: false, searchable: false},
                    {data: 'created_at', name: 'comments.created_at'},

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