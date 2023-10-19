<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRolAPIRequest;
use App\Http\Requests\API\UpdateRolAPIRequest;
use App\Models\Rol;
use App\Repositories\RolRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Response;
use Spatie\Permission\Models\Role;

/**
 * Class RolController
 * @package App\Http\Controllers\API
 */

class RolAPIController extends AppBaseController
{
    /** @var  RolRepository */
    private $rolRepository;

    public function __construct(RolRepository $rolRepo)
    {
        $this->rolRepository = $rolRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/roles",
     *      summary="getRolList",
     *      tags={"Roles"},
     *      description="Get all Rols",
     *      security={ {"sanctum": {} }},
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
     *                  @OA\Items(ref="#/definitions/Rol")
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
        $rols = $this->rolRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        return $this->sendResponse($rols->toArray(), 'Roles listados con éxito');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/permissions",
     *      summary="getPermissionsList",
     *      tags={"Permisos"},
     *      description="Get all Permissions",
     *      security={ {"sanctum": {} }},
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
     *                  @OA\Items(ref="#/definitions/Permission")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function indexPermissions(Request $request)
    {
        $permissions = $this->rolRepository->allPermissions(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($permissions, 'Permisos listados con éxito');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/roles",
     *      summary="createRol",
     *      tags={"Roles"},
     *      description="Create Rol",
     *      security={ {"sanctum": {} }},
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
     *                  ref="#/definitions/Rol"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRolAPIRequest $request)
    {

        $input = $request->all();

        $rol = $this->rolRepository->create($input);

        return $this->sendResponse($rol->toArray(), 'Roles guardados con éxito');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/roles/{id}",
     *      summary="getRolItem",
     *      tags={"Roles"},
     *      description="Get Rol",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Rol",
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
     *                  ref="#/definitions/Rol"
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
        /** @var Rol $rol */
        $rol = Role::find($id);
        if (empty($rol)) {
            return $this->sendError('Rol no encontrado');
        }

        return $this->sendResponse($rol->load('permissions')->toArray(), 'Rol recuperado con éxito');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/roles/{id}",
     *      summary="updateRol",
     *      tags={"Roles"},
     *      description="Update Rol",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Rol",
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
     *                  ref="#/definitions/Rol"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRolAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol no econtrado');
        }

        // $rol = $this->rolRepository->update($input, $id);

        try {
            DB::beginTransaction();
            $model = Role::findOrFail($id);

            $this->removePermission($input,$model);

            foreach($input['permissions'] as $value){
                $model->givePermissionTo($value);
            }

            $model->fill($input);
            $model->save();
            DB::commit();
            return $model;
        } catch (\Exception $th) {
            DB::rollBack();
            $this->handleException($th);
        }

        return $this->sendResponse($model->load('permissions')->toArray(), 'Permiso actualizado con éxito');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/roles/{id}",
     *      summary="deleteRol",
     *      tags={"Roles"},
     *      description="Delete Rol",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Rol",
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
        /** @var Rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol no encontrado');
        }

        $rol->delete();

        return $this->sendSuccess('Rol borrado con éxito');
    }

    public function removePermission($data,$model)
    {
        // para determinar las imagenes eliminadas
        $requestPermisson = $data['permissions'];
        $currentPermisson = array_column($model->permissions->toArray(), 'name');
        $deletedPermissons = array_values(array_diff($currentPermisson, $requestPermisson));

        foreach($deletedPermissons as $delete){
            $model->revokePermissionTo($delete);
        }

    }

    public function assignacionRoles(Request $request)
    {
        $input = $request->all();

        $role = Role::find($input['role_id']);

        if (empty($role)) {
            return $this->sendError('Rol not encontrado');
        }

        foreach ($input['users'] as $key => $value) {
            $user = User::find($value);
            $user->syncRoles($role);
        }

        return $this->sendSuccess('Asignación de roles exitosa');
    }

    public function rolesUser($id)
    {
        $role = User::with('roles')->get();

        if (empty($role)) {
            return $this->sendError('Rol no econtrado');
        }

        return $this->sendResponse($role->toArray(), 'Rol recuperado con éxito');
    }
}
