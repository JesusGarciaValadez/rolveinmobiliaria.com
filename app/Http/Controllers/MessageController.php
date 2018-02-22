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

  private $_uri = '';
  private $_locale = '';

  public function __constructor()
  {
    $this->_locale = \App::getLocale();

    $this->_uri = 'messages';
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
      $messages = Message::orderBy('id', 'desc')
                    ->paginate(5);
    }
    else
    {
      $messages = Message::where('user_id', '=', $currentUser->id)
                    ->orderBy('id', 'desc')
                    ->paginate(5);
    }

    return view('messages.index', compact('messages', 'this->_uri'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $messages = Message::all()
                    ->sortBy('last_name')
                    ->sortBy('first_name');
    } else {
      $messages = Message::where('user_id', Auth::id())
                    ->get()
                    ->sortBy('last_name')
                    ->sortBy('first_name');
    }

    Carbon::setLocale($this->_locale);
    $created_at = Carbon::now('America/Mexico_City')->toDateTimeString();

    $states = State::all();

    return view('messages.create', compact('created_at', 'this->_uri', 'states', 'messages'));
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
      'user_id' => \Auth::id(),
      'name' => $request->name,
      'email' => $request->email,
      'observations' => $request->observations,
    ];

    $messageCreated = Message::create($message);

    event(new MessageCreatedEvent($messageCreated));

    $message = ($messageCreated)
                 ? 'Nuevo recado creado'
                 : 'No se pudo crear el recado.';

    $type = ($messageCreated)
              ? 'success'
              : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $message]);
    }
    else
    {
      if ($messageCreated)
      {
        return redirect('messages')
                ->with('message', $message)
                ->with('type', 'success');
      }
      else
      {
        return redirect()->back()
                         ->with('message', $message)
                         ->with('type', 'success');
      }
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
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $message = $message::findOrFail($request->id);
    } else {
      $message = $message::where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->get()
                  ->first();
    }

    return view('messages.show', compact('message', 'this->_uri'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function edit(Message $message, Request $request)
  {
    $states = State::all();

    $currentUser = User::with('role')
                       ->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $message = $message::findOrFail($request->id);
    }
    else
    {
      $message = $message::where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->get()
                  ->first();
    }

    return view('messages.edit', compact('this->_uri', 'message'));
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
      'user_id' => $request->user_id,
      'name' => $request->name,
      'email' => $request->email,
      'observations' => $request->observations,
    ];

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $updated = $message::findOrFail($request->id)
                    ->update($newMessage);
    }
    else
    {
      $updated = $message::where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->update($newMessage);
    }

    $message = ($updated)
                  ? 'Llamada actualizada'
                  : 'No se pudo actualizar la llamada.';

    $type = ($updated)
              ? 'success'
              : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $message]);
    }
    else
    {
      if ($updated)
      {
        return redirect('messages')
                ->with('message', $message)
                ->with('type', 'success');
      }
      else
      {
        return redirect()->back()
                         ->with('message', $message)
                         ->with('type', 'success');
      }
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
    $messageDeleted = $message::findOrFail($request->id);
    $isDestroyed = $messageDeleted->delete();

    $message = ($isDestroyed)
                  ? 'Llamada eliminada'
                  : 'No se pudo eliminar la llamada.';

    $type = ($isDestroyed)
              ? 'success'
              : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $message]);
    }
    else
    {
      return redirect(route('messages'))
              ->with('message', $message)
              ->with('type', 'success');
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
                ->paginate(5);
    } else {
      $messages = $message::whereBetween('created_at', [
                  $request->date,
                  now()->tomorrow()
                ])
                ->where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->paginate(5);
    }

    $message = (count($messages) > 0)
                  ? count($messages).' Recados encontrados'
                  : 'No se pudo encontrar ningún recado.';

    $type = (count($messages) > 0) ? 'success' : 'danger';

    $request->session()->flash('date', $request->date);

    if ($request->ajax())
    {
      return response()->json([
        'messages' => $messages,
        'message' => $message,
        'type' => $type,
      ]);
    }
    else
    {
      return view('messages.filter')
              ->with('messages', $messages)
              ->with('uri', $this->_uri)
              ->with('message', $message)
              ->with('type', $type);
    }
  }
}
