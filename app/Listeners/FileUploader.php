<?php

namespace App\Listeners;

use App\Events\FileWillUpload;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Storage;

class FileUploader
{
  private $_storagePath = "public/data_sheets/";

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
   * @param  FileWillUpload  $event
   * @return void
   */
  public function handle(FileWillUpload $event)
  {
    try
    {
      $file = $event->file;
      $filename = strtolower($file->getClientOriginalName());
      $uploadSuccess = $file->storeAs('data_sheets', $filename, 'public');
      \Debugbar::info(Storage::exists($this->_storagePath.$filename));
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
