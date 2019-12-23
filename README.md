# graphhopper-api

This project is a wrapper for making api requests to the direction api system of graphhopper company https://www.graphhopper.com/

The wrapper can be installed with the command

* composer require iseed838 / graphhopper-api "master" command

Currently 2 types of services are tied:
* Route Api
* Geocode Api

1) Make route request:

<pre>
$pathRequest = new \Graphhopper\Models\RouteRequest([
    'points'   => [
        '55.630358,37.516776',
        '55.6916244,37.7225474'
    ],
]);

$client = new \Graphhopper\Models\Clients\RouteClient([
    'key'                => '123-asd',
]);
$pathResponse = $client->paths($pathRequest);
</pre>

will be response:

<pre>
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
</pre>

2) Make geocode request:

* query request
<pre>
$queryGeocodeRequest = new \Graphhopper\Models\GeocodeQueryRequest([
    'query' => 'Moscow Vavilova 6',
    'language' => \Graphhopper\Factory::LANGUAGE_EN
]);

$client = new \Graphhopper\Models\Clients\GeocodeClient([
    'key'                => '123-asd',
]);
$geocodeResponse = $client->query($queryGeocodeRequest);
</pre>

* reverse request
<pre>
$reverseGeocodeRequest = new \Graphhopper\Models\GeocodeReverseRequest([
    'point' => '55.630358,37.516776',
    'language' => \Graphhopper\Factory::LANGUAGE_RU
]);

$client = new \Graphhopper\Models\Clients\GeocodeClient([
    'key'                => '123-123',
]);
$geocodeReverseResponse = $client->reverse($reverseGeocodeRequest);
</pre>

will be return:
<pre>
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
</pre>

The route request model has the following parameters:
<pre>
* points (required|string[]|count>1) - Point coordiante
* vehicle (required|string)          - Vehicle type. Available car,foot,bike, Default car;
* language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
* is_calc_points (required|string)   - Is Need calculate points. Default false;
* details (string[])                 - Response Detail. Awailable 'distance', 'time', 'weight', 'line'. Default 'distance';
* limit (required|integer)           - Count response variants
</pre>

The geocode query request model has the following parameters:
<pre>
* query (required|string)            - Address string;
* point (string)                     - Point coordiante;
* language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
* provider (required|string)         - Query provider. Avaiable 'default', 'nominatim'. Default 'default'
* limit (required|integer)           - Count response variants. Default 5;
</pre>

The geocode reverse request model has the following parameters:
<pre>
* point (required|string)            - Point coordiante;
* language (required|string)         - Request language. Available en,ru,de,fr,it. Default en;
* provider (required|string)         - Query provider. Avaiable 'default', 'nominatim'. Default 'default';
* limit (required|integer)           - Count response variants. Default 1;
</pre>