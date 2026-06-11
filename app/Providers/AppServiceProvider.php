<?php

namespace App\Providers;

use App\Repositories\TaskRepository;
use App\Services\Interfaces\TaskServiceInterface;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class   AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(TaskServiceInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
