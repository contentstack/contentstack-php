

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Contentstack" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Contentstack.html">Contentstack</a></div><div class="bd"><ul><li data-name="namespace:Contentstack_Error" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Contentstack/Error.html">Error</a></div><div class="bd"><ul><li data-name="class:Contentstack_Error_CSException" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Error/CSException.html">CSException</a></div></li></ul></div></li><li data-name="namespace:Contentstack_Stack" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Contentstack/Stack.html">Stack</a></div><div class="bd"><ul><li data-name="namespace:Contentstack_Stack_ContentType" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Contentstack/Stack/ContentType.html">ContentType</a></div><div class="bd"><ul><li data-name="class:Contentstack_Stack_ContentType_Entry" ><div style="padding-left:62px" class="hd leaf"><a href="Contentstack/Stack/ContentType/Entry.html">Entry</a></div></li><li data-name="class:Contentstack_Stack_ContentType_Query" ><div style="padding-left:62px" class="hd leaf"><a href="Contentstack/Stack/ContentType/Query.html">Query</a></div></li></ul></div></li><li data-name="class:Contentstack_Stack_Assets" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Stack/Assets.html">Assets</a></div></li><li data-name="class:Contentstack_Stack_BaseQuery" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Stack/BaseQuery.html">BaseQuery</a></div></li><li data-name="class:Contentstack_Stack_ContentType" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Stack/ContentType.html">ContentType</a></div></li><li data-name="class:Contentstack_Stack_Result" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Stack/Result.html">Result</a></div></li><li data-name="class:Contentstack_Stack_Stack" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Stack/Stack.html">Stack</a></div></li></ul></div></li><li data-name="namespace:Contentstack_Support" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Contentstack/Support.html">Support</a></div><div class="bd"><ul><li data-name="class:Contentstack_Support_Utility" ><div style="padding-left:44px" class="hd leaf"><a href="Contentstack/Support/Utility.html">Utility</a></div></li></ul></div></li><li data-name="class:Contentstack_Contentstack" class="opened"><div style="padding-left:26px" class="hd leaf"><a href="Contentstack/Contentstack.html">Contentstack</a></div></li><li data-name="class:Contentstack_ContentstackRegion" class="opened"><div style="padding-left:26px" class="hd leaf"><a href="Contentstack/ContentstackRegion.html">ContentstackRegion</a></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Contentstack.html","name":"Contentstack","doc":"Namespace Contentstack"},{"type":"Namespace","link":"Contentstack/Error.html","name":"Contentstack\\Error","doc":"Namespace Contentstack\\Error"},{"type":"Namespace","link":"Contentstack/Stack.html","name":"Contentstack\\Stack","doc":"Namespace Contentstack\\Stack"},{"type":"Namespace","link":"Contentstack/Stack/ContentType.html","name":"Contentstack\\Stack\\ContentType","doc":"Namespace Contentstack\\Stack\\ContentType"},{"type":"Namespace","link":"Contentstack/Support.html","name":"Contentstack\\Support","doc":"Namespace Contentstack\\Support"},                                                        {"type":"Class","fromName":"Contentstack","fromLink":"Contentstack.html","link":"Contentstack/Contentstack.html","name":"Contentstack\\Contentstack","doc":"Contentstack abstract class to provide access to Stack Object"},
                                {"type":"Method","fromName":"Contentstack\\Contentstack","fromLink":"Contentstack/Contentstack.html","link":"Contentstack/Contentstack.html#method_Stack","name":"Contentstack\\Contentstack::Stack","doc":"Static method for the Stack constructor"},
        {"type":"Method","fromName":"Contentstack\\Contentstack","fromLink":"Contentstack/Contentstack.html","link":"Contentstack/Contentstack.html#method_renderContent","name":"Contentstack\\Contentstack::renderContent","doc":null},
        {"type":"Method","fromName":"Contentstack\\Contentstack","fromLink":"Contentstack/Contentstack.html","link":"Contentstack/Contentstack.html#method_renderContents","name":"Contentstack\\Contentstack::renderContents","doc":null},
            
                                                {"type":"Class","fromName":"Contentstack","fromLink":"Contentstack.html","link":"Contentstack/ContentstackRegion.html","name":"Contentstack\\ContentstackRegion","doc":"Contentstack Regions"},
                
                                                {"type":"Class","fromName":"Contentstack\\Error","fromLink":"Contentstack/Error.html","link":"Contentstack/Error/CSException.html","name":"Contentstack\\Error\\CSException","doc":"CSException\nCSException Class is used to wrap the REST API error"},
                                {"type":"Method","fromName":"Contentstack\\Error\\CSException","fromLink":"Contentstack/Error/CSException.html","link":"Contentstack/Error/CSException.html#method___construct","name":"Contentstack\\Error\\CSException::__construct","doc":"CSException Class to initalize your ContentType"},
        {"type":"Method","fromName":"Contentstack\\Error\\CSException","fromLink":"Contentstack/Error/CSException.html","link":"Contentstack/Error/CSException.html#method_getStatusCode","name":"Contentstack\\Error\\CSException::getStatusCode","doc":"To get http status_code of the current exception"},
        {"type":"Method","fromName":"Contentstack\\Error\\CSException","fromLink":"Contentstack/Error/CSException.html","link":"Contentstack/Error/CSException.html#method_getErrors","name":"Contentstack\\Error\\CSException::getErrors","doc":"Returns error details of current exception"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack","fromLink":"Contentstack/Stack.html","link":"Contentstack/Stack/Assets.html","name":"Contentstack\\Stack\\Assets","doc":"Assets refer to all the media files (images, videos, PDFs,\naudio files, and so on) uploaded in your Contentstack\nrepository for future use."},
                                {"type":"Method","fromName":"Contentstack\\Stack\\Assets","fromLink":"Contentstack/Stack/Assets.html","link":"Contentstack/Stack/Assets.html#method___construct","name":"Contentstack\\Stack\\Assets::__construct","doc":"Assets constructor"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Assets","fromLink":"Contentstack/Stack/Assets.html","link":"Contentstack/Stack/Assets.html#method_Query","name":"Contentstack\\Stack\\Assets::Query","doc":"Query object to create the \"Query\" on the specified ContentType"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Assets","fromLink":"Contentstack/Stack/Assets.html","link":"Contentstack/Stack/Assets.html#method_fetch","name":"Contentstack\\Stack\\Assets::fetch","doc":"Fetch the specified assets"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack","fromLink":"Contentstack/Stack.html","link":"Contentstack/Stack/BaseQuery.html","name":"Contentstack\\Stack\\BaseQuery","doc":"BaseQuery\nBase Class where all the Queries will be created"},
                                {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method___construct","name":"Contentstack\\Stack\\BaseQuery::__construct","doc":"BaseQuery constructor"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_toJSON","name":"Contentstack\\Stack\\BaseQuery::toJSON","doc":"To transform the Result object to server response content"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_except","name":"Contentstack\\Stack\\BaseQuery::except","doc":"To exclude the fields from the result set"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_only","name":"Contentstack\\Stack\\BaseQuery::only","doc":"To project the fields in the result set"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeReference","name":"Contentstack\\Stack\\BaseQuery::includeReference","doc":"To include reference(s) of other content type in entries"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_search","name":"Contentstack\\Stack\\BaseQuery::search","doc":"To search the given string in the entries"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_regex","name":"Contentstack\\Stack\\BaseQuery::regex","doc":"To perform the regular expression test on the specified field"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_logicalAND","name":"Contentstack\\Stack\\BaseQuery::logicalAND","doc":"Logical AND queries are pushed"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_logicalOR","name":"Contentstack\\Stack\\BaseQuery::logicalOR","doc":"Logical OR queries are pushed"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_ascending","name":"Contentstack\\Stack\\BaseQuery::ascending","doc":"To sort the entries in ascending order of the specified field"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_descending","name":"Contentstack\\Stack\\BaseQuery::descending","doc":"To sort the entries in descending order of the specified field"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_notExists","name":"Contentstack\\Stack\\BaseQuery::notExists","doc":"To check field doesn't exists"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_exists","name":"Contentstack\\Stack\\BaseQuery::exists","doc":"To check field exists"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeFallback","name":"Contentstack\\Stack\\BaseQuery::includeFallback","doc":"To include fallback content if specified locale content is not publish."},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeSchema","name":"Contentstack\\Stack\\BaseQuery::includeSchema","doc":"To include schema along with entries"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeReferenceContentTypeUID","name":"Contentstack\\Stack\\BaseQuery::includeReferenceContentTypeUID","doc":"This method includes the content type UIDs of\nthe referenced entries returned in the response."},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeContentType","name":"Contentstack\\Stack\\BaseQuery::includeContentType","doc":"To include content_type along with entries"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeEmbeddedItems","name":"Contentstack\\Stack\\BaseQuery::includeEmbeddedItems","doc":"To include Embedded Items along with entries"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeCount","name":"Contentstack\\Stack\\BaseQuery::includeCount","doc":"To include the count of entries based on the results"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_count","name":"Contentstack\\Stack\\BaseQuery::count","doc":"To get only count result"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_includeOwner","name":"Contentstack\\Stack\\BaseQuery::includeOwner","doc":"To include the owner of entries based on the results"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_addParam","name":"Contentstack\\Stack\\BaseQuery::addParam","doc":"To add query parameter in query"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_language","name":"Contentstack\\Stack\\BaseQuery::language","doc":"To set the language code in the query"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_skip","name":"Contentstack\\Stack\\BaseQuery::skip","doc":"Skip the specified number of entries from result set"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_tags","name":"Contentstack\\Stack\\BaseQuery::tags","doc":"Result set entries should have tags specified"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_limit","name":"Contentstack\\Stack\\BaseQuery::limit","doc":"Limit the specified number of entries from result set"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_containedIn","name":"Contentstack\\Stack\\BaseQuery::containedIn","doc":"Query the field value from the given set of values"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_notContainedIn","name":"Contentstack\\Stack\\BaseQuery::notContainedIn","doc":"Query the field value other than the given set of values"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_where","name":"Contentstack\\Stack\\BaseQuery::where","doc":"Query the field which has exact value as specified"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_lessThan","name":"Contentstack\\Stack\\BaseQuery::lessThan","doc":"Query the field which has less value than specified one"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_lessThanEqualTo","name":"Contentstack\\Stack\\BaseQuery::lessThanEqualTo","doc":"Query the field which has less or equal value than specified one"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_greaterThan","name":"Contentstack\\Stack\\BaseQuery::greaterThan","doc":"Query the field which has greater value than specified one"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_greaterThanEqualTo","name":"Contentstack\\Stack\\BaseQuery::greaterThanEqualTo","doc":"Query the field which has greater or equal value than specified one"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_notEqualTo","name":"Contentstack\\Stack\\BaseQuery::notEqualTo","doc":"Query the field which has not equal to value than specified one"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_addQuery","name":"Contentstack\\Stack\\BaseQuery::addQuery","doc":"Add Query is used to add the raw/array query to filter the entries"},
        {"type":"Method","fromName":"Contentstack\\Stack\\BaseQuery","fromLink":"Contentstack/Stack/BaseQuery.html","link":"Contentstack/Stack/BaseQuery.html#method_getQuery","name":"Contentstack\\Stack\\BaseQuery::getQuery","doc":"Get the raw/array query from the current instance of Query/Entry"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack","fromLink":"Contentstack/Stack.html","link":"Contentstack/Stack/ContentType.html","name":"Contentstack\\Stack\\ContentType","doc":"Class ContentType"},
                                {"type":"Method","fromName":"Contentstack\\Stack\\ContentType","fromLink":"Contentstack/Stack/ContentType.html","link":"Contentstack/Stack/ContentType.html#method___construct","name":"Contentstack\\Stack\\ContentType::__construct","doc":"ContentType\nContentType Class to initalize your ContentType"},
        {"type":"Method","fromName":"Contentstack\\Stack\\ContentType","fromLink":"Contentstack/Stack/ContentType.html","link":"Contentstack/Stack/ContentType.html#method_Entry","name":"Contentstack\\Stack\\ContentType::Entry","doc":"Entry object to create the \"Query\" on the specified ContentType"},
        {"type":"Method","fromName":"Contentstack\\Stack\\ContentType","fromLink":"Contentstack/Stack/ContentType.html","link":"Contentstack/Stack/ContentType.html#method_fetch","name":"Contentstack\\Stack\\ContentType::fetch","doc":"Fetch the specific contenttypes"},
        {"type":"Method","fromName":"Contentstack\\Stack\\ContentType","fromLink":"Contentstack/Stack/ContentType.html","link":"Contentstack/Stack/ContentType.html#method_Query","name":"Contentstack\\Stack\\ContentType::Query","doc":"Query object to create the \"Query\" on the specified ContentType"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack\\ContentType","fromLink":"Contentstack/Stack/ContentType.html","link":"Contentstack/Stack/ContentType/Entry.html","name":"Contentstack\\Stack\\ContentType\\Entry","doc":"Entry"},
                                {"type":"Method","fromName":"Contentstack\\Stack\\ContentType\\Entry","fromLink":"Contentstack/Stack/ContentType/Entry.html","link":"Contentstack/Stack/ContentType/Entry.html#method___construct","name":"Contentstack\\Stack\\ContentType\\Entry::__construct","doc":"Entry Class to initalize your Entry"},
        {"type":"Method","fromName":"Contentstack\\Stack\\ContentType\\Entry","fromLink":"Contentstack/Stack/ContentType/Entry.html","link":"Contentstack/Stack/ContentType/Entry.html#method_fetch","name":"Contentstack\\Stack\\ContentType\\Entry::fetch","doc":"Fetch the specified entry"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack\\ContentType","fromLink":"Contentstack/Stack/ContentType.html","link":"Contentstack/Stack/ContentType/Query.html","name":"Contentstack\\Stack\\ContentType\\Query","doc":"Class Query"},
                                {"type":"Method","fromName":"Contentstack\\Stack\\ContentType\\Query","fromLink":"Contentstack/Stack/ContentType/Query.html","link":"Contentstack/Stack/ContentType/Query.html#method___construct","name":"Contentstack\\Stack\\ContentType\\Query::__construct","doc":"Query Class to initalize your Query"},
        {"type":"Method","fromName":"Contentstack\\Stack\\ContentType\\Query","fromLink":"Contentstack/Stack/ContentType/Query.html","link":"Contentstack/Stack/ContentType/Query.html#method_find","name":"Contentstack\\Stack\\ContentType\\Query::find","doc":"Get all entries based on the specified subquery"},
        {"type":"Method","fromName":"Contentstack\\Stack\\ContentType\\Query","fromLink":"Contentstack/Stack/ContentType/Query.html","link":"Contentstack/Stack/ContentType/Query.html#method_findOne","name":"Contentstack\\Stack\\ContentType\\Query::findOne","doc":"Get single entry based on the specified subquery"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack","fromLink":"Contentstack/Stack.html","link":"Contentstack/Stack/Result.html","name":"Contentstack\\Stack\\Result","doc":"Class Result"},
                                {"type":"Method","fromName":"Contentstack\\Stack\\Result","fromLink":"Contentstack/Stack/Result.html","link":"Contentstack/Stack/Result.html#method___construct","name":"Contentstack\\Stack\\Result::__construct","doc":"Result constructor\nResult wrapper over the plain result for the future"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Result","fromLink":"Contentstack/Stack/Result.html","link":"Contentstack/Stack/Result.html#method_toJSON","name":"Contentstack\\Stack\\Result::toJSON","doc":"To convert result object to json"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Result","fromLink":"Contentstack/Stack/Result.html","link":"Contentstack/Stack/Result.html#method_get","name":"Contentstack\\Stack\\Result::get","doc":"Get the keys from the object"},
            
                                                {"type":"Class","fromName":"Contentstack\\Stack","fromLink":"Contentstack/Stack.html","link":"Contentstack/Stack/Stack.html","name":"Contentstack\\Stack\\Stack","doc":"Stack Class to initialize the provided parameter Stack"},
                                {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method___construct","name":"Contentstack\\Stack\\Stack::__construct","doc":"Constructor of the Stack"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_ContentType","name":"Contentstack\\Stack\\Stack::ContentType","doc":"To initialize the ContentType object from\nwhere the content will be fetched/retrieved."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_Assets","name":"Contentstack\\Stack\\Stack::Assets","doc":"Assets Class to initalize your Assets"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_ImageTrasform","name":"Contentstack\\Stack\\Stack::ImageTrasform","doc":"ImageTrasform function is define for image manipulation with different"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getLastActivities","name":"Contentstack\\Stack\\Stack::getLastActivities","doc":"To get the last_activity information of the\nconfigured environment from all the content types"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_setHost","name":"Contentstack\\Stack\\Stack::setHost","doc":"To set the host on stack object"},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getHost","name":"Contentstack\\Stack\\Stack::getHost","doc":"This function returns host."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_setProtocol","name":"Contentstack\\Stack\\Stack::setProtocol","doc":"This function sets protocol."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getProtocol","name":"Contentstack\\Stack\\Stack::getProtocol","doc":"This function return protocol type."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_setPort","name":"Contentstack\\Stack\\Stack::setPort","doc":"This function sets Port."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getPort","name":"Contentstack\\Stack\\Stack::getPort","doc":"This function return Port."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_setAPIKEY","name":"Contentstack\\Stack\\Stack::setAPIKEY","doc":"This function sets API Key."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_setDeliveryToken","name":"Contentstack\\Stack\\Stack::setDeliveryToken","doc":"This function sets Delivery Token."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_setEnvironment","name":"Contentstack\\Stack\\Stack::setEnvironment","doc":"This function sets environment name."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getAPIKEY","name":"Contentstack\\Stack\\Stack::getAPIKEY","doc":"This function returns API Key."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_DeliveryToken","name":"Contentstack\\Stack\\Stack::DeliveryToken","doc":"This function returns Delivery Token."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getEnvironment","name":"Contentstack\\Stack\\Stack::getEnvironment","doc":"This function returns environment name."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_getContentTypes","name":"Contentstack\\Stack\\Stack::getContentTypes","doc":"This call returns comprehensive information of all\nthe content types available in a particular stack in your account."},
        {"type":"Method","fromName":"Contentstack\\Stack\\Stack","fromLink":"Contentstack/Stack/Stack.html","link":"Contentstack/Stack/Stack.html#method_sync","name":"Contentstack\\Stack\\Stack::sync","doc":"Syncs your Contentstack data with your app and ensures that the data is always up-to-date by providing delta updates"},
            
                                                {"type":"Class","fromName":"Contentstack\\Support","fromLink":"Contentstack/Support.html","link":"Contentstack/Support/Utility.html","name":"Contentstack\\Support\\Utility","doc":"Utility/Helper where all the helper and utility functions will be available."},
                                {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_validateInput","name":"Contentstack\\Support\\Utility::validateInput","doc":"Validation for all the parameters required for the SDK"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_getDomain","name":"Contentstack\\Support\\Utility::getDomain","doc":"Get the domain from the current object"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_contentstackUrl","name":"Contentstack\\Support\\Utility::contentstackUrl","doc":"Contentstack URL method to create the url based on the request"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_headers","name":"Contentstack\\Support\\Utility::headers","doc":"Header transformation as it required format"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_generateQuery","name":"Contentstack\\Support\\Utility::generateQuery","doc":"POST formatted query for the API server"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_generateQueryParams","name":"Contentstack\\Support\\Utility::generateQueryParams","doc":"Sending the GET requests with all the parameters in POST as well as GET"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_wrapResult","name":"Contentstack\\Support\\Utility::wrapResult","doc":"Wrap Result"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_contentstackRequest","name":"Contentstack\\Support\\Utility::contentstackRequest","doc":"Contentstack request to the API server based on the data"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_isKeySet","name":"Contentstack\\Support\\Utility::isKeySet","doc":"Validate the key is set or not"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_isEmpty","name":"Contentstack\\Support\\Utility::isEmpty","doc":"Validate the String"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_getLastActivites","name":"Contentstack\\Support\\Utility::getLastActivites","doc":"Get Last activities"},
        {"type":"Method","fromName":"Contentstack\\Support\\Utility","fromLink":"Contentstack/Support/Utility.html","link":"Contentstack/Support/Utility.html#method_debug","name":"Contentstack\\Support\\Utility::debug","doc":"DEBUGGING MESSAGE"},
            
                                // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


