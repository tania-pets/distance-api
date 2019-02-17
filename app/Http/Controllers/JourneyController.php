<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JourneyController extends Controller
{

    /**
 * @OA\POST(
 *     path="/api/v1/journey",
 *     operationId="postJourney",
 *     summary="Adds a new journey for a user",
 *     tags={"journey"},
 *     description="Adds a new journey for a user",
 *     @OA\RequestBody(
 *         description="The journey data to be posted",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/NewJourney")
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Returns the created journey object",
 *         @OA\JsonContent(ref="#/components/schemas/NewJourney")
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="Bad request - The request was unacceptable, often due to missing a required parameter.",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *     @OA\Response(
 *         response="402",
 *         description="Request Failed - The parameters were valid but the request failed.",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Something is really wrong with our server.",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *     security={
*           {"Bearer": {}}
*       }
 * )
 */
    public function create(Request $request): JsonResponse
    {
        $data = ['test' => 'ok'];

        return response()->json($data, 201);

    }
}
