<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\RoutePathResponse;
use PHPUnit\Framework\TestCase;

class RouteResponsePathTest extends TestCase
{
    /**
     */
    public function testCreate()
    {
        $model = new RoutePathResponse([
            'distance'          => 20048.589,
            'weight'            => 1276.548563,
            'time'              => 1276419,
            'transfers'         => 0,
            'snapped_waypoints' => "wiprIik~cFi|Jyjg@",
            'legs'              => [
                [
                    123,
                    123
                ]
            ],
            'points'            => [
                [37.654999, 55.703026],
                [37.6561, 55.702995],
            ],
            'details'           => [
                [0, 1, 68.227871223281],
                [1, 2, 32.217],
            ]
        ]);
        $this->assertNotEmpty($model);
        $this->assertSame($model->getDistance(), 20048.589);
        $this->assertSame($model->getWeight(), 1276.548563);
        $this->assertSame($model->getTime(), 1276419);
        $this->assertSame($model->getTransfers(), 0);
        $this->assertSame($model->getSnappedWaypoints(), "wiprIik~cFi|Jyjg@");
        $this->assertNotEmpty($model->getPoints());
        $this->assertNotEmpty($model->getDetails());
        $this->assertNotEmpty($model->getLegs());

    }

}