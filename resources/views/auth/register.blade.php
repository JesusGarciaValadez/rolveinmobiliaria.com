@extends('layouts.app')

@section('title', 'Registrar un nuevo usuario')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">@lang('auth.register_a_new_user')</div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">@lang('auth.name')</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">@lang('auth.email_address')</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">@lang('auth.choose_a_user_role')</label>

              <div class="col-md-6">
                <!--input id="name" type="text" class="form-control" name="role_id" value="{{ old('role_id') }}" required autofocus-->
                <select id="role" name="role_id" class="form-control form-control-sm">
                  <option value="" selected>@lang('auth.choose_a_user_role')</option>
                  @foreach ($roles as $role)
                  @break($role->name === 'Super Administrador')
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                  @endforeach
                </select>

                @if ($errors->has('role_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('role_id') }}</strong>
                  </span>
                @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">@lang('auth.password')</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">@lang('auth.confirm_password')</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    @lang('auth.register')
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
