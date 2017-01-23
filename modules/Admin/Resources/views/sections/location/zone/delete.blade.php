@extends('admin::layouts.master')

@section('content')

    <title>Confirmation</title>
    <style type="text/css">
        body {
            background: #f1f1f1;
            /*direction: rtl*/
        }
        #error-page {
            margin-top: 50px;
            background: #fff;
            color: #444;
            font-family: "Open Sans", sans-serif;
            margin: 2em auto;
            padding: 1em 2em;
            max-width: 700px;
            -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.13);
            box-shadow: 0 1px 3px rgba(0,0,0,0.13);
        }
        #error-page p {
            font-size: 14px;
            margin: 25px 0 20px;
        }
        .btns{
            text-align: right;
        }
        .bt{
           padding: 12px 20px;
        }
        .msg{
           padding: 10px;
        }


    </style>
    <div id="error-page">
        <form method="post" action="@if(isset($zone)){{ route('admin.zone.delete.post', $zone->id) }}@endif">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="row">
                <div class="col-md-6 msg">Are you unsure about this action?</div>
                <div class="col-md-6 btns">
                    <input type="submit" value="Yes" class="btn sbold green bt">
                    <a href="{{ route('admin.zone.get') }}" class="btn sbold red bt"> Cancel</a>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $zone->id }}">
        </form>
    </div>
@stop