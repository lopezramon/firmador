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
     *      path="/api/firms",
     *      summary="getFirmList",
     *      tags={"Firm"},
     *      security={ {"sanctum": {} }},
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

        return $this->sendResponse($firms->toArray(), 'Log Signaturs retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/firms",
     *      summary="createFirm",
     *      tags={"Firm"},
     *      security={ {"sanctum": {} }},
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

        return $this->sendResponse($firm->toArray(), 'Log Signatur saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/firms/{id}",
     *      summary="getFirmItem",
     *      tags={"Firm"},
     *      security={ {"sanctum": {} }},
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
            return $this->sendError('Log Signatur not found');
        }

        return $this->sendResponse($firm->toArray(), 'Log Signatur retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/firms/{id}",
     *      summary="updateFirm",
     *      tags={"Firm"},
     *      security={ {"sanctum": {} }},
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
            return $this->sendError('Log Signatur not found');
        }

        $firm = $this->firmRepository->update($input, $id);

        return $this->sendResponse($firm->toArray(), 'Firm updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/firms/{id}",
     *      summary="deleteFirm",
     *      tags={"Firm"},
     *      security={ {"sanctum": {} }},
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
            return $this->sendError('Log Signatur not found');
        }

        $firm->delete();

        return $this->sendSuccess('Log Signatur deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/firms/register",
     *      summary="createFirm",
     *      tags={"Firm"},
     *      security={ {"sanctum": {} }},
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
    public function setRegister(CreateFirmAPIRequest $request)
    {
        $input = $request->all();

        $firm = $this->firmRepository->create($input);

        return $this->sendResponse($firm->toArray(), 'Log Signatur saved successfully');
    }
}
