<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->configureAuth();
        $this->configureCommands();
        $this->configureDates();
        $this->configureModels();
        $this->configurePasswordValidation();
        $this->configureHttp();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    private function configureAuth(): void
    {
        Gate::before(function (?User $user) {
            return $user?->hasRole('admin') ? true : null;
        });
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(Application::getInstance()->isProduction());
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict(! Application::getInstance()->isProduction());
    }

    private function configureHttp(): void
    {
        Http::globalOptions([
            'headers' => [
                'User-Agent' => config('app.user_agent'),
            ],
        ]);

        if (Config::string('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }

    private function configurePasswordValidation(): void
    {
        Password::defaults(fn () => Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->uncompromised()
        );
    }

    private function configureViews(): void
    {
        // Load settings globally for all views
        $settings = cache()->remember('settings', 3600, fn () => Setting::all());
        foreach ($settings as $setting) {
            config()->set([$setting->key => $setting->value]);
        }

        // Modular Layout Switcher
        view()->composer(['components.layouts.app', 'components.layouts.groups.*'], function ($view) {
            $path = request()->path();
            $modules = [
                'berber-app', 'clinic-management', 'auto-repair-management', 'construction-e-r-p',
                'warehouse-management', 'restaurant-p-o-s', 'school-management', 'real-estate-c-r-m',
                'c-r-m', 'hotel-management', 'human-resources', 'e--commerce', 'fleet-management',
                'gym-management', 'finance', 'legal-management', 'pharmacy-management',
                'event-management', 'travel-agency', 'facility-management', 'agriculture-management'
            ];

            foreach ($modules as $module) {
                if (collect(request()->segments())->contains($module)) {
                    $layout = "components.layouts.groups.{$module}";
                    if ($view->getName() !== $layout && view()->exists($layout)) {
                        // This allows us to handle the case where a component is trying to render 'layouts.app'
                        // but we want to force it to a modular layout.
                        // However, composers can't change the view being rendered easily.
                    }
                }
            }
        });
    }
}
