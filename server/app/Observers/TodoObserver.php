<?php

namespace App\Observers;

use App\Models\Todo;
use App\Models\User;
use App\Notifications\TodoCreated;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     *
     * @param  \App\Models\Todo  $todo
     * @return void
     */
    public function created(Todo $todo)
    {
        //
        $except_user = User::find($todo->user_id);
        $notify_users = User::where('id', '!=', $except_user->id)->get();
        echo $notify_users;
        foreach ($notify_users as $user) {
            echo $user->id;
            $user->notify(new TodoCreated("A new todo has been added by " . $except_user->name));
        }
    }

    /**
     * Handle the Todo "updated" event.
     *
     * @param  \App\Models\Todo  $todo
     * @return void
     */
    public function updated(Todo $todo)
    {
        //
    }

    /**
     * Handle the Todo "deleted" event.
     *
     * @param  \App\Models\Todo  $todo
     * @return void
     */
    public function deleted(Todo $todo)
    {
        //
    }

    /**
     * Handle the Todo "restored" event.
     *
     * @param  \App\Models\Todo  $todo
     * @return void
     */
    public function restored(Todo $todo)
    {
        //
    }

    /**
     * Handle the Todo "force deleted" event.
     *
     * @param  \App\Models\Todo  $todo
     * @return void
     */
    public function forceDeleted(Todo $todo)
    {
        //
    }
}
