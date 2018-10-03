<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\State;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Requests\MessageRequest;
use App\Events\MessageCreatedEvent;

class MessageController extends Controller
{
  use ThrottlesLogins;

  /**
   * Set the uri returned to views.
   *
   * @var string
   */
  private $_uri = 'message';

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

  public function __construct ()
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
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $messages = Message::orderBy('id', 'desc')->get();
    }
    else
    {
      $messages = Message::where('user_id', '=', $currentUser->id)
                    ->orderBy('id', 'desc')
                    ->get();
    }

    return view('messages.index', [
      'messages'  => $messages,
      'uri'       => $this->_uri,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('messages.create')->withUri($this->_uri);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(MessageRequest $request)
  {
    $message = [
      'user_id'       => \Auth::id(),
      'name'          => $request->name,
      'email'         => $request->email ?? 'Sin correo',
      'observations'  => $request->observations ?? 'Sin observaciones',
    ];

    $messageToBeCreated = Message::create($message);
    $messageCreated = $messageToBeCreated->save();

    event(new MessageCreatedEvent($messageToBeCreated
  ));

    $this->_message = ($messageCreated)
      ? 'Nuevo recado creado'
      : 'No se pudo crear el recado.';
    $this->_type = ($messageCreated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($messageCreated)
    {
      return redirect()->route('message.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function show(Message $message, Request $request)
  {
    $request->session()->flush();
    
    return view('messages.show', [
      'message' => $message,
      'uri'     => $this->_uri,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function edit(Message $message, Request $request)
  {
    return view('messages.edit', [
      'message' => $message,
      'uri'     => $this->_uri,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function update(MessageRequest $request, Message $message)
  {
    $currentUser = User::with('role')->find(Auth::id());

    $newMessage = [
      'user_id'       => $request->user_id,
      'name'          => $request->name,
      'email'         => $request->email ?? 'Sin correo',
      'observations'  => $request->observations ?? 'Sin observaciones',
    ];

    $updated = $message->update($newMessage);

    $this->_message = ($updated)
      ? 'Llamada actualizada'
      : 'No se pudo actualizar la llamada.';
    $this->_type = ($updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($updated)
    {
      return redirect()->route('message.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function destroy(Message $message, Request $request)
  {
    $isDestroyed = $message->delete();

    $this->_message = ($isDestroyed)
      ? 'Llamada eliminada'
      : 'No se pudo eliminar la llamada.';
    $this->_type = ($isDestroyed) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($isDestroyed)
    {
      return redirect()->route('message.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  public function filter(Request $request, Message $message)
  {
    $currentUser = User::with('role')
                       ->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $messages = $message::whereBetween('created_at', [
                  $request->date,
                  now()->tomorrow()
                ])
                ->orderBy('id', 'desc')
                ->get();
    } else {
      $messages = $message::whereBetween('created_at', [
                  $request->date,
                  now()->tomorrow()
                ])
                ->where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->get();
    }

    $this->_message = (count($messages) > 0)
      ? count($messages).' Recados encontrados'
      : 'No se pudo encontrar ningún recado.';
    $this->_type = (count($messages) > 0) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);
    $request->session()->flash('date', $request->date);

    return view('messages.filter', [
      'messages'  => $messages,
      'uri'       => $this->_uri,
    ]);
  }
}
