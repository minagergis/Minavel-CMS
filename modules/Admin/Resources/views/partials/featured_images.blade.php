
<div class="portlet box green-meadow featured_image">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-picture-o"></i>Featured Image
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body feat">
        <div class="row">
            <div class="col-md-12 main_featured_img">
                @if(isset($post) && $post->post_have_thumbnail())
                    <a class="load_img_modal" data-target=".main_featured_img">
                        <img class="img-responsive" src="{{ asset('public/uploads/medium/' . $post->media->guid)  }}">
                    </a>
                @endif
            </div>
            <input type="hidden" name="media_id" id="media_id" value="{{ isset($post) ? $post->media_id : '' }}">
            <div class="col-md-12">
                <a class="btn  btn-outline sbold load_img_modal" data-target=".main_featured_img">Set featured image</a>
            </div>
        </div>
    </div>
</div>

<div class="multiple_media_section">
    @if(isset($multiple_media) && count($multiple_media) > 0)
        @foreach($multiple_media as $key => $item)
            <div class="portlet box green-meadow featured_image">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-picture-o"></i>Featured Image {{ $key + 1 }}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body feat">
                    <div class="row">
                        <div class="col-md-12 xx multiple_featured_img{{ $key + 1 }}">
                            <a class="load_img_modal" data-target=".multiple_featured_img{{ $key + 1 }}">
                                <img class="img-responsive" src="{{ asset('public/uploads/medium/' . $item->guid)  }}">
                            </a>

                        </div>
                        <input type="hidden" name="multiple_media_id[]" value="{{ $item->media_id }}">
                        <div class="col-md-12">
                            <a class="btn  btn-outline sbold load_img_modal" data-target=".multiple_featured_img{{ $key }}">Set
                                featured image</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"><a class="add_featured_img"><i class="fa fa-plus"></i></a></div>
                        @if($key > 0)
                            <div class="col-md-6 right"><a class="remove_featured_img"><i class="fa fa-minus"></i></a></div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="portlet box green-meadow featured_image">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o"></i>Featured Image 1
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body feat">
                <div class="row">
                    <div class="col-md-12 multiple_featured_img1">
                    </div>
                    <input type="hidden" name="multiple_media_id[]" value="">
                    <div class="col-md-12">
                        <a class="btn  btn-outline sbold load_img_modal" data-target=".multiple_featured_img1">Set
                            featured image</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6"><a class="add_featured_img"><i class="fa fa-plus"></i></a></div>
                </div>
            </div>
        </div>
    @endif
</div>
</form>
<!-- // End of main Form -->

<div class="modal fade" id="modal_media" tabindex="-1" role="dialog" aria-text="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-text="true"></button>--}}
            {{--</div>--}}
            <div class="modal-body">

                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_media" data-toggle="tab" aria-expanded="false">Media</a>
                        </li>
                        <li class="">
                            <a href="#tab_add_media" data-toggle="tab" aria-expanded="true">Add new Media</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_media">
                          <div class="row">
                              <div class="col-md-9">
                                  <div class="images_area">
                                      @if(isset($post) && $post->post_have_thumbnail())
                                          <div class="col-md-3">
                                              <a class="thumbnail select_media active" data-id="{{ $post->media->id }}"
                                                 data-image="{{ $post->media->guid }}">
                                                  <span><i class="fa fa-check"></i></span>
                                                  <img src="{{ asset('public/uploads/medium/' . $post->media->guid) }}">
                                              </a>
                                          </div>
                                      @endif

                                      <?php
                                      $media = \Modules\Admin\Models\Media::orderby('id', 'DESC')->take(15)->get();
                                      $lastID = 0;
                                      ?>

                                      @foreach($media as $item)
                                          <div class="col-md-3">
                                              <a class="thumbnail select_media" data-id="{{ $item->id }}" data-image="{{ $item->guid }}">
                                                  <span><i class="fa fa-check"></i></span>
                                                  <img src="{{ asset('public/uploads/medium/' . $item->guid) }}">
                                              </a>
                                          </div>
                                          <?php $lastID = $item->id; ?>
                                      @endforeach

                                  </div>

                                  <div class="text-center">
                                      <br>
                                      <a class="btn btn-primary load_more_media" lastID= {{ $lastID }}>
                                          load more
                                          <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw hide"></i>
                                      </a>
                                  </div>
                              </div>

                              <div class="col-md-3">

                              </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_add_media">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.media.add.post') }}" class="dropzone dropzone-file-area"
                                          id="my-dropzone" style="margin-top: 10px;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <h3 class="sbold">Drop files here or click to upload</h3>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green set_featured_img">Set featured image</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



    <script src="{{ asset('public/assets/admin/global/plugins/dropzone/dropzone.min.js') }}"
    type="text/javascript"></script>
{{--<script src="{{ asset('public/assets/admin/pages/scripts/form-dropzone.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('public/assets/admin/pages/scripts/date.format.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    var thumbPath = "{{ asset('public/uploads/thumbnail') }}/";
    var FormDropzone = function () {

        return {
            //main function to initiate the module
            init: function () {

                Dropzone.options.myDropzone = {
                    dictDefaultMessage: "",
                    init: function () {

                        this.on("success", function (file, responseText) {
                            console.log(responseText.guid);
                            $('.media').prepend('<div class="col-md-2 col-sm-2 col-xs-3"><a data-toggle="modal" data-number="' + responseText.number + '" href="#media-full" class="media-data"><img class="img-responsive" src="' + thumbPath + responseText.guid + '" /></a></div>')
                            $('#modal_media .modal-body .images_area').prepend('<div class="col-md-3"><a class="thumbnail select_media" data-id="' + responseText.number + '"><span href="#"><i class="fa fa-check"></i></span><img src="' + thumbPath + responseText.guid + '"></a></div>');
                        });
                    }
                }
            }
        };
    }();


    $(document).ready(function () {
        FormDropzone.init();

        $('body').on('click', '.load_more_media', function () {
            var lastID = $(this).attr('lastID')

            if (lastID <= 1) {
                $(this).hide();
                return;
            }

            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('admin.media.more.post') }}",
                data: 'lastID=' + lastID,
                beforeSend: function () {
                    $('.load_more_media .fa').removeClass('hide');
                },
                success: function (data) {
                    if (data.success) {
                        $('#modal_media .modal-body .images_area').append(data.media_html);
                        $('.load_more_media').attr('lastID', data.lastIDNew);
                    } else {

                    }
                    $('.load_more_media .fa').addClass('hide');
                }
            });

        });

        var media_id = "{{ isset($post) && $post->post_have_thumbnail() ? $post->media->id : '' }}";
        var media_src = "{{ isset($post) && $post->post_have_thumbnail() ? asset('public/uploads/medium/' .$post->media->guid) : '' }}";
        var target = '';
        $('body').on('click', '.load_img_modal', function () {
            target = $(this).attr('data-target');
            $('#modal_media').modal('show');
        })

        $('body').on('click', '#modal_media .select_media', function () {
            $('#modal_media .select_media').removeClass('active');
            $(this).addClass('active');

            media_id = $(this).attr('data-id');
            media_src = $(this).find('img').attr('src');
        });

        $('body').on('click', '.set_featured_img', function () {
            var i = $('.featured_image').length;
            if (media_id != '' && media_src != '') {
                $(target).html('<a class="load_img_modal" data-target=".multiple_featured_img'+ i +'"><img class="img-responsive" src="' + media_src + '"></a>');
                $(target).parent().parent().find('input').val(media_id);
                $('#modal_media').modal('hide');
            }
        });


        $('body').on('click', '.add_featured_img', function () {

            var i = $('.featured_image').length;

            var html = '<div class="portlet box green-meadow featured_image"><div class="portlet-title"><div class="caption"><i class="fa fa-picture-o"></i>';

            html += 'Featured Image '+ i +'</div><div class="tools"><a href="javascript:" class="collapse" data-original-title="" title=""></a>';
            html += '<a href="javascript:" class="reload" data-original-title="" title=""> </a></div></div><div class="portlet-body feat"><div class="row">';

            html += '</a><div class="col-md-12 multiple_featured_img'+ i +'"></div><input type="hidden" name="multiple_media_id[]" value=""><div class="col-md-12">';

            html += '<a class="btn btn-outline sbold load_img_modal" data-target=".multiple_featured_img'+ i +'">Set featured image</a></div></div><div class="row">';
            html += '<div class="col-md-6"><a class="add_featured_img"><i class="fa fa-plus"></i></a></div><div class="col-md-6 right"><a class="remove_featured_img"><i class="fa fa-minus"></i></a></div></div></div></div>';

            $('.multiple_media_section').append(html)
        });

        $('body').on('click', '.remove_featured_img', function () {
            var i = $('.featured_image').length;

            if(i > 2) {
                $(this).parent().parent().parent().parent().remove();
            }
        });

    });
</script>