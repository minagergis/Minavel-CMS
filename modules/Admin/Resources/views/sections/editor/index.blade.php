@extends('admin::layouts.master')

@section('styles')
<link href="{{ asset('public/assets/admin/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
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
                                        <span class="caption-subject bold uppercase"> Editor</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <form name="template" id="template" action="" method="post">
                                                <div>
                                                    <textarea cols="70" rows="30" name="newcontent" id="newcontent" style="font-family: Consolas,Monaco,monospace;font-size: 13px;width: 97%;outline: 0;"></textarea>
                                                    <input type="hidden" name="action" value="update">
                                                    <input type="hidden" name="file" value="style.css">
                                                    <input type="hidden" name="theme" value="cig">
                                                    <input type="hidden" name="scrollto" id="scrollto" value="0">
                                                </div>
                                                
                                                <div>
                                                    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Update File"></p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4">

                                            <h2>Templates</h2>
                                            <div id="tree_1" class="tree-demo jstree jstree-1 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_1" aria-busy="false">
                                               <ul class="jstree-container-ul jstree-children" role="group">
                                                  <li role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="j1_1_anchor" aria-expanded="true" id="j1_1" class="jstree-node  jstree-open">
                                                     <i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_1_anchor"><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i> Root node 1
                                                     </a>
                                                     <ul role="group" class="jstree-children">
                                                        <li role="treeitem" data-jstree="{ &quot;selected&quot; : true }" aria-selected="true" aria-level="2" aria-labelledby="j1_2_anchor" id="j1_2" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-clicked" href="javascript:;" tabindex="-1" id="j1_2_anchor"><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i> Initially selected </a></li>
                                                        <li role="treeitem" data-jstree="{ &quot;icon&quot; : &quot;fa fa-briefcase icon-state-success &quot; }" aria-selected="false" aria-level="2" aria-labelledby="j1_3_anchor" id="j1_3" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_3_anchor"><i class="jstree-icon jstree-themeicon fa fa-briefcase icon-state-success  jstree-themeicon-custom" role="presentation"></i> custom icon URL </a></li>
                                                        <li role="treeitem" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="j1_4_anchor" aria-expanded="true" id="j1_4" class="jstree-node  jstree-open">
                                                           <i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_4_anchor"><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i> initially open
                                                           </a>
                                                           <ul role="group" class="jstree-children">
                                                              <li role="treeitem" data-jstree="{ &quot;disabled&quot; : true }" aria-selected="false" aria-level="3" aria-labelledby="j1_5_anchor" aria-disabled="true" id="j1_5" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor  jstree-disabled" href="#" tabindex="-1" id="j1_5_anchor"><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i> Disabled Node </a></li>
                                                              <li role="treeitem" data-jstree="{ &quot;type&quot; : &quot;file&quot; }" aria-selected="false" aria-level="3" aria-labelledby="j1_6_anchor" id="j1_6" class="jstree-node  jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_6_anchor"><i class="jstree-icon jstree-themeicon fa fa-file icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i> Another node </a></li>
                                                           </ul>
                                                        </li>
                                                        <li role="treeitem" data-jstree="{ &quot;icon&quot; : &quot;fa fa-warning icon-state-danger&quot; }" aria-selected="false" aria-level="2" aria-labelledby="j1_7_anchor" id="j1_7" class="jstree-node  jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_7_anchor"><i class="jstree-icon jstree-themeicon fa fa-warning icon-state-danger jstree-themeicon-custom" role="presentation"></i> Custom icon class (bootstrap) </a></li>
                                                     </ul>
                                                  </li>
                                                  <li role="treeitem" data-jstree="{ &quot;type&quot; : &quot;file&quot; }" aria-selected="false" aria-level="1" aria-labelledby="j1_8_anchor" id="j1_8" class="jstree-node  jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="http://www.jstree.com" tabindex="-1" id="j1_8_anchor"><i class="jstree-icon jstree-themeicon fa fa-file icon-state-warning icon-lg jstree-themeicon-custom" role="presentation"></i> Clickanle link node </a></li>
                                               </ul>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->

@stop
@section('scripts')
<script src="{{ asset('public/assets/admin/global/plugins/jstree/dist/jstree.min.jS') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/admin/pages/scripts/ui-tree.min.js') }}" type="text/javascript"></script>

@stop