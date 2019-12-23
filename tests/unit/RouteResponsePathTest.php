<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Di;
use Graphhopper\Models\RoutePathResponse;

class RouteResponsePathTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testCreate()
    {
        $model = Di::get(RoutePathResponse::class, [
            'distance'          => 20048.589,
            'weight'            => 1276.548563,
            'time'              => 1276419,
            'transfers'         => 0,
            'snapped_waypoints' => "wiprIik~cFi|Jyjg@",

        ]);
        $this->assertNotEmpty($model);
        $this->assertSame($model->getDistance(), 20048.589);
        $this->assertSame($model->getWeight(), 1276.548563);
        $this->assertSame($model->getTime(), 1276419);
        $this->assertSame($model->getTransfers(), 0);
        $this->assertSame($model->getSnappedWaypoints(), "wiprIik~cFi|Jyjg@");

    }

}