<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\RouteInfoResponse;
use PHPUnit\Framework\TestCase;

class RouteResponseInfoTest extends TestCase
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