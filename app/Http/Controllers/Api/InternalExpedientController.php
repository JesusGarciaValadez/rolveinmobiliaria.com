<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\InternalExpedient;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class InternalExpedientController extends Controller
{
    use ThrottlesLogins;

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(InternalExpedient $internalExpedient, Request $request)
    {
        if ($request->ajax()) {
            return response()->json([$internalExpedient]);
        }

        return abort(404);
    }
}
