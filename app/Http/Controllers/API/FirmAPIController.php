<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFirmAPIRequest;
use App\Http\Requests\API\UpdateFirmAPIRequest;
use App\Models\Firm;
use App\Repositories\FirmRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FirmController
 * @package App\Http\Controllers\API
 */

class FirmAPIController extends AppBaseController
{
    /** @var  FirmRepository */
    private $firmRepository;

    public function __construct(FirmRepository $firmRepo)
    {
        $this->firmRepository = $firmRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/firms",
     *      summary="getFirmList",
     *      tags={"Firm"},
     *      description="Get all Firms",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/definitions/Firm")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $firms = $this->firmRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($firms->toArray(), 'Firms retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/firms",
     *      summary="createFirm",
     *      tags={"Firm"},
     *      description="Create Firm",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Firm"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFirmAPIRequest $request)
    {
        $input = $request->all();

        $firm = $this->firmRepository->create($input);

        return $this->sendResponse($firm->toArray(), 'Firm saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/firms/{id}",
     *      summary="getFirmItem",
     *      tags={"Firm"},
     *      description="Get Firm",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Firm",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Firm"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Firm $firm */
        $firm = $this->firmRepository->find($id);

        if (empty($firm)) {
            return $this->sendError('Firm not found');
        }

        return $this->sendResponse($firm->toArray(), 'Firm retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/firms/{id}",
     *      summary="updateFirm",
     *      tags={"Firm"},
     *      description="Update Firm",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Firm",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Firm"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFirmAPIRequest $request)
    {
        $input = $request->all();

        /** @var Firm $firm */
        $firm = $this->firmRepository->find($id);

        if (empty($firm)) {
            return $this->sendError('Firm not found');
        }

        $firm = $this->firmRepository->update($input, $id);

        return $this->sendResponse($firm->toArray(), 'Firm updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/firms/{id}",
     *      summary="deleteFirm",
     *      tags={"Firm"},
     *      description="Delete Firm",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Firm",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Firm $firm */
        $firm = $this->firmRepository->find($id);

        if (empty($firm)) {
            return $this->sendError('Firm not found');
        }

        $firm->delete();

        return $this->sendSuccess('Firm deleted successfully');
    }
}