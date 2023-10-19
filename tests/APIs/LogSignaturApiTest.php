<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LogSignatur;

class LogSignaturApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_signaturs', $logSignatur
        );

        $this->assertApiResponse($logSignatur);
    }

    /**
     * @test
     */
    public function test_read_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_signaturs/'.$logSignatur->id
        );

        $this->assertApiResponse($logSignatur->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->create();
        $editedLogSignatur = LogSignatur::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_signaturs/'.$logSignatur->id,
            $editedLogSignatur
        );

        $this->assertApiResponse($editedLogSignatur);
    }

    /**
     * @test
     */
    public function test_delete_log_signatur()
    {
        $logSignatur = LogSignatur::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_signaturs/'.$logSignatur->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_signaturs/'.$logSignatur->id
        );

        $this->response->assertStatus(404);
    }
}
