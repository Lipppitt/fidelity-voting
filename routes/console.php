<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Send email notification to admin every day at 23:59 with total scores for latest poll
Schedule::command('app:notify-admin-with-total-poll-scores')->dailyAt('23:59');
