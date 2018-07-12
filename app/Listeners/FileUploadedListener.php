<?php

namespace App\Listeners;

use App\Events\FileWillUploadEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Storage;

class FileUploadedListener
{
  private $_storagePath = "public/data_sheets/";

  /**
   * The name of the connection the job should be sent to.
   *
   * @var string|null
   */
  public $connection = 'redis';

  /**
   * The name of the queue the job should be sent to.
   *
   * @var string|null
   */
  public $queue = 'listeners';

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    if (!Storage::exists($this->_storagePath))
    {
      Storage::makeDirectory($this->_storagePath);
    }
  }

  /**
   * Handle the event.
   *
   * @param  FileWillUploadEvent  $event
   * @return void
   */
  public function handle(FileWillUploadEvent $event)
  {
    try
    {
      $file = $event->file;
      $filename = strtolower($file->getClientOriginalName());
      $uploadSuccess = $file->storeAs('data_sheets', $filename, 'public');
      // \Debugbar::info(Storage::exists($this->_storagePath.$filename));
      return $uploadSuccess;
    }
    catch (Exception $e)
    {
      return response()
              ->json([
                'response_message' => 'Error: File was not uploaded',
                'response_code' => '3',
                'Error: ' => $e->getError()
              ]);
    }
  }
}
