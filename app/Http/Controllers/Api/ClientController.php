<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Client;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientFilterRequest;

class ClientController extends Controller
{
  use ThrottlesLogins;

  /**
   * Display the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function show(Client $client, Request $request)
  {
    if ($request->ajax())
    {
      return response()->json([$client]);
    }
    else
    {
      return abort(404);
    }
  }
}
