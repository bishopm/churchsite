<?php

namespace Bishopm\Churchsite\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            // $schedule->command('churchsite:supplieremails')->monthlyOn(1, '07:15');
            // $schedule->command('churchsite:bookshopemails')->monthlyOn(1, '07:30');
        });
    }

    public function register()
    {
    }
}
