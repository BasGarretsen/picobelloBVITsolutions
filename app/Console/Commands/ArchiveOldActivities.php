<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArchiveOldActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */    
    protected $signature = 'activities:archive-old';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archiveer activiteiten ouder dan 30 dagen';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $oldActivities = Activity::olderThan(30)->get();

        foreach ($oldActivities as $activity) {
            $activity->is_archived = true;
            $activity->save();
        }

        $this->info('Oude activiteiten succesvol gearchiveerd!');
    }

    /**
     * Execute the console command.
     */
}
