<?php

return [

    /* -----------------------------------------------------------------
     |  Default Driver
     | -----------------------------------------------------------------
     |  Supported: 'freegeoip', 'ip-api', 'maxmind-database', 'maxmind-api'
     */

    'default' => 'freegeoip',

    /* -----------------------------------------------------------------
     |  Supported Drivers
     | -----------------------------------------------------------------
     */

    'drivers' => [
        'freegeoip' => [
            'driver'  => Arcanedev\GeoIP\Drivers\FreeGeoIpDriver::class,
            'options' => [
                //
            ],
        ],

        'ip-api' => [
            'driver'  => Arcanedev\GeoIP\Drivers\IpApiDriver::class,
            'options' => [
                'secure' => true,
                'key'    => env('IPAPI_KEY'),
            ],
        ],

        'maxmind-api' => [
            'driver'  => Arcanedev\GeoIP\Drivers\MaxmindApiDriver::class,
            'options' => [
                'user_id'     => env('MAXMIND_USER_ID'),
                'license_key' => env('MAXMIND_LICENSE_KEY'),
                'locales'     => ['en'],
            ],
        ],

        'maxmind-database' => [
            'driver'  => Arcanedev\GeoIP\Drivers\MaxmindDatabaseDriver::class,
            'options' => [
                'database-path' => storage_path('app/geo-ip/geoip.mmdb'),
                'update-url'    => 'https://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz',
                'locales'       => ['en'],
            ],
        ],
    ],

    /* -----------------------------------------------------------------
     |  Cache
     | -----------------------------------------------------------------
     */

    'cache' => [
        'mode'    => 'all',

        'tags'    => ['geoip-location'],

        'expires' => 30,
    ],

    /* -----------------------------------------------------------------
     |  Log failures
     | -----------------------------------------------------------------
     */

    'log-failures' => [
        'enabled'  => true,

        'location' => storage_path('logs/geoip.log'),
    ],

    /* -----------------------------------------------------------------
     |  Entities
     | -----------------------------------------------------------------
     */

    'location' => [
        'default'       => [
            'ip'          => '',
            'iso_code'    => '',
            'country'     => '',
            'city'        => '',
            'state'       => '',
            'state_code'  => '',
            'postal_code' => '',
            'latitude'    => 0,
            'longitude'   => 0,
            'timezone'    => 'UTC',
            'continent'   => '',
            'currency'    => '',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Continents
     | -----------------------------------------------------------------
     */

    'continents' => [
        'A1' => '--',
        'A2' => '--',
        'AD' => 'EU',
        'AE' => 'AS',
        'AF' => 'AS',
        'AG' => 'NA',
        'AI' => 'NA',
        'AL' => 'EU',
        'AM' => 'AS',
        'AN' => 'NA',
        'AO' => 'AF',
        'AP' => 'AS',
        'AQ' => 'AN',
        'AR' => 'SA',
        'AS' => 'OC',
        'AT' => 'EU',
        'AU' => 'OC',
        'AW' => 'NA',
        'AX' => 'EU',
        'AZ' => 'AS',
        'BA' => 'EU',
        'BB' => 'NA',
        'BD' => 'AS',
        'BE' => 'EU',
        'BF' => 'AF',
        'BG' => 'EU',
        'BH' => 'AS',
        'BI' => 'AF',
        'BJ' => 'AF',
        'BL' => 'NA',
        'BM' => 'NA',
        'BN' => 'AS',
        'BO' => 'SA',
        'BR' => 'SA',
        'BS' => 'NA',
        'BT' => 'AS',
        'BV' => 'AN',
        'BW' => 'AF',
        'BY' => 'EU',
        'BZ' => 'NA',
        'CA' => 'NA',
        'CC' => 'AS',
        'CD' => 'AF',
        'CF' => 'AF',
        'CG' => 'AF',
        'CH' => 'EU',
        'CI' => 'AF',
        'CK' => 'OC',
        'CL' => 'SA',
        'CM' => 'AF',
        'CN' => 'AS',
        'CO' => 'SA',
        'CR' => 'NA',
        'CU' => 'NA',
        'CV' => 'AF',
        'CX' => 'AS',
        'CY' => 'AS',
        'CZ' => 'EU',
        'DE' => 'EU',
        'DJ' => 'AF',
        'DK' => 'EU',
        'DM' => 'NA',
        'DO' => 'NA',
        'DZ' => 'AF',
        'EC' => 'SA',
        'EE' => 'EU',
        'EG' => 'AF',
        'EH' => 'AF',
        'ER' => 'AF',
        'ES' => 'EU',
        'ET' => 'AF',
        'EU' => 'EU',
        'FI' => 'EU',
        'FJ' => 'OC',
        'FK' => 'SA',
        'FM' => 'OC',
        'FO' => 'EU',
        'FR' => 'EU',
        'FX' => 'EU',
        'GA' => 'AF',
        'GB' => 'EU',
        'GD' => 'NA',
        'GE' => 'AS',
        'GF' => 'SA',
        'GG' => 'EU',
        'GH' => 'AF',
        'GI' => 'EU',
        'GL' => 'NA',
        'GM' => 'AF',
        'GN' => 'AF',
        'GP' => 'NA',
        'GQ' => 'AF',
        'GR' => 'EU',
        'GS' => 'AN',
        'GT' => 'NA',
        'GU' => 'OC',
        'GW' => 'AF',
        'GY' => 'SA',
        'HK' => 'AS',
        'HM' => 'AN',
        'HN' => 'NA',
        'HR' => 'EU',
        'HT' => 'NA',
        'HU' => 'EU',
        'ID' => 'AS',
        'IE' => 'EU',
        'IL' => 'AS',
        'IM' => 'EU',
        'IN' => 'AS',
        'IO' => 'AS',
        'IQ' => 'AS',
        'IR' => 'AS',
        'IS' => 'EU',
        'IT' => 'EU',
        'JE' => 'EU',
        'JM' => 'NA',
        'JO' => 'AS',
        'JP' => 'AS',
        'KE' => 'AF',
        'KG' => 'AS',
        'KH' => 'AS',
        'KI' => 'OC',
        'KM' => 'AF',
        'KN' => 'NA',
        'KP' => 'AS',
        'KR' => 'AS',
        'KW' => 'AS',
        'KY' => 'NA',
        'KZ' => 'AS',
        'LA' => 'AS',
        'LB' => 'AS',
        'LC' => 'NA',
        'LI' => 'EU',
        'LK' => 'AS',
        'LR' => 'AF',
        'LS' => 'AF',
        'LT' => 'EU',
        'LU' => 'EU',
        'LV' => 'EU',
        'LY' => 'AF',
        'MA' => 'AF',
        'MC' => 'EU',
        'MD' => 'EU',
        'ME' => 'EU',
        'MF' => 'NA',
        'MG' => 'AF',
        'MH' => 'OC',
        'MK' => 'EU',
        'ML' => 'AF',
        'MM' => 'AS',
        'MN' => 'AS',
        'MO' => 'AS',
        'MP' => 'OC',
        'MQ' => 'NA',
        'MR' => 'AF',
        'MS' => 'NA',
        'MT' => 'EU',
        'MU' => 'AF',
        'MV' => 'AS',
        'MW' => 'AF',
        'MX' => 'NA',
        'MY' => 'AS',
        'MZ' => 'AF',
        'NA' => 'AF',
        'NC' => 'OC',
        'NE' => 'AF',
        'NF' => 'OC',
        'NG' => 'AF',
        'NI' => 'NA',
        'NL' => 'EU',
        'NO' => 'EU',
        'NP' => 'AS',
        'NR' => 'OC',
        'NU' => 'OC',
        'NZ' => 'OC',
        'O1' => '--',
        'OM' => 'AS',
        'PA' => 'NA',
        'PE' => 'SA',
        'PF' => 'OC',
        'PG' => 'OC',
        'PH' => 'AS',
        'PK' => 'AS',
        'PL' => 'EU',
        'PM' => 'NA',
        'PN' => 'OC',
        'PR' => 'NA',
        'PS' => 'AS',
        'PT' => 'EU',
        'PW' => 'OC',
        'PY' => 'SA',
        'QA' => 'AS',
        'RE' => 'AF',
        'RO' => 'EU',
        'RS' => 'EU',
        'RU' => 'EU',
        'RW' => 'AF',
        'SA' => 'AS',
        'SB' => 'OC',
        'SC' => 'AF',
        'SD' => 'AF',
        'SE' => 'EU',
        'SG' => 'AS',
        'SH' => 'AF',
        'SI' => 'EU',
        'SJ' => 'EU',
        'SK' => 'EU',
        'SL' => 'AF',
        'SM' => 'EU',
        'SN' => 'AF',
        'SO' => 'AF',
        'SR' => 'SA',
        'ST' => 'AF',
        'SV' => 'NA',
        'SY' => 'AS',
        'SZ' => 'AF',
        'TC' => 'NA',
        'TD' => 'AF',
        'TF' => 'AN',
        'TG' => 'AF',
        'TH' => 'AS',
        'TJ' => 'AS',
        'TK' => 'OC',
        'TL' => 'AS',
        'TM' => 'AS',
        'TN' => 'AF',
        'TO' => 'OC',
        'TR' => 'EU',
        'TT' => 'NA',
        'TV' => 'OC',
        'TW' => 'AS',
        'TZ' => 'AF',
        'UA' => 'EU',
        'UG' => 'AF',
        'UM' => 'OC',
        'US' => 'NA',
        'UY' => 'SA',
        'UZ' => 'AS',
        'VA' => 'EU',
        'VC' => 'NA',
        'VE' => 'SA',
        'VG' => 'NA',
        'VI' => 'NA',
        'VN' => 'AS',
        'VU' => 'OC',
        'WF' => 'OC',
        'WS' => 'OC',
        'YE' => 'AS',
        'YT' => 'AF',
        'ZA' => 'AF',
        'ZM' => 'AF',
        'ZW' => 'AF',
    ],

    /* -----------------------------------------------------------------
     |  Currencies
     | -----------------------------------------------------------------
     */

    'currencies' => [
        'included' => true,

        'data'     => [
            'AD' => 'EUR',
            'AE' => 'AED',
            'AF' => 'AFN',
            'AG' => 'XCD',
            'AI' => 'XCD',
            'AL' => 'ALL',
            'AM' => 'AMD',
            'AN' => 'ANG',
            'AO' => 'AOA',
            'AQ' => '',
            'AR' => 'ARS',
            'AS' => 'USD',
            'AT' => 'EUR',
            'AU' => 'AUD',
            'AW' => 'AWG',
            'AZ' => 'AZN',
            'BA' => 'BAM',
            'BB' => 'BBD',
            'BD' => 'BDT',
            'BE' => 'EUR',
            'BF' => 'XOF',
            'BG' => 'BGN',
            'BH' => 'BHD',
            'BI' => 'BIF',
            'BJ' => 'XOF',
            'BL' => 'EUR',
            'BM' => 'BMD',
            'BN' => 'BND',
            'BO' => 'BOB',
            'BR' => 'BRL',
            'BS' => 'BSD',
            'BT' => 'BTN',
            'BV' => 'NOK',
            'BW' => 'BWP',
            'BY' => 'BYR',
            'BZ' => 'BZD',
            'CA' => 'CAD',
            'CC' => 'AUD',
            'CD' => 'CDF',
            'CF' => 'XAF',
            'CG' => 'CDF',
            'CH' => 'CHF',
            'CI' => 'XOF',
            'CK' => 'NZD',
            'CL' => 'CLP',
            'CM' => 'XAF',
            'CN' => 'CNY',
            'CO' => 'COP',
            'CR' => 'CRC',
            'CU' => 'CUP',
            'CV' => 'CVE',
            'CW' => 'ANG',
            'CX' => 'AUD',
            'CY' => 'EUR',
            'CZ' => 'CZK',
            'DE' => 'EUR',
            'DJ' => 'DJF',
            'DK' => 'DKK',
            'DM' => 'XCD',
            'DO' => 'DOP',
            'DZ' => 'DZD',
            'EC' => 'USD',
            'EE' => 'EUR',
            'EG' => 'EGP',
            'EH' => 'MAD',
            'ER' => 'ERN',
            'ES' => 'EUR',
            'ET' => 'ETB',
            'FI' => 'EUR',
            'FJ' => 'FJD',
            'FK' => 'FKP',
            'FM' => 'USD',
            'FO' => 'DKK',
            'FR' => 'EUR',
            'GA' => 'XAF',
            'GB' => 'GBP',
            'GD' => 'XCD',
            'GE' => 'GEL',
            'GF' => 'EUR',
            'GG' => 'GGP',
            'GH' => 'GHS',
            'GI' => 'GIP',
            'GL' => 'DKK',
            'GM' => 'GMD',
            'GN' => 'GNF',
            'GP' => 'EUR',
            'GQ' => 'XAF',
            'GR' => 'EUR',
            'GS' => 'GBP',
            'GT' => 'GTQ',
            'GU' => 'USD',
            'GW' => 'XOF',
            'GY' => 'GYD',
            'HK' => 'HKD',
            'HM' => 'AUD',
            'HN' => 'HNL',
            'HR' => 'HRK',
            'HT' => 'HTG',
            'HU' => 'HUF',
            'ID' => 'IDR',
            'IE' => 'EUR',
            'IL' => 'ILS',
            'IM' => 'IMP',
            'IN' => 'INR',
            'IO' => 'USD',
            'IQ' => 'IQD',
            'IR' => 'IRR',
            'IS' => 'ISK',
            'IT' => 'EUR',
            'JE' => 'JEP',
            'JM' => 'JMD',
            'JO' => 'JOD',
            'JP' => 'JPY',
            'KE' => 'KES',
            'KG' => 'KGS',
            'KH' => 'KHR',
            'KI' => 'AUD',
            'KM' => 'KMF',
            'KN' => 'XCD',
            'KP' => 'KPW',
            'KR' => 'KRW',
            'KW' => 'KWD',
            'KY' => 'KYD',
            'KZ' => 'KZT',
            'LA' => 'LAK',
            'LB' => 'LBP',
            'LC' => 'XCD',
            'LI' => 'CHF',
            'LK' => 'LKR',
            'LR' => 'LRD',
            'LS' => 'LSL',
            'LT' => 'EUR',
            'LU' => 'EUR',
            'LV' => 'EUR',
            'LY' => 'LYD',
            'MA' => 'MAD',
            'MC' => 'EUR',
            'MD' => 'MDL',
            'ME' => 'EUR',
            'MG' => 'MGA',
            'MH' => 'USD',
            'MK' => 'MKD',
            'ML' => 'XOF',
            'MM' => 'MMK',
            'MN' => 'MNT',
            'MO' => 'MOP',
            'MP' => 'USD',
            'MQ' => 'EUR',
            'MR' => 'MRO',
            'MS' => 'XCD',
            'MT' => 'EUR',
            'MU' => 'MUR',
            'MV' => 'MVR',
            'MW' => 'MWK',
            'MX' => 'MXN',
            'MY' => 'MYR',
            'MZ' => 'MZN',
            'NA' => 'NAD',
            'NC' => 'XPF',
            'NE' => 'XOF',
            'NF' => 'AUD',
            'NG' => 'NGN',
            'NI' => 'NIO',
            'NL' => 'EUR',
            'NO' => 'NOK',
            'NP' => 'NPR',
            'NR' => 'AUD',
            'NU' => 'NZD',
            'NZ' => 'NZD',
            'OM' => 'OMR',
            'PA' => 'PAB',
            'PE' => 'PEN',
            'PF' => 'XPF',
            'PG' => 'PGK',
            'PH' => 'PHP',
            'PK' => 'PKR',
            'PL' => 'PLN',
            'PM' => 'EUR',
            'PN' => 'GBP',
            'PR' => 'USD',
            'PS' => 'ILS',
            'PT' => 'EUR',
            'PW' => 'USD',
            'PY' => 'PYG',
            'QA' => 'QAR',
            'RE' => 'EUR',
            'RO' => 'RON',
            'RS' => 'RSD',
            'RU' => 'RUB',
            'RW' => 'RWF',
            'SA' => 'SAR',
            'SB' => 'SBD',
            'SC' => 'SCR',
            'SD' => 'SDG',
            'SE' => 'SEK',
            'SG' => 'SGD',
            'SH' => 'SHP',
            'SI' => 'EUR',
            'SJ' => 'NOK',
            'SK' => 'EUR',
            'SL' => 'SLL',
            'SM' => 'EUR',
            'SN' => 'XOF',
            'SO' => 'SOS',
            'SR' => 'SRD',
            'SS' => 'SSP',
            'ST' => 'STD',
            'SV' => 'USD',
            'SX' => 'ANG',
            'SY' => 'SYP',
            'SZ' => 'SZL',
            'TC' => 'USD',
            'TD' => 'XAF',
            'TF' => 'EUR',
            'TG' => 'XOF',
            'TH' => 'THB',
            'TJ' => 'TJS',
            'TK' => 'NZD',
            'TL' => 'USD',
            'TM' => 'TMT',
            'TN' => 'TND',
            'TO' => 'TOP',
            'TR' => 'TRY',
            'TT' => 'TTD',
            'TV' => 'AUD',
            'TW' => 'TWD',
            'TZ' => 'TZS',
            'UA' => 'UAH',
            'UG' => 'UGX',
            'US' => 'USD',
            'UY' => 'UYU',
            'UZ' => 'UZS',
            'VA' => 'EUR',
            'VC' => 'XCD',
            'VE' => 'VEF',
            'VG' => 'USD',
            'VI' => 'USD',
            'VN' => 'VND',
            'VU' => 'VUV',
            'WF' => 'XPF',
            'WS' => 'WST',
            'XK' => 'EUR',
            'YE' => 'YER',
            'YT' => 'EUR',
            'ZA' => 'ZAR',
            'ZM' => 'ZMK',
            'ZW' => 'ZWL',
        ],
    ],

];
