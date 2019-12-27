<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Factory;
use Graphhopper\Models\RouteRequest;

class RouteRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function testCreate()
    {
        $model = new RouteRequest([
            'points'         => [
                '55.630358,37.516776',
                '55.6916244,37.7225474'
            ],
            'language'       => Factory::LANGUAGE_RU,
            'vehicle'        => Factory::VEHICLE_CAR,
            'is_calc_points' => 'true',
            'details'        => [Factory::DETAILS_DISTANCE]
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertSame($model->getLanguage(), Factory::LANGUAGE_RU);
        $this->assertSame($model->getVehicle(), Factory::VEHICLE_CAR);
        $this->assertTrue(in_array(Factory::DETAILS_DISTANCE, $model->getDetails()));
    }
}