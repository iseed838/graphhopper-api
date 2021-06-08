<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace functional;


use Graphhopper\Exceptions\ValidException;
use Graphhopper\Models\Clients\RouteClient;
use Graphhopper\Models\Dictionary;
use Graphhopper\Models\RouteRequest;
use Graphhopper\Models\RouteResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Rakit\Validation\RuleQuashException;
use ReflectionException;

class RouteClientTest extends TestCase
{
    /**
     * @throws ValidException
     * @throws RuleQuashException
     * @throws ReflectionException
     */
    public function testPathsRequest()
    {
        $request = new RouteRequest([
            'points'         => [
                '55.630358,37.516776',
                '55.6916244,37.7225474'
            ],
            'language'       => Dictionary::LANGUAGE_RU,
            'vehicle'        => RouteRequest::VEHICLE_CAR,
            'is_calc_points' => 'true',
            'details'        => [RouteRequest::DETAILS_DISTANCE]
        ]);
        $this->assertNotEmpty($request);
        $routeClient = new RouteClient(new Client(), [
            'url'                 => Dictionary::DEFAULT_URL,
            'version'             => Dictionary::DEFAULT_VERSION,
            'basic_auth_username' => 'user',
            'basic_auth_password' => 'password',
        ]);
        $this->assertNotEmpty($routeClient);
        $routeClient->check();
        $response = new Response(200, [],
            '{"hints":{"visited_nodes.average":"268.0","visited_nodes.sum":"268"},"info":{"copyrights":["GraphHopper","OpenStreetMap contributors"],"took":2},"paths":[{"distance":20048.589,"weight":1276.548563,"time":1276419,"transfers":0,"snapped_waypoints":"wiprIik~cFi|Jyjg@"}]}');
        $this->assertNotEmpty($response);
        $client = $this->createMock(Client::class);
        $client->method('request')->willReturn($response);
        $routeClient->setClient($client);
        $response = $routeClient->paths($request);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(RouteResponse::class, $response);
    }

}

