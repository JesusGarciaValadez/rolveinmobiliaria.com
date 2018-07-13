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

  private $_uri = 'message';
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

    return view('messages.index')
            ->withMessages($messages)
            ->withUri($this->_uri);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('messages.create')
            ->withUri($this->_uri);
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
      'email' => $request->email ?? 'Sin correo',
      'observations' => $request->observations ?? 'Sin observaciones',
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
      if ($type === 'success')
      {
        return redirect(route('message.index'))
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
   * Display the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function show(Message $message, Request $request)
  {
    return view('messages.show')
            ->withMessage($message)
            ->withUri($this->_uri);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function edit(Message $message, Request $request)
  {
    return view('messages.edit')
            ->withMessage($message)
            ->withUri($this->_uri);
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
      'email' => $request->email ?? 'Sin correo',
      'observations' => $request->observations ?? 'Sin observaciones',
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
        return redirect(route('message.index'))
                ->withMessage($message)
                ->withType($type);
      }
      else
      {
        if ($type === 'success')
        {
          return redirect(route('message.index'))
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
      if ($type === 'success')
      {
        return redirect(route('message.index'))
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
              ->withMessages($messages)
              ->withMessage($message)
              ->withType($type)
              ->withUri($this->_uri);
    }
  }
}
