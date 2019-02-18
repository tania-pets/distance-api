<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\ResponseError;
use App\Models\Journey;
use Illuminate\Support\Facades\Validator;

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
 *         @OA\JsonContent(ref="#/components/schemas/JourneyModel")
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Returns the created journey object",
 *         @OA\JsonContent(ref="#/components/schemas/JourneyModel")
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
*           {"ApiKeyAuth": {"auth_token": "test"}, "Username" : {"username": "test"}},
*       }
 * )
 */
    public function create(Request $request): JsonResponse
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            /**************************/
             /* Per field validation messages omitted*/
            /**************************/
            $error = new ResponseError(402, 'ivalid_parameters', 'Parameters seem invalid. Request failed');
            return $error->getResponse();
        }
        try {
            $journey = new Journey($request->all());

            /**************************/
             /* Store journey omitted*/
            /**************************/

            //add fake id to journey and return it
            return response()->json(['id'=>rand(0, 100)] + $journey->toArray(), 201);
        } catch (\Exception $e) {
            $error = new ResponseError(402, 'request_failed', 'Request failed.');
            return $error->getResponse();
        }

    }

    public function index()
    {

        
    }

    /**
     * Validate the journey's data
     *
     * @param array $data posted
     * @return    void
     */
    protected function validator(array $data): \Illuminate\Validation\Validator
    {
         return Validator::make(
             $data,
             [
                 'distance' => 'required|numeric',
                 'type' => 'required|string|in:walking, biking, driving, flying',
                 'start_at' => 'required|iso_date',
                 'end_at' => 'required|iso_date'
             ],
             [
                 'start_at.iso_date' => 'Please provide an ISO 8601 formated datetime',
                 'end_at.iso_date' => 'Please provide an ISO 8601 formated datetime'
             ]
         );
    }
}
