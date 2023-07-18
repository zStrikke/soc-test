<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::define('delete-user', function(User $user) {
            if($user->type === config('constants.personnel.types.ADMINISTRATOR')) {
                return Response::allow();
            }

            Response::deny('You must be an administrator to delete users.');
        });

        Gate::define('store-results', function(User $user, User $participantUser){ //Todo: mover esto a un form Request.
            if(request()->user()->type !== config('constants.personnel.types.JUDGE')) {
                return Response::deny('You must be an Judge to store results.');
            }
            if($participantUser->type !== config('constants.personnel.types.PARTICIPANT')) {
                return Response::deny('You only can add a result to a participant');
            }
            return Response::allow();
        });
    }
}
