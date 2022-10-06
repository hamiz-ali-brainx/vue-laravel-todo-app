<?php

namespace App\Console\Commands;

use App\Notifications\NotifyInactiveUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Todo;
use App\Models\User;

class SendNotification extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'send:notification';


  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Email Inactive Users';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $inactive_user = Todo::distinct()->where('created_at', '<', Carbon::now()->subMinutes(4))->get('user_id');
    foreach ($inactive_user as $todo) {
      echo $todo->user_id;
      $user = User::where('id', '=', $todo->user_id)->first();
      $user->notify(new NotifyInactiveUser("A new user has visited on your application."));
    }
  }
}
