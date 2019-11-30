<?php

namespace Statamic\Addons\StaticPages;

use Statamic\Extend\Tasks;
use Illuminate\Console\Scheduling\Schedule;

class StaticPagesTasks extends Tasks
{
    /**
     * Define the task schedule
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    public function schedule(Schedule $schedule)
    {
        // $schedule->command('cache:clear')->weekly();
    }
}
