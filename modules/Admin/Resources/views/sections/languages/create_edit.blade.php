@extends('admin::layouts.master')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/dist/css/bootstrap-formhelpers.min.css') }}"/>
@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">@if(isset($language)) Edit {{$language->name}} @else Add New Language @endif</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="@if(isset($language)){{ route('admin.languages.edit.post', $language->id) }} @else {{ route('admin.languages.add.post') }} @endif">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               
                        <div class="row">
                            <div class="col-md-5">

                                {{--<div class="form-group {{ $errors->has('lang_list') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="lang_list">Choose a language</label>
                                        <select name="lang_list" id="lang_list"class="form-control" >
                                           <option value="" hidden>Choose a language..</option> <option value="af-af-0-za">Afrikaans - af</option> <option value="ar-ar-1-arab">العربية - ar</option> <option value="ar-ary-1-ma">العربية المغربية - ary</option> <option value="az-az-0-az">Azərbaycan - az</option> <option value="be-bel-0-by">Беларуская мова - bel</option> <option value="bg-bg_BG-0-bg">български - bg_BG</option> <option value="bn-bn_BD-0-bd">বাংলা - bn_BD</option> <option value="bs-bs_BA-0-ba">Bosanski - bs_BA</option> <option value="ca-ca-0-catalonia">Català - ca</option> <option value="cs-cs_CZ-0-cz">Čeština - cs_CZ</option> <option value="cy-cy-0-wales">Cymraeg - cy</option> <option value="da-da_DK-0-dk">Dansk - da_DK</option> <option value="de-de_CH-0-ch">Deutsch - de_CH</option> <option value="de-de_DE-0-de">Deutsch - de_DE</option> <option value="de-de_DE_formal-0-de">Deutsch - de_DE_formal</option> <option value="el-el-0-gr">Ελληνικά - el</option> <option value="en-en_AU-0-au">English - en_AU</option> <option value="en-en_CA-0-ca">English - en_CA</option> <option value="en-en_GB-0-gb">English - en_GB</option> <option value="en-en_NZ-0-nz">English - en_NZ</option> <option value="en-en_US-0-us">English - en_US</option> <option value="en-en_ZA-0-za">English - en_ZA</option> <option value="eo-eo-0-esperanto">Esperanto - eo</option> <option value="es-es_AR-0-ar">Español - es_AR</option> <option value="es-es_CL-0-cl">Español - es_CL</option> <option value="es-es_CO-0-co">Español - es_CO</option> <option value="es-es_ES-0-es">Español - es_ES</option> <option value="es-es_MX-0-mx">Español - es_MX</option> <option value="es-es_PE-0-pe">Español - es_PE</option> <option value="es-es_VE-0-ve">Español - es_VE</option> <option value="et-et-0-ee">Eesti - et</option> <option value="eu-eu-0-basque">Euskara - eu</option> <option value="fa-fa_AF-1-af">فارسی - fa_AF</option> <option value="fa-fa_IR-1-ir">فارسی - fa_IR</option> <option value="fi-fi-0-fi">Suomi - fi</option> <option value="fo-fo-0-fo">Føroyskt - fo</option> <option value="fr-fr_BE-0-be">Français - fr_BE</option> <option value="fr-fr_CA-0-quebec">Français - fr_CA</option> <option value="fr-fr_FR-0-fr">Français - fr_FR</option> <option value="fy-fy-0-nl">Frysk - fy</option> <option value="gd-gd-0-scotland">Gàidhlig - gd</option> <option value="gl-gl_ES-0-galicia">Galego - gl_ES</option> <option value="haz-haz-1-af">هزاره گی - haz</option> <option value="he-he_IL-1-il">עברית - he_IL</option> <option value="hi-hi_IN-0-in">हिन्दी - hi_IN</option> <option value="hr-hr-0-hr">Hrvatski - hr</option> <option value="hu-hu_HU-0-hu">Magyar - hu_HU</option> <option value="hy-hy-0-am">Հայերեն - hy</option> <option value="id-id_ID-0-id">Bahasa Indonesia - id_ID</option> <option value="is-is_IS-0-is">Íslenska - is_IS</option> <option value="it-it_IT-0-it">Italiano - it_IT</option> <option value="ja-ja-0-jp">日本語 - ja</option> <option value="jv-jv_ID-0-id">Basa Jawa - jv_ID</option> <option value="ka-ka_GE-0-ge">ქართული - ka_GE</option> <option value="kk-kk-0-kz">Қазақ тілі - kk</option> <option value="ko-ko_KR-0-kr">한국어 - ko_KR</option> <option value="ku-ckb-1-kurdistan">کوردی - ckb</option> <option value="lo-lo-0-la">ພາສາລາວ - lo</option> <option value="lt-lt_LT-0-lt">Lietuviškai - lt_LT</option> <option value="lv-lv-0-lv">Latviešu valoda - lv</option> <option value="mk-mk_MK-0-mk">македонски јазик - mk_MK</option> <option value="mn-mn-0-mn">Монгол хэл - mn</option> <option value="ms-ms_MY-0-my">Bahasa Melayu - ms_MY</option> <option value="my-my_MM-0-mm">ဗမာစာ - my_MM</option> <option value="nb-nb_NO-0-no">Norsk Bokmål - nb_NO</option> <option value="ne-ne_NP-0-np">नेपाली - ne_NP</option> <option value="nl-nl_NL-0-nl">Nederlands - nl_NL</option> <option value="nn-nn_NO-0-no">Norsk Nynorsk - nn_NO</option> <option value="oc-oci-0-occitania">Occitan - oci</option> <option value="pl-pl_PL-0-pl">Polski - pl_PL</option> <option value="ps-ps-1-af">پښتو - ps</option> <option value="pt-pt_BR-0-br">Português - pt_BR</option> <option value="pt-pt_PT-0-pt">Português - pt_PT</option> <option value="ro-ro_RO-0-ro">Română - ro_RO</option> <option value="ru-ru_RU-0-ru">Русский - ru_RU</option> <option value="si-si_LK-0-lk">සිංහල - si_LK</option> <option value="sk-sk_SK-0-sk">Slovenčina - sk_SK</option> <option value="sl-sl_SI-0-si">Slovenščina - sl_SI</option> <option value="so-so_SO-0-so">Af-Soomaali - so_SO</option> <option value="sq-sq-0-al">Shqip - sq</option> <option value="sr-sr_RS-0-rs">Српски језик - sr_RS</option> <option value="su-su_ID-0-id">Basa Sunda - su_ID</option> <option value="sv-sv_SE-0-se">Svenska - sv_SE</option> <option value="ta-ta_LK-0-lk">தமிழ் - ta_LK</option> <option value="th-th-0-th">ไทย - th</option> <option value="tl-tl-0-ph">Tagalog - tl</option> <option value="tr-tr_TR-0-tr">Türkçe - tr_TR</option> <option value="ug-ug_CN-0-cn">Uyƣurqə - ug_CN</option> <option value="uk-uk-0-ua">Українська - uk</option> <option value="ur-ur-1-pk">اردو - ur</option> <option value="uz-uz_UZ-0-uz">Oʻzbek - uz_UZ</option> <option value="vec-vec-0-veneto">Vèneto - vec</option> <option value="vi-vi-0-vn">Tiếng Việt - vi</option> <option value="zh-zh_CN-0-cn">中文 (中国) - zh_CN</option> <option value="zh-zh_HK-0-hk">中文 (香港) - zh_HK</option> <option value="zh-zh_TW-0-tw">中文 (台灣) - zh_TW</option>
                                        </select>
                                        You can choose a language in the list or directly edit it below.
                                        @if ($errors->has('lang_list'))
                                            <span class="help-block">{{ $errors->first('lang_list') }}</span>
                                        @endif
                                    </div>
                                </div>--}}
                                
                                <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="full_name">Full name</label>
                                        <input type="text" name="full_name" id="full_name" class="form-control" maxlength="255" placeholder="Full Name" required value="@if(isset($language)){{trim($language->name)}}@else{{old('full_name')}}@endif">
                                        The name is how it is displayed on your site (for example: English).
                                        @if ($errors->has('full_name'))
                                            <span class="help-block">{{ $errors->first('full_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('locale') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="locale">Locale</label>
                                        <input type="text" name="locale" id="locale" class="form-control" maxlength="255" placeholder="Locale" required value="@if(isset($language)){{trim($language->locale)}}@else{{old('locale')}}@endif">
                                        Locale for the language (for example: en). 
                                        @if ($errors->has('locale'))
                                            <span class="help-block">{{ $errors->first('locale') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{--<div class="form-group {{ $errors->has('language_code') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="language_code">Language code</label>
                                        <input type="text" name="language_code" id="language_code" class="form-control" maxlength="255" placeholder="Language code" required value="@if(isset($language)){{trim($language->language_code)}}@else{{old('language_code')}}@endif">
                                        Language code - preferably 2-letters ISO 639-1 (for example: en)
                                        @if ($errors->has('language_code'))
                                            <span class="help-block">{{ $errors->first('language_code') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('language_code') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="">Text direction</label>
                                           <div class="md-radio-list">
                                              <div class="md-radio">
                                                 <input type="radio" id="ltr" name="direction" class="md-radiobtn">
                                                 <label for="ltr">
                                                 <span class="inc"></span>
                                                 <span class="check"></span>
                                                 <span class="box"></span>left to right</label>
                                              </div>
                                              <div class="md-radio">
                                                 <input type="radio" id="rtl" name="direction" class="md-radiobtn">
                                                 <label for="rtl">
                                                 <span class="inc"></span>
                                                 <span class="check"></span>
                                                 <span class="box"></span>right to left</label>
                                              </div>
                                           </div>
                                        Choose the text direction for the language
                                        @if ($errors->has('language_code'))
                                            <span class="help-block">{{ $errors->first('language_code') }}</span>
                                        @endif
                                    </div>
                                </div>--}}


                                <div class="form-group {{ $errors->has('flag') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="flag">Flag</label>
                                        <div class="bfh-selectbox bfh-countries" data-name="flag" @if(isset($language)) data-country="{{$language->icon}}" @endif data-flags="true"></div>
                                        Choose a flag for the language.
                                        @if ($errors->has('flag'))
                                            <span class="help-block">{{ $errors->first('flag') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{--
                                <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="order">Order</label>
                                        <input type="text" name="order" id="order" class="form-control" maxlength="255" placeholder="0" required value="@if(isset($language)){{trim($language->order)}}@else{{old('order')}}@endif">
                                        Position of the language in the language switcher
                                        @if ($errors->has('order'))
                                            <span class="help-block">{{ $errors->first('order') }}</span>
                                        @endif
                                    </div>
                                </div>--}}

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn blue" value="@if(isset($language)) Edit @else Add New Language @endif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">

                                <div class="portlet box green">
                                   <div class="portlet-title">
                                      <div class="caption">
                                         <i class="fa fa-globe"></i>Languages 
                                      </div>
                                      <div class="tools">
                                         <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                         <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                      </div>
                                   </div>
                                   <div class="portlet-body">
                                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
                                          <thead>
                                              <tr>
                                                  <th>Name</th>
                                                  <th>Locale</th>
                                                  <th>Flag</th>
                                                  <th>Action</tDh>
                                              </tr>
                                          </thead>
                                      </table>
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

    <script src="{{ asset('public/assets/admin/global/scripts/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/dist/js/bootstrap-formhelpers.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/js/bootstrap-formhelpers-selectbox.js') }}"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/js/bootstrap-formhelpers-countries.js') }}"></script>


    <script type="text/javascript">
        $(function () {

            var oTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.languages.data.get') }}",
                },
                columns: [

                    {data: 'name', name: 'languages.name'},
                    {data: 'locale', name: 'languages.locale'},
                    {data: 'icon', name: 'languages.icon'},
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