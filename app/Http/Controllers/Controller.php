<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
    * @OA\Info(
    *   title="Example Journey API",
    *   version="1.0",
    *   @OA\Contact(
    *     email="tania.pets@gmail.com",
    *     name="tania.pets"
    *   )
    * )
    */


    /**
    * @OA\Schema(schema="NewJourney",
    *   type="object",
    *   required={"distance,type,start_at,end_at"},
    *   @OA\Property(
    *     property="distance",
    *     type="number",
    *     format="float",
    *     example="2,3",
    *     description="The distance traveled in km"
    *   ),
    *   @OA\Property(
    *     property="type",
    *     type="string",
    *     enum={"walking","biking","driving","flying"},
    *     description="The journey type"
    *   ),
    *   @OA\Property(
    *     property="start_at",
    *     type="string",
    *     format="date-time",
    *     description="Start datetime in ISO 8601 format"
    *   ),
    *   @OA\Property(
    *     property="end_at",
    *     type="string",
    *     format="date-time",
    *     description="End datetime in ISO 8601 format"
    *   ),
    * )
    */



    /**
    * @OA\Schema(schema="ErrorModel",
    *   type="object",
    *   @OA\Property(
    *     property="code",
    *     type="string",
    *   ),
    *   @OA\Property(
    *     property="message",
    *     type="string",
    *   ),
    * )
    */


    /**
    * @OA\Schema(schema="ErrorResponse",
    *   type="object",
    *   @OA\Property(
    *     property="error",
    *     type="object",
    *     ref="#/components/schemas/ErrorModel"
    *   ),
    * )
    */



    /**
     *  @OA\SecurityScheme(
     *      securityScheme="Bearer",
     *      type="http",
     *      scheme="bearer",
     *      bearerFormat="JWT"
     * )
     */






}
