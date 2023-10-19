<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Firm;

class FirmApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_firm()
    {
        $firm = Firm::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/firms', $firm
        );

        $this->assertApiResponse($firm);
    }

    /**
     * @test
     */
    public function test_read_firm()
    {
        $firm = Firm::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/firms/'.$firm->id
        );

        $this->assertApiResponse($firm->toArray());
    }

    /**
     * @test
     */
    public function test_update_firm()
    {
        $firm = Firm::factory()->create();
        $editedFirm = Firm::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/firms/'.$firm->id,
            $editedFirm
        );

        $this->assertApiResponse($editedFirm);
    }

    /**
     * @test
     */
    public function test_delete_firm()
    {
        $firm = Firm::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/firms/'.$firm->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/firms/'.$firm->id
        );

        $this->response->assertStatus(404);
    }
}
