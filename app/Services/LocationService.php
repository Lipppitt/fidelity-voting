<?php
namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationService
{
	/**
	 * @throws ConnectionException
	 */
	public function getLocationFromIp(string $ipAddress): string
	{
		$response = Http::acceptJson()->get('http://ip-api.com/json/'.$ipAddress);
		return $response['city'] ?? '';
	}
}
