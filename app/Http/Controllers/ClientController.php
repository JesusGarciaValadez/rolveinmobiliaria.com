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

  private $_uri = 'client';

  /**
   * Set the localization for the language in the app.
   *
   * @var string
   */
  private $_locale;

  /**
   * Set the message to the used returned to views.
   *
   * @var string
   */
  private $_message = null;

  /**
   * Set the type of the alarm return to views.
   *
   * @var string
   */
  private $_type = null;

  /**
   * Date of the attribute updated or created.
   *
   * @var string
   */
  private $_date = null;

  public function __construct()
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
    $currentUser = User::find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $clients = Client::orderBy('first_name', 'asc')
                       ->orderBy('last_name', 'asc')
                       ->get();
    }
    else
    {
      $clients = Client::where('user_id', $currentUser->id)
                       ->orderBy('first_name', 'asc')
                       ->orderBy('last_name', 'asc')
                       ->get();
    }

    return view('clients.index', [
      'clients' => $clients,
      'uri'     => $this->_uri,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $clients = Client::all()->sortBy('last_name');

    return view('clients.create', [
      'clients' => $clients,
      'uri'     => $this->_uri,
    ]);
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
      $this->_message = 'No se guardó este cliente porque ya existe en nuestros registros.';
      $this->_type = 'warning';
      $request->session()->flash('message', $this->_message);
      $request->session()->flash('type', $this->_type);

      return redirect()->back()->withInput();
    }

    $updated = Client::create($data);

    $this->_message = ($updated)
      ? 'Nuevo cliente creado'
      : 'No se pudo agregar el cliente.';
    $this->_type = ($updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($updated)
    {
      return redirect()->route('client.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function show(Client $client, Request $request)
  {
    $request->session()->flush();
    
    return view('clients.show', [
      'client'  => $client,
      'uri'     => $this->_uri,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function edit(Client $client, Request $request)
  {
    return view('clients.edit', [
      'client'  => $client,
      'uri'     => $this->_uri,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function update(Client $client, ClientRequest $request)
  {
    $data = $request->all();
    unset($data['_token']);
    $data['first_name'] = ucwords(strtolower($data['first_name']));
    $data['last_name'] = ucwords(strtolower($data['last_name']));

    $updated = $client->update($data);

    $this->_message = ($updated)
      ? 'Cliente actualizado'
      : 'No se pudo actualizar la información del cliente.';
    $this->_type = ($updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($updated)
    {
      return redirect()->route('client.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function destroy(Client $client, Request $request)
  {
    $isDestroyed = $client->delete();

    $this->_message = ($isDestroyed)
      ? 'Cliente eliminado'
      : 'No se pudo eliminar al cliente.';
    $this->_type = ($isDestroyed) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($isDestroyed)
    {
      return redirect()->route('client.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  public function filter(Client $client, ClientFilterRequest $request)
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

    $this->_message = (count($clients) > 0)
      ? count($clients).' clientes encontrados'
      : 'No se pudo encontrar ningún cliente.';
    $this->_type = (count($clients) > 0) ? 'success' : 'danger';
    $request->session()->flash('date', $request->date);
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    return view('clients.filter', [
      'clients' => $clients,
      'uri'     => $this->_uri,
    ]);
  }
}
