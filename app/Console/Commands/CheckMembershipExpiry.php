<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MembershipTransaction;
use App\Models\Notification;
use Illuminate\Support\Carbon;

class CheckMembershipExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:check-membership-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification one day before membership expires';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $expiring = MembershipTransaction::whereDate('endDate', $tomorrow)
            ->where('membershipStatus', 'active')
            ->get();
        
        foreach($expiring as $membership){
            $alreadyNotified = Notification::where([
                'referenceType' => 'membership',
                'referenceId' => $membership->id,
                'userId' => $membership->student->user->id,
                'notificationMessage' => 'Membership kamu akan habis besok'
            ])->exists();

            if($alreadyNotified){
                continue;
            }

            Notification::create([
                'userId' => $membership->student->user->id,
                'actorId' => null, 
                'notificationMessage' => 'Membership kamu akan habis besok',
                'notificationDate' => now(),
                'referenceType' => 'membership',
                'referenceId' => $membership->id,
                'status' => 'unread'
            ]);
        }

        return Command::SUCCESS;
    }
}
