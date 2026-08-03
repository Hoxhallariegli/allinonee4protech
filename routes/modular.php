<?php

use Illuminate\Support\Facades\Route;

// Kjo llogjikë bën që për çdo dosje te routes/admin (berber-app, auto-repair, etj)
// të krijohet një "Univers" më vete në URL.

$adminPath = base_path('routes/admin');

if (is_dir($adminPath)) {
    $directories = glob($adminPath . '/*', GLOB_ONLYDIR);

    foreach ($directories as $groupDir) {
        $groupKebab = basename($groupDir); // psh. berber-app

        Route::prefix("modular/{$groupKebab}")
            ->name("modular.{$groupKebab}.")
            ->middleware(['web', 'auth', 'ipCheckMiddleware', 'activeUser', \App\Http\Middleware\ModularLayoutMiddleware::class])
            ->group(function () use ($groupKebab, $groupDir) {

                // Root redirect to dashboard if it exists
                Route::get('/', function() use ($groupKebab) {
                    $routeName = "modular.{$groupKebab}.admin.{$groupKebab}.dashboard";
                    if (Route::has($routeName)) {
                        return redirect()->route($routeName);
                    }
                    return "Dashboard not found for this module.";
                });

                $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($groupDir));
                foreach ($it as $file) {
                    if ($file->isFile() && $file->getExtension() === 'php') {
                        require $file->getPathname();
                    }
                }
            });
    }
}
