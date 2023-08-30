
## CHANGELOG
------------------------------------------------
## Version 2.3.4
###### Date: 30-Aug-2023
### Enhancement
    - PHP version 8.2 support

------------------------------------------------
## Version 2.3.3
###### Date: 31-Mar-2023
### Enhancement
    - add support for include_metada for PHP SDK
    - set default region to 'us'
    - Issue while fetching the entry using PHP SDK

------------------------------------------------
## Version 2.3.2
###### Date: 01-Feb-2023
### Enhancement
    - Live preview reference entry extra field issue resolved

------------------------------------------------
## Version 2.3.1
###### Date: 09-Sep-2022
### Enhancement
    - Reference update within entry support added in live preview.

------------------------------------------------
## Version 2.3.0
###### Date: 17-Aug-2022
### New Feature
    - Http request proxy support
    - Retry request on failure

------------------------------------------------
## Version 2.2.1
###### Date: 14-Jan-2022
### Bug Fix
    - Host bug for live preview resolved

------------------------------------------------
## Version 2.2.0
###### Date: 08-Dec-2021
### New Feature
    - Live Preview feature added

------------------------------------------------

## Version 2.1.1
###### Date: 16-Jul-2021
### New Feature
    - Utils SDK package update to support Json RTE to Html Parsing

------------------------------------------------

## Version 2.1.0
###### Date: 06-Apr-2021
### Enhancement
 - includeEmbeddedItems function added in Entry and Query Module
 - Utils SDK support added in SDK

------------------------------------------------

## Version 2.0.0
###### Date: 02-Apr-2021
### New Feature
 - Sync API support added
### Enhancement
 - Added PSR 4 Standardized implementation.

------------------------------------------------

## Version 1.8.1
###### Date: 17-Mar-2021
### Bug Fix
- Updated addQuery method to pass non encoded Json to Query object
- Removed parameter check on functions those pass default values.

------------------------------------------------

## Version 1.8.0
###### Date: 5-Dec-2020
### New Feature
    - Entry
      - Added support for function 'includeFallback'
    - Query 
      - Added support for function 'includeFallback'

------------------------------------------------

## Version 1.7.0
###### Date: 27-Oct-2020
### New Feature
    - Packagist support added 

------------------------------------------------

## Version 1.6.1
###### Date: 08-May-2020
### Bug
    - Stack api key and access token moved to header
------------------------------------------------

## Version 1.6.0
###### Date: 04-Mar-2020
### Bug
    - Issue in Asset for conflict in name of Query function has been resolved, Updated BaseQuery function name to addQuery.

------------------------------------------------

## Version 1.5.1
###### Date: 17-Feb-2020
### Bug
    - Query array passing issue resolved

------------------------------------------------

## Version 1.5.0
###### Date: 21-Nov-2019
### New Feature
    - Region support added

------------------------------------------------

## Version 1.4.0
###### Date: 18-Nov-2019
### Enhancement
    - Stack 
        - Added support for function 'getContentType'
    - ContentType
        - updated function 'fetch'
    - Query
        - Added support for function 'includeContentType'

------------------------------------------------

## Version 1.3.0
###### Date: 02-Aug-2019 
### Enhancement
    - Query and Entry
        - 'includeReferenceContentTypeUID' method includes the content type UIDs of the referenced entries returned in the response.

------------------------------------------------

## Version 1.2.1
###### Date: 25-May-2019
### Bug
    - Made changes in helper file for fetching proper data on language query

------------------------------------------------

## Version 1.2.1
###### Date: 19-Sept-2018
### Bug
    - Replaced the createError method with New method contentstackcreateError.

------------------------------------------------

## Version 1.2.0
###### Date: 21-Dec-2017
### Enhancement
    - Entry 
        - 'addparam' method added
    - Query  
        - 'addparam' method added
    - Asset 
        - 'addparam' method added

------------------------------------------------

## Version 1.1.0
###### Date: 09-Nov-2017
### Enhancement
    - Image Optimisation support added
### Deprecated
    - Deprecated includeSchema and added includeContentType in query

------------------------------------------------