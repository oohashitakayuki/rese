<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Mail\ReminderEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users for today\'s reservations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $reservations = Reservation::where('date', $today)->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReminderEmail($reservation));
        }
    }
}
