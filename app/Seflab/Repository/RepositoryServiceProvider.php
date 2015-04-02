<?php namespace Seflab\Repository;

use Illuminate\Support\ServiceProvider;
use Seflab\Repository\Queue\EloquentQueueRepository as QueueRepository;
use Seflab\Repository\LoadScript\EloquentLoadScriptRepository as LoadScriptRepository;
use Seflab\Repository\Report\EloquentReportRepository as ReportRepository;
use Seflab\Repository\Virtual\EloquentVirtualRepository as VirtualRepository;

/**
 * Class RepositoryServiceProvider
 * @package Seflab\Repository
 */
class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // Bind an implementation to each repository interface.
        // For each repository inject the model which will be used by the repository.

        $app->bind('Seflab\Repository\Queue\QueueRepository', function ($app) {
            return new QueueRepository(new \Testsession);
        });

        $app->bind('Seflab\Repository\LoadScript\LoadScriptRepository', function ($app) {
            return new LoadScriptRepository(new \LoadScript);
        });

        $app->bind('Seflab\Repository\Report\ReportRepository', function ($app) {
            return new ReportRepository(new \Report);
        });

        $app->bind('Seflab\Repository\Virtual\VirtualRepository', function ($app) {
            return new VirtualRepository(new \VirtualMachine);
        });
    }

}