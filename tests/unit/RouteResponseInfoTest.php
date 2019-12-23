<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Di;
use Graphhopper\Models\RouteInfoResponse;

class RouteResponseInfoTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testCreate()
    {
        $model = Di::get(RouteInfoResponse::class, [
            'copyrights' => [
                'GraphHopper',
            ],
            'took'       => 3
        ]);
        $this->assertNotEmpty($model);
        $this->assertSame($model->getCopyrights(), ['GraphHopper']);
        $this->assertSame($model->getTook(), 3);

    }

}