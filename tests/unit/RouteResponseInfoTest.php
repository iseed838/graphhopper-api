<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\RouteInfoResponse;

class RouteResponseInfoTest extends \PHPUnit\Framework\TestCase
{

    public function testCreate()
    {
        $model = new RouteInfoResponse([
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