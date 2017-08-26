@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="padding-top:50px;">
                <div class="panel panel-default panel-profile m-b-md">
                    <div class="panel-body text-center">

                        <img data-action="zoom" class="panel-profile-img" src="{{ $user_image  }}">

                        <h5 class="panel-title">
                            <span class="text-inherit" style="font-size: 30px;">{{ $user_name  }}</span>
                        </h5>
                        <div id="Container" class="text-center">
                            <div>
                                <br>
                                <p style="font-size: 26px;color: green;">اجعل رسالتك بناءة :)</p>
                            </div>

                            <form class="form-horizontal" autocomplete="off" method="post" action="{{ Request::url() }}">

                                <input id="UserId" value="{{ $userId  }}" type="hidden">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="TextContainer" class="textarea-container">
                                            <textarea autocomplete="off" rows="5" class="form-control remove-border" style="background:none;" id="Text" name="Text"></textarea>
                                        </div>
                                        <button id="Send" class="btn btn-primary-outline" type="submit" onclick="SendMessage()" style="margin-top:10px" data-loading-text="إنتظار...">
                                            <span class="icon icon-pencil"></span> صارح</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
