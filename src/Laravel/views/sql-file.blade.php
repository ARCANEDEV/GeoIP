DROP TABLE IF EXISTS {{ $nationsTable }};

CREATE TABLE {{ $nationsTable }} (
ip int(11) unsigned NOT NULL default '0',
code char(2) NOT NULL default '',
KEY ip (ip)
);

DROP TABLE IF EXISTS {{ $countriesTable }};

CREATE TABLE {{ $countriesTable }} (
code varchar(4) NOT NULL default '',
iso_code_2 varchar(2) NOT NULL default '',
iso_code_3 varchar(3) default '',
iso_country varchar(255) NOT NULL default '',
country varchar(255) NOT NULL default '',
lat float NOT NULL default '0',
lon float NOT NULL default '0',
PRIMARY KEY  (code),
KEY code (code)
);

@foreach($nationsSeeds as $nation)
    INSERT INTO ip2nation (ip, country) VALUES ({{ $nation['ip'] }}, '{{ $nation['code'] }}');
@endforeach

@foreach($countriesSeeds as $country)
    INSERT INTO ip2nationCountries (code, iso_code_2, iso_code_3, iso_country, country, lat, lon) VALUES ('{{ $country['code'] }}', '{{ $country['iso_code_2'] }}', '{{ $country['iso_code_3'] }}', '{{ $country['iso_country'] }}', '{{ $country['country'] }}', {{ $country['lat'] }}, {{ $country['lon'] }});
@endforeach