<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 27.12.19
 * Time: 18:50
 */

namespace Graphhopper\Models;


class Dictionary
{
    const LANGUAGE_RU = 'ru';
    const LANGUAGE_EN = 'en';
    const LANGUAGE_DE = 'de';
    const LANGUAGE_FR = 'fr';
    const LANGUAGE_IT = 'it';

    const DEFAULT_VERSION = 1;
    const DEFAULT_URL     = 'https://graphhopper.com/api';

    const PROVIDER_DEFAULT       = 'default';
    const PROVIDER_NOMINATIM     = 'nominatim';
    const PROVIDER_GISGRAPY      = 'gisgraphy';
    const PROVIDER_OPENCAGE_DATA = 'opencagedata';


    /**
     * Get available language dictionary
     * @return array
     */
    public static function getLanguageDictionary(): array
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
     * Get available provider dictionary
     * @return array
     */
    public static function getProviderDictionary(): array
    {
        return [
            self::PROVIDER_DEFAULT,
            self::PROVIDER_GISGRAPY,
            self::PROVIDER_NOMINATIM,
            self::PROVIDER_OPENCAGE_DATA
        ];
    }

}