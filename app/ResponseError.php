<?php
namespace App;

use Illuminate\Http\JsonResponse;


/**
 * Class for formating error responses
 */

Class ResponseError
{

    private $httpCode;
    private $error_code;
    private $message;

    /**
     * Returns a response error
     *
     * @param int code, the http code
     * @param int $error_code, the erorr code
     * @param string message
     * @return    void
     */
    public function __construct(int $httpCode, string $error_code, string $message)
    {
        $this->httpCode = $httpCode;
        $this->error_code = $error_code;
        $this->message = $message;
    }


    /**
     * Return an error json response
     *
     * @param
     * @return    void
     * @author
     * @copyright
     */
    public function getResponse(): JsonResponse
    {
        return response()->json(['error' => [ 'code' => $this->error_code, 'message' => $this->message]], $this->httpCode);
    }
}


 ?>
