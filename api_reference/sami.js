
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Contentstack" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack.html">Contentstack</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Contentstack_Error" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Error.html">Error</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Error_CSException" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Contentstack/Error/CSException.html">CSException</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Contentstack_Result" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Result.html">Result</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Result_Result" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Contentstack/Result/Result.html">Result</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Contentstack_Stack" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Stack.html">Stack</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Contentstack_Stack_Assets" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Stack/Assets.html">Assets</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Stack_Assets_Assets" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Contentstack/Stack/Assets/Assets.html">Assets</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Contentstack_Stack_ContentType" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Stack/ContentType.html">ContentType</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Contentstack_Stack_ContentType_BaseQuery" >                    <div style="padding-left:54px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Stack/ContentType/BaseQuery.html">BaseQuery</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Stack_ContentType_BaseQuery_BaseQuery" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html">BaseQuery</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Contentstack_Stack_ContentType_Entry" >                    <div style="padding-left:54px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Stack/ContentType/Entry.html">Entry</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Stack_ContentType_Entry_Entry" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="Contentstack/Stack/ContentType/Entry/Entry.html">Entry</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Contentstack_Stack_ContentType_Query" >                    <div style="padding-left:54px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Stack/ContentType/Query.html">Query</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Stack_ContentType_Query_Query" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="Contentstack/Stack/ContentType/Query/Query.html">Query</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Contentstack_Stack_ContentType_ContentType" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Contentstack/Stack/ContentType/ContentType.html">ContentType</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Contentstack_Stack_Stack" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Contentstack/Stack/Stack.html">Stack</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Contentstack_Support" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Contentstack/Support.html">Support</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Contentstack_Support_Utility" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Contentstack/Support/Utility.html">Utility</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Contentstack_Contentstack" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Contentstack/Contentstack.html">Contentstack</a>                    </div>                </li>                            <li data-name="class:Contentstack_ContentstackRegion" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Contentstack/ContentstackRegion.html">ContentstackRegion</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Contentstack.html", "name": "Contentstack", "doc": "Namespace Contentstack"},{"type": "Namespace", "link": "Contentstack/Error.html", "name": "Contentstack\\Error", "doc": "Namespace Contentstack\\Error"},{"type": "Namespace", "link": "Contentstack/Result.html", "name": "Contentstack\\Result", "doc": "Namespace Contentstack\\Result"},{"type": "Namespace", "link": "Contentstack/Stack.html", "name": "Contentstack\\Stack", "doc": "Namespace Contentstack\\Stack"},{"type": "Namespace", "link": "Contentstack/Stack/Assets.html", "name": "Contentstack\\Stack\\Assets", "doc": "Namespace Contentstack\\Stack\\Assets"},{"type": "Namespace", "link": "Contentstack/Stack/ContentType.html", "name": "Contentstack\\Stack\\ContentType", "doc": "Namespace Contentstack\\Stack\\ContentType"},{"type": "Namespace", "link": "Contentstack/Stack/ContentType/BaseQuery.html", "name": "Contentstack\\Stack\\ContentType\\BaseQuery", "doc": "Namespace Contentstack\\Stack\\ContentType\\BaseQuery"},{"type": "Namespace", "link": "Contentstack/Stack/ContentType/Entry.html", "name": "Contentstack\\Stack\\ContentType\\Entry", "doc": "Namespace Contentstack\\Stack\\ContentType\\Entry"},{"type": "Namespace", "link": "Contentstack/Stack/ContentType/Query.html", "name": "Contentstack\\Stack\\ContentType\\Query", "doc": "Namespace Contentstack\\Stack\\ContentType\\Query"},{"type": "Namespace", "link": "Contentstack/Support.html", "name": "Contentstack\\Support", "doc": "Namespace Contentstack\\Support"},
            
            {"type": "Class", "fromName": "Contentstack", "fromLink": "Contentstack.html", "link": "Contentstack/Contentstack.html", "name": "Contentstack\\Contentstack", "doc": "&quot;Contentstack abstract class to provide access to Stack Object&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Contentstack", "fromLink": "Contentstack/Contentstack.html", "link": "Contentstack/Contentstack.html#method_Stack", "name": "Contentstack\\Contentstack::Stack", "doc": "&quot;Static method for the Stack constructor&quot;"},
            
            {"type": "Class", "fromName": "Contentstack", "fromLink": "Contentstack.html", "link": "Contentstack/ContentstackRegion.html", "name": "Contentstack\\ContentstackRegion", "doc": "&quot;Contentstack Regions&quot;"},
                    
            {"type": "Class", "fromName": "Contentstack\\Error", "fromLink": "Contentstack/Error.html", "link": "Contentstack/Error/CSException.html", "name": "Contentstack\\Error\\CSException", "doc": "&quot;CSException\nCSException Class is used to wrap the REST API error&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Error\\CSException", "fromLink": "Contentstack/Error/CSException.html", "link": "Contentstack/Error/CSException.html#method___construct", "name": "Contentstack\\Error\\CSException::__construct", "doc": "&quot;CSException Class to initalize your ContentType&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Error\\CSException", "fromLink": "Contentstack/Error/CSException.html", "link": "Contentstack/Error/CSException.html#method_getStatusCode", "name": "Contentstack\\Error\\CSException::getStatusCode", "doc": "&quot;To get http status_code of the current exception&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Error\\CSException", "fromLink": "Contentstack/Error/CSException.html", "link": "Contentstack/Error/CSException.html#method_getErrors", "name": "Contentstack\\Error\\CSException::getErrors", "doc": "&quot;Returns error details of current exception&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Result", "fromLink": "Contentstack/Result.html", "link": "Contentstack/Result/Result.html", "name": "Contentstack\\Result\\Result", "doc": "&quot;Class Result&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Result\\Result", "fromLink": "Contentstack/Result/Result.html", "link": "Contentstack/Result/Result.html#method___construct", "name": "Contentstack\\Result\\Result::__construct", "doc": "&quot;Result constructor\nResult wrapper over the plain result for the future&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Result\\Result", "fromLink": "Contentstack/Result/Result.html", "link": "Contentstack/Result/Result.html#method_toJSON", "name": "Contentstack\\Result\\Result::toJSON", "doc": "&quot;To convert result object to json&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Result\\Result", "fromLink": "Contentstack/Result/Result.html", "link": "Contentstack/Result/Result.html#method_get", "name": "Contentstack\\Result\\Result::get", "doc": "&quot;Get the keys from the object&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Stack\\Assets", "fromLink": "Contentstack/Stack/Assets.html", "link": "Contentstack/Stack/Assets/Assets.html", "name": "Contentstack\\Stack\\Assets\\Assets", "doc": "&quot;Assets refer to all the media files (images, videos, PDFs,\naudio files, and so on) uploaded in your Contentstack\nrepository for future use.&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Stack\\Assets\\Assets", "fromLink": "Contentstack/Stack/Assets/Assets.html", "link": "Contentstack/Stack/Assets/Assets.html#method___construct", "name": "Contentstack\\Stack\\Assets\\Assets::__construct", "doc": "&quot;Assets constructor&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Assets\\Assets", "fromLink": "Contentstack/Stack/Assets/Assets.html", "link": "Contentstack/Stack/Assets/Assets.html#method_Query", "name": "Contentstack\\Stack\\Assets\\Assets::Query", "doc": "&quot;Query object to create the \&quot;Query\&quot; on the specified ContentType&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Assets\\Assets", "fromLink": "Contentstack/Stack/Assets/Assets.html", "link": "Contentstack/Stack/Assets/Assets.html#method_fetch", "name": "Contentstack\\Stack\\Assets\\Assets::fetch", "doc": "&quot;Fetch the specified assets&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "doc": "&quot;BaseQuery\nBase Class where all the Queries will be created&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method___construct", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::__construct", "doc": "&quot;BaseQuery constructor&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_toJSON", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::toJSON", "doc": "&quot;To transform the Result object to server response content&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_except", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::except", "doc": "&quot;To exclude the fields from the result set&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_only", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::only", "doc": "&quot;To project the fields in the result set&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeReference", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeReference", "doc": "&quot;To include reference(s) of other content type in entries&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_search", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::search", "doc": "&quot;To search the given string in the entries&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_regex", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::regex", "doc": "&quot;To perform the regular expression test on the specified field&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_logicalAND", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::logicalAND", "doc": "&quot;Logical AND queries are pushed&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_logicalOR", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::logicalOR", "doc": "&quot;Logical OR queries are pushed&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_ascending", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::ascending", "doc": "&quot;To sort the entries in ascending order of the specified field&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_descending", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::descending", "doc": "&quot;To sort the entries in descending order of the specified field&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_notExists", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::notExists", "doc": "&quot;To check field doesn&#039;t exists&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_exists", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::exists", "doc": "&quot;To check field exists&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeFallback", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeFallback", "doc": "&quot;To include fallback content if specified locale content is not publish.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeSchema", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeSchema", "doc": "&quot;To include schema along with entries&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeReferenceContentTypeUID", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeReferenceContentTypeUID", "doc": "&quot;This method includes the content type UIDs of\nthe referenced entries returned in the response.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeContentType", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeContentType", "doc": "&quot;To include content_type along with entries&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeCount", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeCount", "doc": "&quot;To include the count of entries based on the results&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_count", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::count", "doc": "&quot;To get only count result&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_includeOwner", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::includeOwner", "doc": "&quot;To include the owner of entries based on the results&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_addParam", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::addParam", "doc": "&quot;To add query parameter in query&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_language", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::language", "doc": "&quot;To set the language code in the query&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_skip", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::skip", "doc": "&quot;Skip the specified number of entries from result set&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_tags", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::tags", "doc": "&quot;Result set entries should have tags specified&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_limit", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::limit", "doc": "&quot;Limit the specified number of entries from result set&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_containedIn", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::containedIn", "doc": "&quot;Query the field value from the given set of values&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_notContainedIn", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::notContainedIn", "doc": "&quot;Query the field value other than the given set of values&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_where", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::where", "doc": "&quot;Query the field which has exact value as specified&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_lessThan", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::lessThan", "doc": "&quot;Query the field which has less value than specified one&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_lessThanEqualTo", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::lessThanEqualTo", "doc": "&quot;Query the field which has less or equal value than specified one&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_greaterThan", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::greaterThan", "doc": "&quot;Query the field which has greater value than specified one&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_greaterThanEqualTo", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::greaterThanEqualTo", "doc": "&quot;Query the field which has greater or equal value than specified one&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_notEqualTo", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::notEqualTo", "doc": "&quot;Query the field which has not equal to value than specified one&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_addQuery", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::addQuery", "doc": "&quot;Add Query is used to add the raw\/array query to filter the entries&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery", "fromLink": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html", "link": "Contentstack/Stack/ContentType/BaseQuery/BaseQuery.html#method_getQuery", "name": "Contentstack\\Stack\\ContentType\\BaseQuery\\BaseQuery::getQuery", "doc": "&quot;Get the raw\/array query from the current instance of Query\/Entry&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Stack\\ContentType", "fromLink": "Contentstack/Stack/ContentType.html", "link": "Contentstack/Stack/ContentType/ContentType.html", "name": "Contentstack\\Stack\\ContentType\\ContentType", "doc": "&quot;Class ContentType&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\ContentType", "fromLink": "Contentstack/Stack/ContentType/ContentType.html", "link": "Contentstack/Stack/ContentType/ContentType.html#method___construct", "name": "Contentstack\\Stack\\ContentType\\ContentType::__construct", "doc": "&quot;ContentType\nContentType Class to initalize your ContentType&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\ContentType", "fromLink": "Contentstack/Stack/ContentType/ContentType.html", "link": "Contentstack/Stack/ContentType/ContentType.html#method_Entry", "name": "Contentstack\\Stack\\ContentType\\ContentType::Entry", "doc": "&quot;Entry object to create the \&quot;Query\&quot; on the specified ContentType&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\ContentType", "fromLink": "Contentstack/Stack/ContentType/ContentType.html", "link": "Contentstack/Stack/ContentType/ContentType.html#method_fetch", "name": "Contentstack\\Stack\\ContentType\\ContentType::fetch", "doc": "&quot;Fetch the specific contenttypes&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\ContentType", "fromLink": "Contentstack/Stack/ContentType/ContentType.html", "link": "Contentstack/Stack/ContentType/ContentType.html#method_Query", "name": "Contentstack\\Stack\\ContentType\\ContentType::Query", "doc": "&quot;Query object to create the \&quot;Query\&quot; on the specified ContentType&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Stack\\ContentType\\Entry", "fromLink": "Contentstack/Stack/ContentType/Entry.html", "link": "Contentstack/Stack/ContentType/Entry/Entry.html", "name": "Contentstack\\Stack\\ContentType\\Entry\\Entry", "doc": "&quot;Entry&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\Entry\\Entry", "fromLink": "Contentstack/Stack/ContentType/Entry/Entry.html", "link": "Contentstack/Stack/ContentType/Entry/Entry.html#method___construct", "name": "Contentstack\\Stack\\ContentType\\Entry\\Entry::__construct", "doc": "&quot;Entry Class to initalize your Entry&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\Entry\\Entry", "fromLink": "Contentstack/Stack/ContentType/Entry/Entry.html", "link": "Contentstack/Stack/ContentType/Entry/Entry.html#method_fetch", "name": "Contentstack\\Stack\\ContentType\\Entry\\Entry::fetch", "doc": "&quot;Fetch the specified entry&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Stack\\ContentType\\Query", "fromLink": "Contentstack/Stack/ContentType/Query.html", "link": "Contentstack/Stack/ContentType/Query/Query.html", "name": "Contentstack\\Stack\\ContentType\\Query\\Query", "doc": "&quot;Class Query&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\Query\\Query", "fromLink": "Contentstack/Stack/ContentType/Query/Query.html", "link": "Contentstack/Stack/ContentType/Query/Query.html#method___construct", "name": "Contentstack\\Stack\\ContentType\\Query\\Query::__construct", "doc": "&quot;Query Class to initalize your Query&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\Query\\Query", "fromLink": "Contentstack/Stack/ContentType/Query/Query.html", "link": "Contentstack/Stack/ContentType/Query/Query.html#method_find", "name": "Contentstack\\Stack\\ContentType\\Query\\Query::find", "doc": "&quot;Get all entries based on the specified subquery&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\ContentType\\Query\\Query", "fromLink": "Contentstack/Stack/ContentType/Query/Query.html", "link": "Contentstack/Stack/ContentType/Query/Query.html#method_findOne", "name": "Contentstack\\Stack\\ContentType\\Query\\Query::findOne", "doc": "&quot;Get single entry based on the specified subquery&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Stack", "fromLink": "Contentstack/Stack.html", "link": "Contentstack/Stack/Stack.html", "name": "Contentstack\\Stack\\Stack", "doc": "&quot;Stack Class to initialize the provided parameter Stack&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method___construct", "name": "Contentstack\\Stack\\Stack::__construct", "doc": "&quot;Constructor of the Stack&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_ContentType", "name": "Contentstack\\Stack\\Stack::ContentType", "doc": "&quot;To initialize the ContentType object from\nwhere the content will be fetched\/retrieved.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_Assets", "name": "Contentstack\\Stack\\Stack::Assets", "doc": "&quot;Assets Class to initalize your Assets&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_ImageTrasform", "name": "Contentstack\\Stack\\Stack::ImageTrasform", "doc": "&quot;ImageTrasform function is define for image manipulation with different&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getLastActivities", "name": "Contentstack\\Stack\\Stack::getLastActivities", "doc": "&quot;To get the last_activity information of the\nconfigured environment from all the content types&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_setHost", "name": "Contentstack\\Stack\\Stack::setHost", "doc": "&quot;To set the host on stack object&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getHost", "name": "Contentstack\\Stack\\Stack::getHost", "doc": "&quot;This function returns host.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_setProtocol", "name": "Contentstack\\Stack\\Stack::setProtocol", "doc": "&quot;This function sets protocol.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getProtocol", "name": "Contentstack\\Stack\\Stack::getProtocol", "doc": "&quot;This function return protocol type.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_setPort", "name": "Contentstack\\Stack\\Stack::setPort", "doc": "&quot;This function sets Port.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getPort", "name": "Contentstack\\Stack\\Stack::getPort", "doc": "&quot;This function return Port.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_setAPIKEY", "name": "Contentstack\\Stack\\Stack::setAPIKEY", "doc": "&quot;This function sets API Key.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_setDeliveryToken", "name": "Contentstack\\Stack\\Stack::setDeliveryToken", "doc": "&quot;This function sets Delivery Token.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_setEnvironment", "name": "Contentstack\\Stack\\Stack::setEnvironment", "doc": "&quot;This function sets environment name.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getAPIKEY", "name": "Contentstack\\Stack\\Stack::getAPIKEY", "doc": "&quot;This function returns API Key.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_DeliveryToken", "name": "Contentstack\\Stack\\Stack::DeliveryToken", "doc": "&quot;This function returns Delivery Token.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getEnvironment", "name": "Contentstack\\Stack\\Stack::getEnvironment", "doc": "&quot;This function returns environment name.&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Stack\\Stack", "fromLink": "Contentstack/Stack/Stack.html", "link": "Contentstack/Stack/Stack.html#method_getContentTypes", "name": "Contentstack\\Stack\\Stack::getContentTypes", "doc": "&quot;This call returns comprehensive information of all\nthe content types available in a particular stack in your account.&quot;"},
            
            {"type": "Class", "fromName": "Contentstack\\Support", "fromLink": "Contentstack/Support.html", "link": "Contentstack/Support/Utility.html", "name": "Contentstack\\Support\\Utility", "doc": "&quot;Utility\/Helper where all the helper and utility functions will be available.&quot;"},
                                                        {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_validateInput", "name": "Contentstack\\Support\\Utility::validateInput", "doc": "&quot;Validation for all the parameters required for the SDK&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_getDomain", "name": "Contentstack\\Support\\Utility::getDomain", "doc": "&quot;Get the domain from the current object&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_contentstackUrl", "name": "Contentstack\\Support\\Utility::contentstackUrl", "doc": "&quot;Contentstack URL method to create the url based on the request&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_headers", "name": "Contentstack\\Support\\Utility::headers", "doc": "&quot;Header transformation as it required format&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_generateQuery", "name": "Contentstack\\Support\\Utility::generateQuery", "doc": "&quot;POST formatted query for the API server&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_generateQueryParams", "name": "Contentstack\\Support\\Utility::generateQueryParams", "doc": "&quot;Sending the GET requests with all the parameters in POST as well as GET&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_wrapResult", "name": "Contentstack\\Support\\Utility::wrapResult", "doc": "&quot;Wrap Result&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_contentstackRequest", "name": "Contentstack\\Support\\Utility::contentstackRequest", "doc": "&quot;Contentstack request to the API server based on the data&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_isKeySet", "name": "Contentstack\\Support\\Utility::isKeySet", "doc": "&quot;Validate the key is set or not&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_isEmpty", "name": "Contentstack\\Support\\Utility::isEmpty", "doc": "&quot;Validate the String&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_getLastActivites", "name": "Contentstack\\Support\\Utility::getLastActivites", "doc": "&quot;Get Last activities&quot;"},
                    {"type": "Method", "fromName": "Contentstack\\Support\\Utility", "fromLink": "Contentstack/Support/Utility.html", "link": "Contentstack/Support/Utility.html#method_debug", "name": "Contentstack\\Support\\Utility::debug", "doc": "&quot;DEBUGGING MESSAGE&quot;"},
            
            
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

    root.Sami = {
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
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
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
                cb(Sami.search(q));
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


