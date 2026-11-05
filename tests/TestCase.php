<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->cleanMongoDB();
    }

    /**
     * Refresh the test database.
     *
     * @return void
     */
    protected function refreshTestDatabase()
    {
        if (! \Illuminate\Foundation\Testing\RefreshDatabaseState::$migrated) {
            $this->artisan('migrate:fresh');
            \Illuminate\Foundation\Testing\RefreshDatabaseState::$migrated = true;
        }

        $this->cleanMongoDB();
    }

    /**
     * Clean MongoDB collections by deleting all documents.
     */
    protected function cleanMongoDB()
    {
        try {
            $connection = \Illuminate\Support\Facades\DB::connection('mongodb');
            $db = $connection->getMongoDB();
            foreach ($db->listCollections() as $collectionInfo) {
                $collectionName = $collectionInfo->getName();
                if (!str_starts_with($collectionName, 'system.')) {
                    $db->selectCollection($collectionName)->deleteMany([]);
                }
            }
        } catch (\Exception $e) {
            // Fallback or ignore if database is not reachable
        }
    }

    /**
     * The database connections that should have transactions.
     *
     * @var array
     */
    public $connectionsToTransact = [];
}
