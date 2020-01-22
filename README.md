# graphhopper-api

Graphhopper is powerful direction api to plannin you application [graphhopper](https://www.graphhopper.com/)

This project is a wrapper for making api requests to the direction api

The wrapper can be installed with the command

* **composer require "iseed838/graphhopper-api" "~0.2"**

Currently 2 types of services are tied:
* Route Api
* Geocode Api

1) **Make route request:**

```
$pathRequest = new \Graphhopper\Models\RouteRequest([
    'points'   => [
        '55.630358,37.516776',
        '55.6916244,37.7225474'
    ],
]);

$client = new \Graphhopper\Models\Clients\RouteClient(new \GuzzleHttp\Client(), [
    'key'                => '123-asd',
]);
$pathResponse = $client->paths($pathRequest);
```

**will be response:**

```
Graphhopper\Models\RouteResponse Object
(
    [info:Graphhopper\Models\RouteResponse:private] => Array
        (
            [copyrights] => Array
                (
                    [0] => GraphHopper
                    [1] => OpenStreetMap contributors
                )

            [took] => 2
        )

    [paths:Graphhopper\Models\RouteResponse:private] => Array
        (
            [0] => Array
                (
                    [distance] => 20048.589
                    [weight] => 1276.548563
                    [time] => 1276419
                    [transfers] => 0
                    [snapped_waypoints] => wiprIik~cFi|Jyjg@
                    [points] => [
                        [type] => LineString
                        [coordinates] => [
                            [
                                [0] => 37.516213
                                [1] => 55.630528
                            ],
                            [
                                    [0] => 37.515701
                                    [1] => 55.629986
                            ]
                        ]   
                    ],
                    [legs] => [
                    
                    ],
                    [details] => [
                        [distance] => [
                            [
                                [0] => 0
                                [1] => 1
                                [2] => 68.227871223281
                            ],
                            [
                                [0] => 1
                                [1] => 2
                                [2] => 32.217
                            ],
                        ]
                    ]                   
                )

        )

    [hints:Graphhopper\Models\RouteResponse:private] => Array
        (
            [visited_nodes.average] => 268.0
            [visited_nodes.sum] => 268
        )

)
```

2) **Make geocode request:**

* <i>query request</i>
```
$queryGeocodeRequest = new \Graphhopper\Models\GeocodeQueryRequest([
    'query' => 'Moscow Vavilova 6',
    'language' => \Graphhopper\Factory::LANGUAGE_EN
]);

$client = new \Graphhopper\Models\Clients\GeocodeClient(new \GuzzleHttp\Client(), [
    'key'                => '123-asd',
]);
$geocodeResponse = $client->query($queryGeocodeRequest);
```

* <i>reverse request</i>
```
$reverseGeocodeRequest = new \Graphhopper\Models\GeocodeReverseRequest([
    'point' => '55.630358,37.516776',
    'language' => \Graphhopper\Factory::LANGUAGE_RU
]);

$client = new \Graphhopper\Models\Clients\GeocodeClient(new \GuzzleHttp\Client(), [
    'key'                => '123-123',
]);
$geocodeReverseResponse = $client->reverse($reverseGeocodeRequest);
```

**will be return:**
```
Graphhopper\Models\GeocodeResponse Object
(
    [took:Graphhopper\Models\GeocodeResponse:private] => 1470
    [copyrights:Graphhopper\Models\GeocodeResponse:private] => Array
        (
        )

    [hits:Graphhopper\Models\GeocodeResponse:private] => Array
        (
            [0] => Array
                (
                    [osm_id] => 5607914901
                    [osm_type] => N
                    [country] => India
                    [osm_key] => place
                    [city] => Thiruvanchoor
                    [osm_value] => locality
                    [postcode] => 686010
                    [name] => Moscow Junction
                    [state] => Kerala
                    [point] => Array
                        (
                            [lng] => 76.560045
                            [lat] => 9.613103
                        )

                )
        )

    [locale:Graphhopper\Models\GeocodeResponse:private] =>
)
```

The route request model has the following parameters:
- [x] points (required|string[]|count>1) - Point coordinate
- [x] vehicle (required|string)          - Vehicle type. Available car,foot,bike, Default car;
- [x] language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
- [x] is_calc_points (string)   - Is need calculate points. Default false;
- [x] limit (required|integer)           - Count response variants
- [x] is_instructions (string) - Is need text instructions for paths. Default false;
- [x] is_point_encoded (string) - Is need point encoded points. Default false;
- [x] details (string[])                 - Response Detail. Available 'distance', 'time', 'weight', 'line'. Default 'distance';

The geocode query request model has the following parameters:

- [x] query (required|string)            - Address string;
- [x] point (string)                     - Point coordinate;
- [x] language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
- [x] provider (required|string)         - Query provider. Available 'default', 'nominatim'. Default 'default'
- [x] limit (required|integer)           - Count response variants. Default 5;


The geocode reverse request model has the following parameters:

- [x] point (required|string)            - Point coordinate;
- [x] language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
- [x] provider (required|string)         - Query provider. Available 'default', 'nominatim'. Default 'default';
- [x] limit (required|integer)           - Count response variants. Default 1;
