@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        {{ $title }}
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Setting</a></li>
        <li class="active">{{ $title }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div id="msg" class="alert text-center" style="display:none">
                    <strong></strong>
                </div>
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/user2-160x160.jpg')}}" alt="User profile picture">

                        <h3 class="profile-username text-center text-full-name">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center"></p>

                        <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b class="text-full-name">Full Name</b> <a class="pull-right" id="full-name" onclick="showInputFullname()">{{ Auth::user()->name }}</a>
                            <div class="input-group input-group-sm" id="full-name-input" style="display:none">
                                <input type="text" class="form-control" placeholder="Full Name" value="{{ Auth::user()->name }}">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat" id="btnok-submit-fullname"><i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-danger btn-flat" id="btncancel-submit-fullname"><i class="fa fa-times"></i></button>
                                </span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>User ID</b> <a class="pull-right">{{ Auth::user()->userid }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right" id="email">{{ Auth::user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Change Password</b> <a class="pull-right" id="password" onclick="showInputPassword()">Click Here</a>
                            <div class="form-group password-input" style="display:none">
                                <input type="password" id="password_old" class="form-control input-sm" autocomplete="off" placeholder="Old Password">
                            </div>
                            <div class="form-group password-input" style="display:none">
                                <input type="password" id="password_now" class="form-control input-sm" autocomplete="off" placeholder="New Password">
                            </div>
                            <div class="input-group input-group-sm password-input" style="display:none">
                                <input type="password" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat" id="btnok-submit-password"><i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-danger btn-flat" id="btncancel-submit-password"><i class="fa fa-times"></i></button>
                                </span>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            // btn full name
            $('#btnok-submit-fullname').click(function() {
                $.ajax({
                    url: '/setting/profile/full-name-save-edit',
                    type: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        fullname: $('#full-name-input input').val()
                    },
                    error: function(datas, status, c) {
                        $('#msg').addClass('alert-'+datas.responseJSON.type);
                        $('#msg').removeClass('alert-success');
                        $('#msg strong').text(datas.responseJSON.msg);
                        $('#msg').show();
                    },
                    success: function(datas, status,c) {
                        $('#msg').removeClass('alert-danger');
                        $('#msg').addClass('alert-success');
                        $('#msg strong').text(datas.msg);
                        $('#msg').show();
                        $('.text-full-name').text($('#full-name-input input').val());
                        $('#full-name-input').hide();
                        $('#full-name').show();

                    }
                })
            });

            $('#btnok-submit-password').click(function() {
                $.ajax({
                    url: '/setting/profile/change-password-save',
                    type: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        password: $('#password_now').val(),
                        password_confirmation: $('#password_confirmation').val(),
                        password_old: $('#password_old').val(),
                    },
                    error: function(datas, status, c) {
                        $('#msg').addClass('alert-'+datas.responseJSON.type);
                        $('#msg').removeClass('alert-success');
                        $('#msg strong').text(datas.responseJSON.msg);
                        $('#msg').show();
                    },
                    success: function(datas, status,c) {
                        $('#msg').removeClass('alert-danger');
                        $('#msg').addClass('alert-success');
                        $('#msg strong').text(datas.msg);
                        $('#msg').show();
                        $('.text-full-name').text($('#full-name-input input').val());
                        $('#full-name-input').hide();
                        $('#full-name').show();

                    }
                })
            });

            $('#btncancel-submit-fullname').click(function(){
                $('#full-name-input').hide();
                $('#full-name').show();
            });

            $('#btncancel-submit-password').click(function(){
                $('.password-input').hide();
                $('#password').show();
            });
        });

        function showInputFullname() {
            $('#full-name').hide();
            $('#full-name-input').show();
            $('#full-name-input input').focus();
        }

        function showInputPassword() {
            $('#password').hide();
            $('.password-input').show();
            $('#password-input input').focus();
        }

    </script>
@endsection
