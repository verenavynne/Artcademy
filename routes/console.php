<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('membership:check-membership-expiry')
->dailyAt('00:00');

Schedule::command('grade:check-tutor-grade-deadline')
->dailyAt('00:00');

Schedule::command('grade:check-student-project-submission-deadline')
->dailyAt('00:00');
