<?php namespace Tests\Repositories;

use App\Models\Firm;
use App\Repositories\FirmRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FirmRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FirmRepository
     */
    protected $firmRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->firmRepo = \App::make(FirmRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_firm()
    {
        $firm = Firm::factory()->make()->toArray();

        $createdFirm = $this->firmRepo->create($firm);

        $createdFirm = $createdFirm->toArray();
        $this->assertArrayHasKey('id', $createdFirm);
        $this->assertNotNull($createdFirm['id'], 'Created Firm must have id specified');
        $this->assertNotNull(Firm::find($createdFirm['id']), 'Firm with given id must be in DB');
        $this->assertModelData($firm, $createdFirm);
    }

    /**
     * @test read
     */
    public function test_read_firm()
    {
        $firm = Firm::factory()->create();

        $dbFirm = $this->firmRepo->find($firm->id);

        $dbFirm = $dbFirm->toArray();
        $this->assertModelData($firm->toArray(), $dbFirm);
    }

    /**
     * @test update
     */
    public function test_update_firm()
    {
        $firm = Firm::factory()->create();
        $fakeFirm = Firm::factory()->make()->toArray();

        $updatedFirm = $this->firmRepo->update($fakeFirm, $firm->id);

        $this->assertModelData($fakeFirm, $updatedFirm->toArray());
        $dbFirm = $this->firmRepo->find($firm->id);
        $this->assertModelData($fakeFirm, $dbFirm->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_firm()
    {
        $firm = Firm::factory()->create();

        $resp = $this->firmRepo->delete($firm->id);

        $this->assertTrue($resp);
        $this->assertNull(Firm::find($firm->id), 'Firm should not exist in DB');
    }
}
