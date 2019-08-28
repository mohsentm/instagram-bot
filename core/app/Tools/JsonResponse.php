<?php


namespace App\Tools;

use Symfony\Component\HttpFoundation\Response;

class JsonResponse
{

    const RESPONSE_DESCRIPTION = 'response_description';

    /**
     * @param $responseMessage
     * @param int $responseCode
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successMessage(
        $responseMessage,
        $responseCode = Response::HTTP_OK,
        $headers = [],
        $options = 0
    ) {
        return response()->json(
            [
                JsonResponse::RESPONSE_DESCRIPTION => $responseMessage
            ],
            $responseCode,
            $headers,
            $options
        );
    }

    /**
     * @param $responseObject
     * @param int $responseCode
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successObject(
        $responseObject,
        $responseCode = Response::HTTP_OK,
        $headers = [],
        $options = 0
    ) {
        return response()->json($responseObject, $responseCode, $headers, $options);
    }
}