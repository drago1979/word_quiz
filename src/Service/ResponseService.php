<?php


namespace App\Service;


class ResponseService
{

	/**
	 * @param $success
	 * @param $message
	 * @param $score
	 * @param int $statusCode
	 * @return array
	 */
	public static function response($success, $message, $score, $statusCode = 500): array
	{
		return [
			'success' => $success,
			'message' => $message,
			'score' => $score,
			'status_code' => $statusCode
		];
	}
}