<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLogSignaturAPIRequest;
use App\Http\Requests\API\UpdateLogSignaturAPIRequest;
use App\Models\LogSignatur;
use App\Repositories\LogSignaturRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LogSignaturController
 * @package App\Http\Controllers\API
 */

class LogSignaturAPIController extends AppBaseController
{
    /** @var  LogSignaturRepository */
    private $logSignaturRepository;

    public function __construct(LogSignaturRepository $logSignaturRepo)
    {
        $this->logSignaturRepository = $logSignaturRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/logSignaturs",
     *      summary="getLogSignaturList",
     *      tags={"LogSignatur"},
     *      security={ {"sanctum": {} }},
     *      description="Get all LogSignaturs",
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
     *                  @OA\Items(ref="#/definitions/LogSignatur")
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
        $logSignaturs = $this->logSignaturRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logSignaturs->toArray(), 'Log Signaturs retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/logSignaturs",
     *      summary="createLogSignatur",
     *      tags={"LogSignatur"},
     *      security={ {"sanctum": {} }},
     *      description="Create LogSignatur",
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
     *                  ref="#/definitions/LogSignatur"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLogSignaturAPIRequest $request)
    {
        $input = $request->all();

        $logSignatur = $this->logSignaturRepository->create($input);

        return $this->sendResponse($logSignatur->toArray(), 'Log Signatur saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/logSignaturs/{id}",
     *      summary="getLogSignaturItem",
     *      tags={"LogSignatur"},
     *      security={ {"sanctum": {} }},
     *      description="Get LogSignatur",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of LogSignatur",
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
     *                  ref="#/definitions/LogSignatur"
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
        /** @var LogSignatur $logSignatur */
        $logSignatur = $this->logSignaturRepository->find($id);

        if (empty($logSignatur)) {
            return $this->sendError('Log Signatur not found');
        }

        return $this->sendResponse($logSignatur->toArray(), 'Log Signatur retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/logSignaturs/{id}",
     *      summary="updateLogSignatur",
     *      tags={"LogSignatur"},
     *      security={ {"sanctum": {} }},
     *      description="Update LogSignatur",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of LogSignatur",
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
     *                  ref="#/definitions/LogSignatur"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLogSignaturAPIRequest $request)
    {
        $input = $request->all();

        /** @var LogSignatur $logSignatur */
        $logSignatur = $this->logSignaturRepository->find($id);

        if (empty($logSignatur)) {
            return $this->sendError('Log Signatur not found');
        }

        $logSignatur = $this->logSignaturRepository->update($input, $id);

        return $this->sendResponse($logSignatur->toArray(), 'LogSignatur updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/logSignaturs/{id}",
     *      summary="deleteLogSignatur",
     *      tags={"LogSignatur"},
     *      security={ {"sanctum": {} }},
     *      description="Delete LogSignatur",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of LogSignatur",
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
        /** @var LogSignatur $logSignatur */
        $logSignatur = $this->logSignaturRepository->find($id);

        if (empty($logSignatur)) {
            return $this->sendError('Log Signatur not found');
        }

        $logSignatur->delete();

        return $this->sendSuccess('Log Signatur deleted successfully');
    }
}
