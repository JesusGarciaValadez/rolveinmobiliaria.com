@extends('layouts.app')

@section('title', __('shared.edit')." | ".__('section.message'))

@section('content')
<div class="container-fluid">
  <div class="row">
    @lateralMenu(['uri' => $uri])
    @endlateralMenu

    <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
      <div class="panel panel-default">
        @panelHeading( [
          'route' => route('messages'),
          'routeTitle' => __('section.messages'),
        ])
          @slot('title')
            @lang('shared.edit') @lang('message.message')
          @endslot
        @endpanelHeading

        <div class="panel-body table-responsive" id="message-info">
          @alert(['type' => session('type'), 'message' => session('message')])
          @endalert

          <form
            class="form-horizontal"
            action="{{ route('update_message', ['id' => request('id')]) }}"
            method="post">
            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" value="{{ $message->user->id }}">

            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
              <label
                for="name"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('message.name'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  value="{{ old('name') ? old('name') : $message->name }}"
                  placeholder="@lang('message.name')"
                  required
                  autocorrect="on">

                  @if ($errors->has('name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
              <label
                for="email"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('message.email'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  value="{{ old('email') ? old('email') : $message->email }}"
                  placeholder="@lang('message.email')"
                  required
                  autocorrect="on">

                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('observations') ? ' has-error' : ''}}">
              <label
                for="observations"
                class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">@lang('message.observations'): </label>
              <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 control-label">
                <textarea
                  class="form-control"
                  name="observations"
                  id="observations"
                  placeholder="@lang('message.observations')"
                  rows="8"
                  autocorrect="on">{{ old('observations') ? old('observations') : $message->observations }}</textarea>

                  @if ($errors->has('observations'))
                    <span class="help-block">
                      <strong>{{ $errors->first('observations') }}</strong>
                    </span>
                  @endif
              </div>
            </div>

            <div class="form-inline">
              @messagesButtonSave
              @endmessagesButtonSave

              @messagesButtonBack
              @endmessagesButtonBack
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
