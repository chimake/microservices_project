<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis; // Import the Redis facade

class ListenToEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listen:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to events from the message broker';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Redis::subscribe(['user_created'], function ($message) {
            // Handle the received event data
            $this->saveToLogFile($message);
        });
    }

    private function saveToLogFile($data): void
    {
        // Logic to save the received data to a log file
        Log::channel('user_events')->info($data);
    }
}
