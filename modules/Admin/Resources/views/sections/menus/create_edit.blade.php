@extends('admin::layouts.master')

@section('styles')
<link href="{{ asset('public/assets/admin/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet" type="text/css" />

@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Add New Menu</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('admin.permissions.add.post', \Request::get('post_type')) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               
                        <div class="row">
                            <div class="col-md-4">
                                

                               
                               <div class="portlet-body">
                                  <div class="panel-group accordion menu" id="accordion3">
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 class="panel-title">
                                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#pages" aria-expanded="false"> Pages </a>
                                           </h4>
                                        </div>
                                        <div id="pages" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                           <div class="panel-body">


                                              <div class="tabbable tabbable-tabdrop">
                                                 <ul class="nav nav-tabs">
                                                    <li class="active">
                                                       <a href="#page_most_recent" data-toggle="tab" aria-expanded="true">Most Recent</a>
                                                    </li>
                                                    <li class="">
                                                       <a href="#page_view_all" data-toggle="tab" aria-expanded="false">View All</a>
                                                    </li>
                                                    <li class="">
                                                       <a href="#page_search" data-toggle="tab" aria-expanded="false">Search</a>
                                                    </li>
                                                 </ul>
                                                 <div class="tab-content">
                                                    <div class="tab-pane active" id="page_most_recent">

                                                        <div class="menu-content form-md-checkboxes">
                                                           <div class="most_recent md-checkbox-list">
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox1" class="md-check">
                                                                 <label for="checkbox1">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 1 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox2" class="md-check" checked="">
                                                                 <label for="checkbox2">
                                                                 <span></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 2 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox3" class="md-check">
                                                                 <label for="checkbox3">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 3 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox4" class="md-check">
                                                                 <label for="checkbox4">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 4 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox5" class="md-check">
                                                                 <label for="checkbox5">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 5</label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox6" class="md-check">
                                                                 <label for="checkbox6">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 6 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox7" class="md-check">
                                                                 <label for="checkbox7">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 7 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox8" class="md-check">
                                                                 <label for="checkbox8">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 8 </label>
                                                              </div>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="page_view_all">
                                                       
                                                        <div class="menu-content form-md-checkboxes">
                                                           <div class="most_recent md-checkbox-list">
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox1" class="md-check">
                                                                 <label for="checkbox1">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 1 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox2" class="md-check" checked="">
                                                                 <label for="checkbox2">
                                                                 <span></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 2 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox3" class="md-check">
                                                                 <label for="checkbox3">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 3 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox4" class="md-check">
                                                                 <label for="checkbox4">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 4 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox5" class="md-check">
                                                                 <label for="checkbox5">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 5</label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox6" class="md-check">
                                                                 <label for="checkbox6">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 6 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox7" class="md-check">
                                                                 <label for="checkbox7">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 7 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox8" class="md-check">
                                                                 <label for="checkbox8">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 8 </label>
                                                              </div>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="page_search">
                                                       <input class="form-control spinner" type="text" placeholder="Search">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                          <a class="select-all">Select All</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                          <button type="button" class="btn default btn-sm pull-right">Add to menu</button>
                                                        </div>
                                                    </div>
                                                 </div>
                                              </div>


                                           </div>
                                        </div>
                                     </div>
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 class="panel-title">
                                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#posts" aria-expanded="false"> Posts </a>
                                           </h4>
                                        </div>
                                        <div id="posts" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                           <div class="panel-body">
                                             

                                              <div class="tabbable tabbable-tabdrop">
                                                 <ul class="nav nav-tabs">
                                                    <li class="active">
                                                       <a href="#post_most_recent" data-toggle="tab" aria-expanded="true">Most Recent</a>
                                                    </li>
                                                    <li class="">
                                                       <a href="#post_view_all" data-toggle="tab" aria-expanded="false">View All</a>
                                                    </li>
                                                    <li class="">
                                                       <a href="#post_search" data-toggle="tab" aria-expanded="false">Search</a>
                                                    </li>
                                                 </ul>
                                                 <div class="tab-content">
                                                    <div class="tab-pane active" id="post_most_recent">

                                                        <div class="menu-content form-md-checkboxes">
                                                           <div class="most_recent md-checkbox-list">
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox1" class="md-check">
                                                                 <label for="checkbox1">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 1 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox2" class="md-check" checked="">
                                                                 <label for="checkbox2">
                                                                 <span></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 2 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox3" class="md-check">
                                                                 <label for="checkbox3">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 3 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox4" class="md-check">
                                                                 <label for="checkbox4">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 4 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox5" class="md-check">
                                                                 <label for="checkbox5">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 5</label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox6" class="md-check">
                                                                 <label for="checkbox6">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 6 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox7" class="md-check">
                                                                 <label for="checkbox7">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 7 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox8" class="md-check">
                                                                 <label for="checkbox8">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 8 </label>
                                                              </div>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="post_view_all">
                                                       
                                                        <div class="menu-content form-md-checkboxes">
                                                           <div class="most_recent md-checkbox-list">
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox1" class="md-check">
                                                                 <label for="checkbox1">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 1 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox2" class="md-check" checked="">
                                                                 <label for="checkbox2">
                                                                 <span></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 2 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox3" class="md-check">
                                                                 <label for="checkbox3">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 3 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox4" class="md-check">
                                                                 <label for="checkbox4">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 4 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox5" class="md-check">
                                                                 <label for="checkbox5">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 5</label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox6" class="md-check">
                                                                 <label for="checkbox6">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 6 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox7" class="md-check">
                                                                 <label for="checkbox7">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 7 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox8" class="md-check">
                                                                 <label for="checkbox8">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 8 </label>
                                                              </div>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="post_search">
                                                       <input class="form-control spinner" type="text" placeholder="Search">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                          <a class="select-all">Select All</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                          <button type="button" class="btn default btn-sm pull-right">Add to menu</button>
                                                        </div>
                                                    </div>
                                                 </div>
                                              </div>



                                           </div>
                                        </div>
                                     </div>
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 class="panel-title">
                                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#custom_links" aria-expanded="false"> Custom Links </a>
                                           </h4>
                                        </div>
                                        <div id="custom_links" class="panel-collapse collapse" aria-expanded="false">
                                           <div class="panel-body">
                                                <div row="row">
                                                    <div clas="col-md-4"><label class="control-label">URL</label></div>
                                                    <div clas="col-md-8"><input type="text" class="form-control" placeholder="http://" value="http://"></div>
                                                </div>
                                                <div row="row">
                                                    <div clas="col-md-4"><label class="control-label">Link Text</label></div>
                                                    <div clas="col-md-8"><input type="text" class="form-control" placeholder="Menu Item"></div>
                                                </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 class="panel-title">
                                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#categories" aria-expanded="false"> Categories </a>
                                           </h4>
                                        </div>
                                        <div id="categories" class="panel-collapse collapse" aria-expanded="false">
                                           <div class="panel-body">
                                              

                                              <div class="tabbable tabbable-tabdrop">
                                                 <ul class="nav nav-tabs">
                                                    <li class="active">
                                                       <a href="#categories_most_recent" data-toggle="tab" aria-expanded="true">Most Recent</a>
                                                    </li>
                                                    <li class="">
                                                       <a href="#categories_view_all" data-toggle="tab" aria-expanded="false">View All</a>
                                                    </li>
                                                    <li class="">
                                                       <a href="#categories_search" data-toggle="tab" aria-expanded="false">Search</a>
                                                    </li>
                                                 </ul>
                                                 <div class="tab-content">
                                                    <div class="tab-pane active" id="categories_most_recent">

                                                        <div class="menu-content form-md-checkboxes">
                                                           <div class="most_recent md-checkbox-list">
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox1" class="md-check">
                                                                 <label for="checkbox1">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 1 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox2" class="md-check" checked="">
                                                                 <label for="checkbox2">
                                                                 <span></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 2 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox3" class="md-check">
                                                                 <label for="checkbox3">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 3 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox4" class="md-check">
                                                                 <label for="checkbox4">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 4 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox5" class="md-check">
                                                                 <label for="checkbox5">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 5</label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox6" class="md-check">
                                                                 <label for="checkbox6">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 6 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox7" class="md-check">
                                                                 <label for="checkbox7">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 7 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox8" class="md-check">
                                                                 <label for="checkbox8">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 8 </label>
                                                              </div>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="categories_view_all">
                                                       
                                                        <div class="menu-content form-md-checkboxes">
                                                           <div class="most_recent md-checkbox-list">
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox1" class="md-check">
                                                                 <label for="checkbox1">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 1 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox2" class="md-check" checked="">
                                                                 <label for="checkbox2">
                                                                 <span></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 2 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox3" class="md-check">
                                                                 <label for="checkbox3">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 3 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox4" class="md-check">
                                                                 <label for="checkbox4">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 4 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox5" class="md-check">
                                                                 <label for="checkbox5">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 5</label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox6" class="md-check">
                                                                 <label for="checkbox6">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 6 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox7" class="md-check">
                                                                 <label for="checkbox7">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 7 </label>
                                                              </div>
                                                              <div class="md-checkbox">
                                                                 <input type="checkbox" id="checkbox8" class="md-check">
                                                                 <label for="checkbox8">
                                                                 <span class="inc"></span>
                                                                 <span class="check"></span>
                                                                 <span class="box"></span> Option 8 </label>
                                                              </div>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="categories_search">
                                                       <input class="form-control spinner" type="text" placeholder="Search">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                          <a class="select-all">Select All</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                          <button type="button" class="btn default btn-sm pull-right">Add to menu</button>
                                                        </div>
                                                    </div>
                                                 </div>
                                              </div>

                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>




                            </div>
                            <div class="col-md-8">

                                <div class="portlet box ">
                                   <div class="portlet-title">
                                      <div class="row">
                                         <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter Menu Name Here">
                                         </div>
                                         <div class="col-md-8">
                                            <div class="btn-group pull-right">
                                               <button class="btn blue">Save Menu
                                               </button>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="portlet-body">
                                      <h4>Menu Structure</h4>
                                      Drag each item into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.
                                       <div class="dd" id="nestable_list_1">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="1">
                                                <div class="dd-handle"> Item 1 </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle"> Item 2 </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle"> Item 3 </div>
                                                    </li>
                                                    <li class="dd-item" data-id="4">
                                                        <div class="dd-handle"> Item 4 </div>
                                                    </li>
                                                    <li class="dd-item" data-id="5">
                                                        <div class="dd-handle"> Item 5 </div>
                                                        <ol class="dd-list">
                                                            <li class="dd-item" data-id="6">
                                                                <div class="dd-handle"> Item 6 </div>
                                                            </li>
                                                            <li class="dd-item" data-id="7">
                                                                <div class="dd-handle"> Item 7 </div>
                                                            </li>
                                                            <li class="dd-item" data-id="8">
                                                                <div class="dd-handle"> Item 8 </div>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                    <li class="dd-item" data-id="9">
                                                        <div class="dd-handle"> Item 9 </div>
                                                    </li>
                                                    <li class="dd-item" data-id="10">
                                                        <div class="dd-handle"> Item 10 </div>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li class="dd-item" data-id="11">
                                                <div class="dd-handle"> Item 11 </div>
                                            </li>
                                            <li class="dd-item" data-id="12">
                                                <div class="dd-handle"> Item 12 </div>
                                            </li>
                                        </ol>
                                    </div>


                                   </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
                   
@stop
@section('scripts')
<script src="{{ asset('public/assets/admin/global/plugins/jquery-nestable/jquery.nestable.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/admin/pages/scripts/ui-nestable.js') }}" type="text/javascript"></script>
@stop