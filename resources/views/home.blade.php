@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="col-md-12">


                <div class="col-md-8">
                    <ul class="list-group media-list media-list-stream">
                        <li class="text-center media list-group-item p-a"><span style="font-size:x-large"
                                                                                class="fa fa-comments"></span>&nbsp;&nbsp;<span
                                    style="font-size:x-large">الرسائل</span></li>


                        @if($messagesCount <= 0)
                            <li id="Message00" class="media list-group-item p-a" style="font-size: 18px;">
                                ليست لديك اي رسائل . لكي تستقبل الرسائل و الانتقادات من اصدقائك :
                                <br>
                            </li>
                        @else
                            @foreach($messages as $message)
                                <li class="media list-group-item p-a">
                                    <a class="pull-right" href="# ">
                                        <img class="media-object img-circle " src="{{ url('img/anonym.png')  }}" style="margin-top: -8px;margin-right: -7px; height: 55px;">
                                    </a>
                                    <div class="media-body" style="    text-align: right;">
                                        <a href="{{ url('message/delete' , $message->id) }}" >
                                            <img style="padding-bottom:5px;width: 37px;" class="pull-left" src="{{ url('img/remove1.png') }}">
                                        </a>
                                        <span style="white-space:pre-wrap;">{{ $message->content  }}</span><br><small class="text-muted" data-utcdate="2017-08-26 15:33:32">{{ Carbon\Carbon::parse($message->created_at)->format('d-m-Y')  }}</small>
                                    </div>
                                </li>
                            @endforeach
                        @endif



                    </ul>
                </div>


                <div class="col-md-4">
                    <div class="panel panel-default panel-profile m-b-md">

                        <div class="panel-body text-center">

                            <img data-toggle="modal" data-target="#myModal" class="panel-profile-img"
                                 style="cursor: pointer  height: 260px; width: 260px;"
                                 src="{{ $userImage }}">

                            <h5 class="panel-title">
                                <span class="text-inherit"><span data-toggle="modal" data-target="#myModal"
                                                                 style="font-size:medium;color: blue;cursor:pointer;"
                                                                 class="icon icon-cog"> </span><h3>{{ $user->name }}</h3></span>
                            </h5>
                                    <h4>
                                        عدد الرسائل :
                                        {{ $messagesCount }}
                                    </h4>




                            <span class="text-inherit" style="font-weight:bold"><a href="{{ url('u',$user->name) }}">{{ url('u',$user->name) }}</a></span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


        <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="text-align: right;" class="modal-title">تغيير الصورة الشخصية</h4>
                </div>
                <div class="modal-body" style="text-align: right;">
                    <form method="post" action="{{ url('profileImageUpload')  }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleFormControlFile1">أختر صورة لرفعها</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">رفع</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">أغلاق</button>
                </div>
            </div>

        </div>
    </div>