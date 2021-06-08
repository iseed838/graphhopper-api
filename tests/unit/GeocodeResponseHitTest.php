<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\GeocodeHitResponse;
use PHPUnit\Framework\TestCase;

class GeocodeResponseHitTest extends TestCase
{
    public function testCreate()
    {
        $model = new GeocodeHitResponse([
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
        ]);
        $this->assertNotEmpty($model);
        $this->assertSame($model->getPoint(), [
            'lng' => 37.516796697274,
            'lat' => 55.63039825
        ]);
        $this->assertSame($model->getOsmId(), '537247988');
        $this->assertSame($model->getOsmType(), 'W');
        $this->assertSame($model->getOsmValue(), 'retail');
        $this->assertSame($model->getOsmKey(), 'building');
        $this->assertSame($model->getName(), 'Eco');
        $this->assertSame($model->getCountry(), 'Russia');
        $this->assertSame($model->getCity(), 'Konkovo District');
        $this->assertSame($model->getStreet(), 'Profsouz street');
        $this->assertSame($model->getHousenumber(), '126 k3');
        $this->assertSame($model->getPostcode(), '117632');
        $this->assertSame($model->getExtent(), [
            37.516021,
            55.6309387,
            37.5177537,
            55.6299123
        ]);

    }
}