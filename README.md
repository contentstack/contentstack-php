[![Built.io Contentstack](https://contentstackdocs.built.io/static/images/logo.png)](http://contentstack.io)

# PHP SDK for Built.io Contentstack
Built.io Contentstack is headless CMS with which users can build powerful platform independent applications.

PHP SDK uses Built.io Contentstack Delivery API([REST](https://contentstackdocs.built.io/developer/restapi)) to deliver the content on demand.

## Prerequisite
 - PHP >= 5.5.0

## Setup and Installation

 - Download/Clone the SDK.
 - Paste the downloaded SDK.zip to your favorite folder
 - ​Let's get started with implementation as follows

## Initialize the Stack

```
use Contentstack\Contentstack;
include_once "contentstack/index.php";

$stack = Contentstack::Stack(API_KEY, ACCESS_TOKEN, ENV_NAME);

```

## Query the content

```bash
$result = $stack->ContentType(CONTENT_TYPE_UID)->Query()->toJSON()->includeCount()->includeContentType()->find()
$result[0] - array of entries
$result[1] - content type
$result[2] - count of the entries

```

## Fetch the content

```bash
$result = $stack->ContentType(CONTENT_TYPE_UID)->Entry(ENTRY_UID)->toJSON()->fetch()
$result - entry object

```

## Next steps
 - [Key Concepts](https://contentstackdocs.built.io/developer/concepts)
 - [API Reference](/)
 
## Links
- [Website](http://contentstack.io/)
- [Official Documentation](http://contentstackdocs.built.io/developer/web/quickstart)

### License
Copyright © 2012-2017 [Built.io](https://www.built.io/). All Rights Reserved.
