<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ThrottlesLogins;

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client, Request $request)
    {
        if ($request->ajax()) {
            return response()->json([$client]);
        }

        return abort(404);
    }
}
