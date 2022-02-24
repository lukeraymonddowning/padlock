<?php

namespace Lukeraymonddowning\Padlock\Tests\Doubles\Http;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

final class TestPendingRequest extends PendingRequest
{
    public function send(string $method, string $url, array $options = []): Response
    {
        $hash = Str::afterLast($url, '/');

        if (file_exists(__DIR__ . "/../../fakes/{$hash}.txt")) {
            return new Response(new \GuzzleHttp\Psr7\Response(200, [], file_get_contents(__DIR__ . "/../../fakes/{$hash}.txt")));
        }

        $response = parent::send($method, $url, $options);

        file_put_contents(__DIR__ . "/../../fakes/{$hash}.txt", $response->body());

        return $response;
    }

}