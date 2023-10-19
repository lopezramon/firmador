<?php namespace Tests\Repositories;

use App\Models\LogSignatur;
use App\Repositories\LogSignaturRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LogSignaturRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LogSignaturRepository
     */
    protected $logSignaturRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logSignaturRepo = \App::make(LogSignaturRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->make()->toArray();

        $createdLogSignatur = $this->logSignaturRepo->create($logSignatur);

        $createdLogSignatur = $createdLogSignatur->toArray();
        $this->assertArrayHasKey('id', $createdLogSignatur);
        $this->assertNotNull($createdLogSignatur['id'], 'Created LogSignatur must have id specified');
        $this->assertNotNull(LogSignatur::find($createdLogSignatur['id']), 'LogSignatur with given id must be in DB');
        $this->assertModelData($logSignatur, $createdLogSignatur);
    }

    /**
     * @test read
     */
    public function test_read_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->create();

        $dbLogSignatur = $this->logSignaturRepo->find($logSignatur->id);

        $dbLogSignatur = $dbLogSignatur->toArray();
        $this->assertModelData($logSignatur->toArray(), $dbLogSignatur);
    }

    /**
     * @test update
     */
    public function test_update_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->create();
        $fakeLogSignatur = LogSignatur::factory()->make()->toArray();

        $updatedLogSignatur = $this->logSignaturRepo->update($fakeLogSignatur, $logSignatur->id);

        $this->assertModelData($fakeLogSignatur, $updatedLogSignatur->toArray());
        $dbLogSignatur = $this->logSignaturRepo->find($logSignatur->id);
        $this->assertModelData($fakeLogSignatur, $dbLogSignatur->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->create();

        $resp = $this->logSignaturRepo->delete($logSignatur->id);

        $this->assertTrue($resp);
        $this->assertNull(LogSignatur::find($logSignatur->id), 'LogSignatur should not exist in DB');
    }
}
