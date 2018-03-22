<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientFilterRequest;

class ClientController extends Controller
{
  use ThrottlesLogins;

  private $_uri = 'clients';
  private $_locale;

  public function __constructor()
  {
    $this->_locale = \App::getLocale();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $clients = Client::orderBy('first_name', 'asc')
      ->orderBy('last_name', 'asc')
      ->paginate(5);

    return view('clients.index')
            ->withClients($clients)
            ->withUri($this->_uri);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $clients = Client::all()
      ->sortBy('last_name');

    return view('clients.create')
            ->withClients($clients)
            ->withUri($this->_uri);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ClientRequest $request)
  {
    $data = $request->all();
    $data['first_name'] = ucwords(strtolower($data['first_name']));
    $data['last_name'] = ucwords(strtolower($data['last_name']));
    $data['user_id'] = \Auth::id();
    unset($data['_token']);

    $isRepeated = DB::table('clients')
                    ->where('first_name', $data['first_name'])
                    ->where('last_name', $data['last_name'])
                    ->whereNull('deleted_at')
                    ->get()
                    ->count();

    if ($isRepeated !== 0)
    {
      return redirect()
              ->back()
              ->with('message', 'No se guardó este cliente porque ya existe en nuestros registros.')
              ->with('type', 'warning');
    }

    $updated = Client::create($data);

    $message = ($updated)
               ? 'Nuevo cliente creado'
               : 'No se pudo agregar el cliente.';

    $type = ($updated)
            ? 'success'
            : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $message]);
    }
    else
    {
      if ($type === 'success')
      {
        return redirect(route('clients'))
                ->withMessage($message)
                ->withType($type);
      }
      else {
        return redirect()
                ->back()
                ->withMessage($message)
                ->withType($type);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    $client = Client::findOrFail($request->id);

    if ($request->ajax())
    {
      return response()->json([$client]);
    }
    else
    {
      return view('clients.show')
              ->withClient($client)
              ->withUri($this->_uri);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    $client = Client::findOrFail($request->id);

    return view('clients.edit')
            ->withClient($client)
            ->withUri($this->_uri);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function update(ClientRequest $request)
  {
    $data = $request->all();
    unset($data['_token']);
    $data['first_name'] = ucwords(strtolower($data['first_name']));
    $data['last_name'] = ucwords(strtolower($data['last_name']));

    $updated = Client::findOrFail($request->id)
                     ->update($data);

    $message = ($updated)
                  ? 'Cliente actualizado'
                  : 'No se pudo actualizar la información del cliente.';

    $type = ($updated)
              ? 'success'
              : 'danger';

    if ( $request->ajax() )
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      if ($updated)
      {
        return redirect('clients')
                ->withMessage($message)
                ->withType($type);
      }
      else
      {
        return redirect()
                ->back()
                ->withMessage($message)
                ->withType($type);
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $client = Client::findOrFail($request->id);
    $isDestroyed = $client->delete();

    $message = ($isDestroyed) ? 'Cliente eliminado' : 'No se pudo eliminar al cliente.';
    $type = ($isDestroyed) ? 'success' : 'danger';

    if ( $request->ajax() )
    {
      return response()->json(['message' => $message]);
    }
    else
    {
      if ($type === 'success')
      {
        return redirect(route('clients'))
                ->withMessage($message)
                ->withType($type);
      }
      else
      {
        return redirect()
                ->back()
                ->withMessage($message)
                ->withType($type);
      }
    }
  }

  public function filter(ClientFilterRequest $request)
  {
    $currentUser = User::find(Auth::id());
    $field = '';

    switch ($request->filter_by) {
      case 'first_name':
        $value = "%{$request->first_name}%";
        break;
      case 'last_name':
        $value = "%{$request->last_name}%";
        break;
      case 'phone_1':
        $value = "%{$request->phone_1}%";
        break;
      case 'phone_2':
        $value = "%{$request->phone_2}%";
        break;
      case 'business':
        $value = "%{$request->business}%";
        break;
      case 'email_1':
        $value = "%{$request->email_1}%";
        break;
      case 'email_2':
        $value = "%{$request->email_2}%";
        break;
      case 'reference':
        $value = "%{$request->reference}%";
        break;
      default:
        $value = "%{$request->first_name}%";
        break;
    }

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $clients = Client::where($request->filter_by, 'like', $value)
                ->orderBy('id', 'desc')
                ->paginate(5);
    }
    else
    {
      $clients = Client::where($request->filter_by, 'like', $value)
                ->where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->paginate(5);
    }

    $message = (count($clients) > 0)
                  ? count($clients).' Clientes encontrados'
                  : 'No se pudo encontrar ningún cliente.';

    $type = (count($clients) > 0) ? 'success' : 'danger';

    $request->session()->flash('date', $request->date);

    if ($request->ajax())
    {
      return response()->json([
        'calls' => $clients,
        'message' => $message,
        'type' => $type,
      ]);
    }
    else
    {
      return view('clients.filter')
              ->withClients($clients)
              ->withMessage($message)
              ->withType($type)
              ->withUri($this->_uri);
    }
  }
}
