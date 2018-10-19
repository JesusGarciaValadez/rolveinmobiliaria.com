<?php

namespace App\Http\Controllers\Api;

use App\InternalExpedient;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;

use App\Http\Requests\InternalExpedientRequest;
use Carbon\Carbon;

class InternalExpedientController extends Controller
{
  use ThrottlesLogins;

  /**
   * Display the specified resource.
   *
   * @param  \App\InternalExpedient  $internalExpedient
   * @return \Illuminate\Http\Response
   */
  public function show(InternalExpedient $internalExpedient, Request $request)
  {
    if ($request->ajax())
    {
      return response()->json([$internalExpedient]);
    }
    else
    {
      return abort(404);
    }
  }
}
