<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\GeocodeResponse;

class GeocodeResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $model = new GeocodeResponse([
            'took'       => 9,
            'copyrights' => [],
            'hits'       => [
                [
                    'point'         => [
                        'lng' => 37.516796697274,
                        'lat' => 55.63039825
                    ],
                    'osm_id'        => 537247988,
                    'osm_type'      => 'W',
                    'osm_value'     => 'retail',
                    'osm_key'       => 'building',
                    'name'          => 'Eco',
                    'country'       => 'Russia',
                    'city'          => 'Konkovo District',
                    'state'         => 'Moscow',
                    'stateDistrict' => null,
                    'street'        => 'Profsouz street',
                    'housenumber'   => '126 k3',
                    'house_number'  => null,
                    'postcode'      => 117632,
                    'extent'        => [
                        37.516021,
                        55.6309387,
                        37.5177537,
                        55.6299123
                    ]
                ],
            ]
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Graphhopper\Models\GeocodeHitResponse::class, $model->getHits()[0]);
        $this->assertSame($model->getTook(), 9);
        $this->assertSame($model->getCopyrights(), []);

    }
}