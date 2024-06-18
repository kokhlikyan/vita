<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('users:remove-inactive')->everyThirtyMinutes()->withoutOverlapping();
