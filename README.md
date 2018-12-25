> **NOTE**: Fork of [Snowplow Referer Parser](https://github.com/snowplow-referer-parser/referer-parser)
  
# referer-parser

referer-parser is a database for extracting marketing attribution data (such as search terms) from referer URLs, inspired by the [ua-parser][ua-parser] project (an equivalent library for user agent parsing).

The referer-parser project also contains multiple libraries for working with the referer-parser database in different languages.

referer-parser is a core component of [Snowplow][snowplow], the open-source web-scale analytics platform powered by Hadoop and Redshift.

_Note that we always use the original HTTP misspelling of 'referer' (and thus 'referal') in this project - never 'referrer'._

## Database

The latest database is always available on this URL:

https://s3-eu-west-1.amazonaws.com/snowplow-hosted-assets/third-party/referer-parser/referers-latest.yml

The database is updated at most once a month. Each new version of the database is also uploaded with a timestamp:

https://s3-eu-west-1.amazonaws.com/snowplow-hosted-assets/third-party/referer-parser/referers-YYYY-MM.yml

If there is an issue with the database necessitating a re-release within the month, the corresponding files will be overwritten.

## Maintainers

* PHP: [Lars Strojny][lstrojny]
* `referers.yml`: [Snowplow Analytics][snowplow-analytics]

## Usage

The PHP version of this library uses the updated API, and identifies search, social, webmail, internal and unknown referers:

```php
use Snowplow\RefererParser\Parser;

$parser = new Parser();
$referer = $parser->parse(
    'http://www.google.com/search?q=gateway+oracle+cards+denise+linn&hl=en&client=safari',
    'http://www.psychicbazaar.com/shop'
);

if ($referer->isKnown()) {
    echo $referer->getMedium(); // "Search"
    echo $referer->getSource(); // "Google"
    echo $referer->getSearchTerm();   // "gateway oracle cards denise linn"
}
```

For more information, please see the PHP [README][php-readme].

## Contributing

We welcome contributions to referer-parser:

1. **New search engines and other referers** - if you notice a search engine, social network or other site missing from `referers.yml`, please fork the repo, add the missing entry and submit a pull request
2. **Ports of referer-parser to other languages** - we welcome ports of referer-parser to new programming languages (e.g. Lua, Go, Haskell, C)
3. **Bug fixes, feature requests etc** - much appreciated!

**Please sign the [Snowplow CLA][cla] before making pull requests.**

## Support

General support for referer-parser is handled by the team at Snowplow Analytics Ltd.

You can contact the Snowplow Analytics team through any of the [channels listed on their wiki][talk-to-us].

## Copyright and license

`referers.yml` is based on [Piwik's][piwik] [`SearchEngines.php`][piwik-search-engines] and [`Socials.php`][piwik-socials], copyright 2012 Matthieu Aubry and available under the [GNU General Public License v3][gpl-license].

The PHP port is copyright 2013-2014 [Lars Strojny][lstrojny] and is available under the [MIT License][mit-license].

[ua-parser]: https://github.com/tobie/ua-parser

[snowplow]: https://github.com/snowplow/snowplow
[snowplow-analytics]: http://snowplowanalytics.com
[lstrojny]: https://github.com/lstrojny

[piwik]: http://piwik.org
[piwik-search-engines]: https://github.com/piwik/piwik/blob/master/core/DataFiles/SearchEngines.php
[piwik-socials]: https://github.com/piwik/piwik/blob/master/core/DataFiles/Socials.php

[php-readme]: https://github.com/snowplow/referer-parser/blob/master/php/README.md
[referers-yml]: https://github.com/snowplow/referer-parser/blob/master/resources/referers.yml

[talk-to-us]: https://github.com/snowplow/snowplow/wiki/Talk-to-us

[apache-license]: http://www.apache.org/licenses/LICENSE-2.0
[gpl-license]: http://www.gnu.org/licenses/gpl-3.0.html
[mit-license]: http://opensource.org/licenses/MIT
[cla]: https://github.com/snowplow/snowplow/wiki/CLA
