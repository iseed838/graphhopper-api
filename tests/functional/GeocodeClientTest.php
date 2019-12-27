<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace functional;


use Graphhopper\Models\Clients\GeocodeClient;
use Graphhopper\Models\Dictionary;
use Graphhopper\Models\GeocodeQueryRequest;
use Graphhopper\Models\GeocodeResponse;
use Graphhopper\Models\GeocodeReverseRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GeocodeClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return GeocodeClient
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     * @throws \ReflectionException
     */
    public function testQueryRequest()
    {
        $request = new GeocodeQueryRequest([
            'query' => 'Moscow, Valilova 6'
        ]);
        $this->assertNotEmpty($request);
        $geocodeClient = new GeocodeClient(new Client(), [
            'url'                 => Dictionary::DEFAULT_URL,
            'version'             => Dictionary::DEFAULT_VERSION,
            'basic_auth_username' => 'user',
            'basic_auth_password' => 'password',
        ]);
        $this->assertNotEmpty($geocodeClient);
        $geocodeClient->check();
        $response = new Response(200, [],
            '{"hits":[{"osm_id":4555839216,"osm_type":"N","country":"Russia","osm_key":"office","housenumber":"3","city":"Donskoy District","street":"улица Вавилова","osm_value":"telecommunication","postcode":"117449","name":"Beeline","state":"Moscow","point":{"lng":37.5938103,"lat":55.7061028}},{"osm_id":4555839216,"osm_type":"N","country":"Russia","osm_key":"shop","housenumber":"3","city":"Donskoy District","street":"улица Вавилова","osm_value":"mobile_phone","postcode":"117449","name":"Beeline","state":"Moscow","point":{"lng":37.5938103,"lat":55.7061028}},{"osm_id":6498492,"osm_type":"R","extent":[37.5878803,55.709524,37.5913503,55.7078754],"country":"Russia","osm_key":"landuse","city":"Donskoy District","osm_value":"residential","postcode":"115419","name":"Жилой комплекс  Вавилова, 4 ","state":"Moscow","point":{"lng":37.58994442555927,"lat":55.70872265}},{"osm_id":155217743,"extent":[37.5643316,55.6948575,37.5657413,55.6940486],"country":"Russia","city":"Gagarinsky District","postcode":"117312","point":{"lng":37.56459592473202,"lat":55.69442645},"osm_type":"W","osm_key":"office","housenumber":"40","street":"улица Вавилова","osm_value":"research","name":"Dorodnitsyn Computing Centre","state":"Moscow"},{"osm_id":288506766,"osm_type":"N","country":"Russia","osm_key":"tourism","housenumber":"57","city":"Gagarinsky District","street":"улица Вавилова","osm_value":"museum","postcode":"117292","name":"The State Darwin Museum","state":"Moscow","point":{"lng":37.5614951,"lat":55.6907141}}],"took":8}');
        $this->assertNotEmpty($response);
        $client = $this->createMock(Client::class);
        $client->method('request')->willReturn($response);
        $geocodeClient->setClient($client);
        $response = $geocodeClient->query($request);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(GeocodeResponse::class, $response);

        return $geocodeClient;
    }

    /**
     * @param GeocodeClient $geocodeClient
     * @depends testQueryRequest
     * @throws \Exception
     */
    public function testReverseRequest(GeocodeClient $geocodeClient)
    {
        $request = new GeocodeReverseRequest([
            'point' => '55.630358,37.516776'
        ]);
        $this->assertNotEmpty($request);
        $response = new Response(200, [],
            '{"hits":[{"osm_id":4555839216,"osm_type":"N","country":"Russia","osm_key":"office","housenumber":"3","city":"Donskoy District","street":"улица Вавилова","osm_value":"telecommunication","postcode":"117449","name":"Beeline","state":"Moscow","point":{"lng":37.5938103,"lat":55.7061028}},{"osm_id":4555839216,"osm_type":"N","country":"Russia","osm_key":"shop","housenumber":"3","city":"Donskoy District","street":"улица Вавилова","osm_value":"mobile_phone","postcode":"117449","name":"Beeline","state":"Moscow","point":{"lng":37.5938103,"lat":55.7061028}},{"osm_id":6498492,"osm_type":"R","extent":[37.5878803,55.709524,37.5913503,55.7078754],"country":"Russia","osm_key":"landuse","city":"Donskoy District","osm_value":"residential","postcode":"115419","name":"Жилой комплекс  Вавилова, 4 ","state":"Moscow","point":{"lng":37.58994442555927,"lat":55.70872265}},{"osm_id":155217743,"extent":[37.5643316,55.6948575,37.5657413,55.6940486],"country":"Russia","city":"Gagarinsky District","postcode":"117312","point":{"lng":37.56459592473202,"lat":55.69442645},"osm_type":"W","osm_key":"office","housenumber":"40","street":"улица Вавилова","osm_value":"research","name":"Dorodnitsyn Computing Centre","state":"Moscow"},{"osm_id":288506766,"osm_type":"N","country":"Russia","osm_key":"tourism","housenumber":"57","city":"Gagarinsky District","street":"улица Вавилова","osm_value":"museum","postcode":"117292","name":"The State Darwin Museum","state":"Moscow","point":{"lng":37.5614951,"lat":55.6907141}}],"took":8}');
        $client   = $this->createMock(Client::class);
        $client->method('request')->willReturn($response);
        $geocodeClient->setClient($client);
        $response = $geocodeClient->reverse($request);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(GeocodeResponse::class, $response);
    }

}

