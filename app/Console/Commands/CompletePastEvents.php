<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class CompletePastEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:complete-past';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark past events as completed';

    

public function handle()
{
    $updated = Event::where('status', 'published')
        ->where('date_time', '<', Carbon::now())
        ->update(['status' => 'completed']);

    $this->info("Completed {$updated} past events.");

    return Command::SUCCESS;
}

}
