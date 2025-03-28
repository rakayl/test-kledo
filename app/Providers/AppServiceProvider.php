<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ApproversInterface;
use App\Repositories\ApproversRepository;
use App\Repositories\Interfaces\ApprovalStageInterface;
use App\Repositories\ApprovalStageRepository;
use App\Repositories\Interfaces\ExpenseInterface;
use App\Repositories\ExpenseRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
                ApprovalStageInterface::class,
                ApprovalStageRepository::class,
                ApproversInterface::class,
                ApproversRepository::class,
                ExpenseInterface::class,
                ExpenseRepository::class,
                );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
