<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\ResponseError;
use App\Models\Journey;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
            $error = new ResponseError(400, 'ivalid_parameters', 'Parameters seem invalid. Request failed');
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


    /**
     * @OA\GET(
     *     path="/api/v1/journey/",
     *     operationId="get Journeys",
     *     summary="Gets a list of user's lifetime (summed) journeys",
     *     tags={"journey"},
     *     description="Gets a list of user's lifetime (summed) journeys",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation - Returns array of summed journeys per type",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/JourneyModel")
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad request - The request was unacceptable, often due to invalid parameter.",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     security={
     *           {"ApiKeyAuth": {"auth_token": "test"}, "Username" : {"username": "test"}},
     *       }
     * )
     */


    /**
     * @OA\GET(
     *     path="/api/v1/journey/{type}",
     *     operationId="get Journeys",
     *     summary="Gets a list of user's lifetime (summed) journeys per given type",
     *     tags={"journey"},
     *     description="Gets a list of user's lifetime (summed) journeys per given type",
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         description="Journey type",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           enum={"walking","biking","driving","flying"},
     *           example="walking"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation - Returns array of summed journeys for the given type",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/JourneyModel")
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad request - The request was unacceptable, often due to invalid parameter.",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     security={
     *           {"ApiKeyAuth": {"auth_token": "test"}, "Username" : {"username": "test"}},
     *       }
     * )
     */
    public function index($type = null)
    {
        /**
         * If invalid type provided
         */
        if ($type && !in_array($type, Journey::JOURNEY_TYPES)) {
            $error = new ResponseError(400, 'ivalid_parameters', 'No such journey type.');
            return $error->getResponse();

        }
        $journeys = $this->getFakeJourneys($type);

        return response()->json($journeys, 200);
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
                 'type' => 'required|string|in:'. implode(',', Journey::JOURNEY_TYPES),
                 'start_at' => 'required|iso_date',
                 'end_at' => 'required|iso_date'
             ],
             [
                 'start_at.iso_date' => 'Please provide an ISO 8601 formated datetime',
                 'end_at.iso_date' => 'Please provide an ISO 8601 formated datetime'
             ]
         );
    }



    /**
     * Mocks an array with dummy journey data, sumed per type
     * @param string $type, if certain type is requested
     * @return    array
     */
    private function getFakeJourneys($type = null) : array
    {
        $journeys = [];
        $types = $type ? [$type] : Journey::JOURNEY_TYPES;
        foreach ($types as $journeyType)
        {
            $data = ['distance' => rand(10, 50),
                     'type' => $journeyType,
                     'start_at' => Carbon::now()->subMinutes(rand(20, 30))->toIso8601ZuluString(),
                     'end_at' => Carbon::now()->subMinutes(rand(10, 20))->toIso8601ZuluString()
                 ];
            $journeys[] = (new Journey($data))->toArray();
        }
        return $journeys;

    }
}
