<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\FileWillUploadEvent;
use Illuminate\Support\Facades\Storage;

class FileUploadedListener
{
    private $_storagePath = 'public/data_sheets/';

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
     */
    public function __construct()
    {
        if (!Storage::exists($this->_storagePath)) {
            Storage::makeDirectory($this->_storagePath);
        }
    }

    /**
     * Handle the event.
     */
    public function handle(FileWillUploadEvent $event)
    {
        try {
            $file = $event->file;
            $filename = strtolower($file->getClientOriginalName());

            return $file->storeAs('data_sheets', $filename, 'public');
            // \Debugbar::info(Storage::exists($this->_storagePath.$filename));
        } catch (Exception $e) {
            return response()
          ->json([
              'response_message' => 'Error: File was not uploaded',
              'response_code' => '3',
              'Error: ' => $e->getError(),
          ]);
        }
    }
}
