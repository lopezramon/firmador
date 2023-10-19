<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Organization;

class OrganizationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_organization()
    {
        $organization = Organization::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/organizations', $organization
        );

        $this->assertApiResponse($organization);
    }

    /**
     * @test
     */
    public function test_read_organization()
    {
        $organization = Organization::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/organizations/'.$organization->id
        );

        $this->assertApiResponse($organization->toArray());
    }

    /**
     * @test
     */
    public function test_update_organization()
    {
        $organization = Organization::factory()->create();
        $editedOrganization = Organization::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/organizations/'.$organization->id,
            $editedOrganization
        );

        $this->assertApiResponse($editedOrganization);
    }

    /**
     * @test
     */
    public function test_delete_organization()
    {
        $organization = Organization::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/organizations/'.$organization->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/organizations/'.$organization->id
        );

        $this->response->assertStatus(404);
    }
}
