<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\RouteInfoResponse;
use Graphhopper\Models\RoutePathResponse;
use Graphhopper\Models\RouteResponse;
use PHPUnit\Framework\TestCase;

class RouteResponseTest extends TestCase
{
    public function testCreate()
    {
        $model = new RouteResponse([
            'info'  => [
                'copyrights' => [
                    'GraphHopper',
                ],
                'took'       => 3
            ],
            'paths' => [
                [
                    'distance'          => 20048.589,
                    'weight'            => 1276.548563,
                    'time'              => 1276419,
                    'transfers'         => 0,
                    'snapped_waypoints' => "wiprIik~cFi|Jyjg@",

                ]
            ],
            'hints' => [
                'visited_nodes.average' => 12,
                'visited_nodes.sum'     => 13
            ]
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(RouteInfoResponse::class, $model->getInfo());
        $this->assertInstanceOf(RoutePathResponse::class, $model->getPaths()[0]);
        $this->assertSame(20048.589, $model->getFirstDistance());
        $this->assertSame(1276419, $model->getFirstTime());
        $this->assertIsArray($model->getHints());

    }
}