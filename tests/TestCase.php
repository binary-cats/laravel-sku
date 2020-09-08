<?php

namespace BinaryCats\Sku\Tests;

use BinaryCats\Sku\SkuServiceProvider;
use CreateDummyModelsTable;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Set up the test.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set(
            'database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
            ]
        );
    }

    /**
     * Disable Exception Handling.
     *
     * @return void
     */
    protected function disableExceptionHandling()
    {
        $this->app->instance(
            ExceptionHandler::class, new class extends Handler {
                public function __construct()
                {
                }

                public function report(Exception $e)
                {
                }

                public function render($request, Exception $exception)
                {
                    throw $exception;
                }
            }
        );
    }

    /**
     * Set up the database by creating a dummy models table
     *
     * @return void
     */
    protected function setUpDatabase(): void
    {
        include_once __DIR__.'/../database/migrations/CreateDummyModelsTable.php';

        (new CreateDummyModelsTable())->up();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            SkuServiceProvider::class,
        ];
    }


}
