<?php


namespace Graphhopper;

/**
 * Factory class
 * Class Factory
 * @package Graphhopper
 */
class Factory
{
    const LANGUAGE_RU = 'ru';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_DE = 'de';
    const LANGUAGE_FR = 'fr';
    const LANGUAGE_IT = 'it';

    const VEHICLE_CAR  = 'car';
    const VEHICLE_FOOT = 'foot';
    const VEHICLE_BIKE = 'bike';

    const DETAILS_DISTANCE    = 'distance';
    const DETAILS_STREET_NAME = 'street_name';
    const DETAILS_TIME        = 'time';
    const DETAILS_MAX_SPEED   = 'max_speed';
    const DETAILS_LANES       = 'lanes';

    const PROVIDER_DEFAULT       = 'default';
    const PROVIDER_NOMINATIM     = 'nominatim';
    const PROVIDER_GISGRAPY      = 'gisgraphy';
    const PROVIDER_OPENCAGE_DATA = 'opencagedata';

    const DEFAULT_VERSION = 1;
    const DEFAULT_URL     = 'https://graphhopper.com/api';

    const QUERY_REVERSE_TRUE = 'true';

    /**
     * Get available language dictionary
     * @return array
     */
    public static function getLanguageDictionary()
    {
        return [
            self::LANGUAGE_RU,
            self::LANGUAGE_EN,
            self::LANGUAGE_DE,
            self::LANGUAGE_FR,
            self::LANGUAGE_IT,
        ];
    }

    /**
     * Get vehicle dictionary
     * @return array
     */
    public static function getVehicleDictionary()
    {
        return [
            self::VEHICLE_CAR,
            self::VEHICLE_FOOT,
            self::VEHICLE_BIKE,
        ];
    }

    /**
     * Get details dictionary
     * @return array
     */
    public static function getDetailsDictionary()
    {
        return [
            self::DETAILS_DISTANCE,
            self::DETAILS_STREET_NAME,
            self::DETAILS_TIME,
            self::DETAILS_MAX_SPEED,
            self::DETAILS_LANES,
        ];
    }

    /**
     * Get available provider dictionary
     * @return array
     */
    public static function getProviderDictionary()
    {
        return [
            self::PROVIDER_DEFAULT,
            self::PROVIDER_GISGRAPY,
            self::PROVIDER_NOMINATIM,
            self::PROVIDER_OPENCAGE_DATA
        ];
    }
}