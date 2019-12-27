# graphhopper-api

Graphhopper is powerful direction api to plannin you application [graphhopper](https://www.graphhopper.com/)

This project is a wrapper for making api requests to the direction api

The wrapper can be installed with the command

* **composer require "iseed838/graphhopper-api" "~0.2"**

Currently 2 types of services are tied:
* Route Api
* Geocode Api

1) **Make route request:**

```php
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

```php
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
```php
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
```php
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
```php
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
- [x] is_calc_points (required|string)   - Is Need calculate points. Default false;
- [x] details (string[])                 - Response Detail. Awailable 'distance', 'time', 'weight', 'line'. Default 'distance';
- [x] limit (required|integer)           - Count response variants


The geocode query request model has the following parameters:

- [x] query (required|string)            - Address string;
- [x] point (string)                     - Point coordiante;
- [x] language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
- [x] provider (required|string)         - Query provider. Avaiable 'default', 'nominatim'. Default 'default'
- [x] limit (required|integer)           - Count response variants. Default 5;


The geocode reverse request model has the following parameters:

- [x] point (required|string)            - Point coordiante;
- [x] language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
- [x] provider (required|string)         - Query provider. Avaiable 'default', 'nominatim'. Default 'default';
- [x] limit (required|integer)           - Count response variants. Default 1;
