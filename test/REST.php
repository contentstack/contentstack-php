<?php
namespace Contentstack\Test;

require_once __DIR__ . '/../src/config/index.php';
require_once __DIR__ . '/constants.php';

use Contentstack\Config;

class REST
{
    private $results = array();
    var $headers = array();
    var $ENTRIES = array();
    var $lang = array('en-us');

    public function __construct() {
        $this->ENTRIES['ctwithallfields'] = array();
        $this->ENTRIES['reference'] = array();
        array_push($this->ENTRIES['reference'], json_decode('{"title":"Reference","url":"/reference"}', true));
        array_push($this->ENTRIES['ctwithallfields'], json_decode(json_encode(array("tags" => array(),
            "uid" => "bltbb540d02e7d09a51",
            "locale" => "en-us",
            "group" => array(
                "textbox" => "texxtbox",
                "multi_line" => "multicolor",
                "rich_text_editor" => "<p><span style=\"color: rgb(144, 148, 156); font-family: proximaNovaSemiBold; font-size: 11px; font-weight: 700; line-height: 15px; text-transform: uppercase; background-color: initial;\">TRENDING</span></p><div class=\"_2sns _5spf\" style=\"border-top: 1px solid rgb(246, 247, 249); padding-top: 4px; color: rgb(29, 33, 41); font-family: helvetica, arial, sans-serif; font-size: 12px; line-height: 16.08px; background-color: rgb(255, 255, 255);\"><div class=\"_5my7 _2snq\" id=\"u_ps_0_4_5\" style=\"margin-top: -2px;\"><ul class=\"_5myl\" style=\"list-style-type: none; margin-bottom: 0px; padding-left: 0px;\"><li data-topicid=\"107840139236901\" class=\"_5my2 _3uz4\" data-position=\"1\" data-categories=\"[6]\" style=\"display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\"><div class=\"clearfix _uhk _4_nm\" style=\"zoom: 1; position: relative; line-height: 15px; max-height: 45px; overflow: hidden;\"><img class=\"_3uz0 _5r-z _8o lfloat _ohe img\" alt=\"\" src=\"/testcase.jpg\" style=\"float: left; display: block; height: 16px; margin-top: -1px; margin-right: 8px; margin-bottom: -1px; width: 16px; background-image: url(&quot;/rsrc.php/v2/yp/r/9R2TclzQ4gq.png&quot;); background-size: auto; background-position: 0px -381px; background-repeat: no-repeat;\"><div class=\"clearfix _42ef\" style=\"overflow: hidden; zoom: 1;\"><div class=\"_18dr rfloat _ohf\" style=\"float: right;\"><button class=\"_19_3\" title=\"Hide Trending Item\" aria-label=\"Hide Trending Item\" type=\"submit\" value=\"1\" style=\"font-family: helvetica, arial, sans-serif; font-size: 12px; margin-top: -1px; margin-left: 1px; opacity: 0; padding: 1px; -webkit-user-select: none; background: rgb(255, 255, 255);\"><span class=\"_4v8h\" data-topicid=\"107840139236901\" style=\"display: inline-block; height: 10px; width: 10px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -429px -275px; background-repeat: no-repeat;\"></span></button></div><a class=\"_4qzh _5v0t _7ge\" href=\"https://www.facebook.com/topic/Torrentz/107840139236901?source=whfrt&position=1&trqid=6315909096032975845\" id=\"u_ps_0_4_i\" data-hovercard=\"/pubcontent/trending/hovercard/?topic_id=107840139236901&topic_link_id=u_ps_0_4_i&position=1&source=whfrt&trqid=6315909096032975845\" data-hovercard-position=\"left\" data-hovercard-offset-x=\"-15\" data-hovercard-offset-y=\"10\" style=\"color: rgb(54, 88, 153);\"><strong>Torrentz</strong><span class=\"_5v9v\" style=\"color: rgb(144, 148, 156);\">: Online Piracy Search Engine Shuts Down</span></a></div></div></li><li data-topicid=\"344999862286077\" class=\"_5my2 _3uz4\" data-position=\"2\" data-categories=\"[10]\" style=\"display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\"><div class=\"clearfix _uhk _4_nm\" style=\"zoom: 1; position: relative; line-height: 15px; max-height: 45px; overflow: hidden;\"><img class=\"_3uz0 _5r-z _8o lfloat _ohe img\" alt=\"\" src=\"/testcase1.jpg\" style=\"float: left; display: block; height: 16px; margin-top: -1px; margin-right: 8px; margin-bottom: -1px; width: 16px; background-image: url(&quot;/rsrc.php/v2/yp/r/9R2TclzQ4gq.png&quot;); background-size: auto; background-position: 0px -381px; background-repeat: no-repeat;\"><div class=\"clearfix _42ef\" style=\"overflow: hidden; zoom: 1;\"><div class=\"_18dr rfloat _ohf\" style=\"float: right;\"><button class=\"_19_3\" title=\"Hide Trending Item\" aria-label=\"Hide Trending Item\" type=\"submit\" value=\"1\" style=\"font-family: helvetica, arial, sans-serif; font-size: 12px; margin-top: -1px; margin-left: 1px; opacity: 1; padding: 1px; -webkit-user-select: none; background: rgb(255, 255, 255);\"><span class=\"_4v8h\" data-topicid=\"344999862286077\" style=\"display: inline-block; height: 10px; width: 10px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -429px -275px; background-repeat: no-repeat;\"></span></button></div><a class=\"_4qzh _5v0t _7ge\" href=\"https://www.facebook.com/hashtag/friendshipday?source=whfrt&position=2&trqid=6315909096032975845\" id=\"u_ps_0_4_h\" data-hovercard=\"/pubcontent/trending/hovercard/?topic_id=344999862286077&topic_link_id=u_ps_0_4_h&position=2&source=whfrt&trqid=6315909096032975845\" data-hovercard-position=\"left\" data-hovercard-offset-x=\"-15\" data-hovercard-offset-y=\"10\" style=\"color: rgb(54, 88, 153);\"><strong>#FriendshipDay</strong><span class=\"_5v9v\" style=\"color: rgb(144, 148, 156);\">: Aug. 7 Marks Celebration of Interpersonal Bond Between 2 or More People</span></a></div></div></li><li data-topicid=\"150543951783325\" class=\"_5my2 _3uz4\" data-position=\"3\" data-categories=\"[200,201,203,208,207,2,21]\" style=\"display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\"><div class=\"clearfix _uhk _4_nm\" style=\"zoom: 1; position: relative; line-height: 15px; max-height: 45px; overflow: hidden;\"><img class=\"_3uz0 _5r-z _8o lfloat _ohe img\" alt=\"\" src=\"/testcase2.jpg\" style=\"float: left; display: block; height: 16px; margin-top: -1px; margin-right: 8px; margin-bottom: -1px; width: 16px; background-image: url(&quot;/rsrc.php/v2/yp/r/9R2TclzQ4gq.png&quot;); background-size: auto; background-position: 0px -381px; background-repeat: no-repeat;\"><div class=\"clearfix _42ef\" style=\"overflow: hidden; zoom: 1;\"><div class=\"_18dr rfloat _ohf\" style=\"float: right;\"><button class=\"_19_3\" title=\"Hide Trending Item\" aria-label=\"Hide Trending Item\" type=\"submit\" value=\"1\" style=\"font-family: helvetica, arial, sans-serif; font-size: 12px; margin-top: -1px; margin-left: 1px; opacity: 0; padding: 1px; -webkit-user-select: none; background: rgb(255, 255, 255);\"><span class=\"_4v8h\" data-topicid=\"150543951783325\" style=\"display: inline-block; height: 10px; width: 10px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -429px -275px; background-repeat: no-repeat;\"></span></button></div><a class=\"_4qzh _5v0t _7ge\" href=\"https://www.facebook.com/hashtag/rio2016?source=whfrt&position=3&trqid=6315909096032975845\" id=\"u_ps_0_4_j\" data-hovercard=\"/pubcontent/trending/hovercard/?topic_id=150543951783325&topic_link_id=u_ps_0_4_j&position=3&source=whfrt&trqid=6315909096032975845\" data-hovercard-position=\"left\" data-hovercard-offset-x=\"-15\" data-hovercard-offset-y=\"10\" style=\"color: rgb(54, 88, 153);\"><strong>#Rio2016</strong><span class=\"_5v9v\" style=\"color: rgb(144, 148, 156);\">: International Sporting Event Continues in Rio de Janeiro</span></a></div></div></li></ul><div class=\"_3uz3\" style=\"padding-bottom: 2.5px;\"><a class=\"_5my2 _5my9 _3uz4\" data-position=\"seemore\" href=\"https://www.facebook.com/#\" role=\"button\" id=\"u_ps_0_4_6\" style=\"color: rgb(66, 103, 178); display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\"><i class=\"_5myd _3uz1\" style=\"float: left; height: 5px; margin: 5.5px 11px 5.5px 4px; width: 9px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -262px -245px; background-repeat: no-repeat;\"></i>See More</a></div></div></div>",
                "markdown" => "Welcome to StackEdit!\n===================\n\n\nHey! I\\'m your first Markdown document in **StackEdit**[^stackedit]. Don\\'t delete me, I\\'m very helpful! I can be recovered anyway in the **Utils** tab of the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n----------\n\n\nDocuments\n-------------\n\nStackEdit stores your documents in your browser, which means all your documents are automatically saved locally and are accessible **offline!**\n\n> **Note:**\n\n> - StackEdit is accessible offline after the application has been loaded for the first time.\n> - Your local documents are not shared between different browsers or computers.\n> - Clearing your browser\\'s data may **delete all your local documents!** Make sure your documents are synchronized with **Google Drive** or **Dropbox** (check out the [<i class=\"icon-refresh\"></i> Synchronization](#synchronization) section).\n\n#### <i class=\"icon-file\"></i> Create a document\n\nThe document panel is accessible using the <i class=\"icon-folder-open\"></i> button in the navigation bar. You can create a new document by clicking <i class=\"icon-file\"></i> **New document** in the document panel.\n\n#### <i class=\"icon-folder-open\"></i> Switch to another document\n\nAll your local documents are listed in the document panel. You can switch from one to another by clicking a document in the list or you can toggle documents using <kbd>Ctrl+[</kbd> and <kbd>Ctrl+]</kbd>.\n\n#### <i class=\"icon-pencil\"></i> Rename a document\n\nYou can rename the current document by clicking the document title in the navigation bar.\n\n#### <i class=\"icon-trash\"></i> Delete a document\n\nYou can delete the current document by clicking <i class=\"icon-trash\"></i> **Delete document** in the document panel.\n\n#### <i class=\"icon-hdd\"></i> Export a document\n\nYou can save the current document to a file by clicking <i class=\"icon-hdd\"></i> **Export to disk** from the <i class=\"icon-provider-stackedit\"></i> menu panel.\n\n> **Tip:** Check out the [<i class=\"icon-upload\"></i> Publish a document](#publish-a-document) section for a description of the different output formats.\n\n\n----------\n\n\nSynchronization\n-------------------\n\nStackEdit can be combined with <i class=\"icon-provider-gdrive\"></i> **Google Drive** and <i class=\"icon-provider-dropbox\"></i> **Dropbox** to have your documents saved in the *Cloud*. The synchronization mechanism takes care of uploading your modifications or downloading the latest version of your documents.\n\n> **Note:**\n\n> - Full access to **Google Drive** or **Dropbox** is required to be able to import any document in StackEdit. Permission restrictions can be configured in the settings.\n> - Imported documents are downloaded in your browser and are not transmitted to a server.\n> - If you experience problems saving your documents on Google Drive, check and optionally disable browser extensions, such as Disconnect.\n\n#### <i class=\"icon-refresh\"></i> Open a document\n\nYou can open a document from <i class=\"icon-provider-gdrive\"></i> **Google Drive** or the <i class=\"icon-provider-dropbox\"></i> **Dropbox** by opening the <i class=\"icon-refresh\"></i> **Synchronize** sub-menu and by clicking **Open from...**. Once opened, any modification in your document will be automatically synchronized with the file in your **Google Drive** / **Dropbox** account.\n\n#### <i class=\"icon-refresh\"></i> Save a document\n\nYou can save any document by opening the <i class=\"icon-refresh\"></i> **Synchronize** sub-menu and by clicking **Save on...**. Even if your document is already synchronized with **Google Drive** or **Dropbox**, you can export it to a another location. StackEdit can synchronize one document with multiple locations and accounts.\n\n#### <i class=\"icon-refresh\"></i> Synchronize a document\n\nOnce your document is linked to a <i class=\"icon-provider-gdrive\"></i> **Google Drive** or a <i class=\"icon-provider-dropbox\"></i> **Dropbox** file, StackEdit will periodically (every 3 minutes) synchronize it by downloading/uploading any modification. A merge will be performed if necessary and conflicts will be detected.\n\nIf you just have modified your document and you want to force the synchronization, click the <i class=\"icon-refresh\"></i> button in the navigation bar.\n\n> **Note:** The <i class=\"icon-refresh\"></i> button is disabled when you have no document to synchronize.\n\n#### <i class=\"icon-refresh\"></i> Manage document synchronization\n\nSince one document can be synchronized with multiple locations, you can list and manage synchronized locations by clicking <i class=\"icon-refresh\"></i> **Manage synchronization** in the <i class=\"icon-refresh\"></i> **Synchronize** sub-menu. This will let you remove synchronization locations that are associated to your document.\n\n> **Note:** If you delete the file from **Google Drive** or from **Dropbox**, the document will no longer be synchronized with that location.\n\n----------\n\n\nPublication\n-------------\n\nOnce you are happy with your document, you can publish it on different websites directly from StackEdit. As for now, StackEdit can publish on **Blogger**, **Dropbox**, **Gist**, **GitHub**, **Google Drive**, **Tumblr**, **WordPress** and on any SSH server.\n\n#### <i class=\"icon-upload\"></i> Publish a document\n\nYou can publish your document by opening the <i class=\"icon-upload\"></i> **Publish** sub-menu and by choosing a website. In the dialog box, you can choose the publication format:\n\n- Markdown, to publish the Markdown text on a website that can interpret it (**GitHub** for instance),\n- HTML, to publish the document converted into HTML (on a blog for example),\n- Template, to have a full control of the output.\n\n> **Note:** The default template is a simple webpage wrapping your document in HTML format. You can customize it in the **Advanced** tab of the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n#### <i class=\"icon-upload\"></i> Update a publication\n\nAfter publishing, StackEdit will keep your document linked to that publication which makes it easy for you to update it. Once you have modified your document and you want to update your publication, click on the <i class=\"icon-upload\"></i> button in the navigation bar.\n\n> **Note:** The <i class=\"icon-upload\"></i> button is disabled when your document has not been published yet.\n\n#### <i class=\"icon-upload\"></i> Manage document publication\n\nSince one document can be published on multiple locations, you can list and manage publish locations by clicking <i class=\"icon-upload\"></i> **Manage publication** in the <i class=\"icon-provider-stackedit\"></i> menu panel. This will let you remove publication locations that are associated to your document.\n\n> **Note:** If the file has been removed from the website or the blog, the document will no longer be published on that location.\n\n----------\n\n\nMarkdown Extra\n--------------------\n\nStackEdit supports **Markdown Extra**, which extends **Markdown** syntax with some nice features.\n\n> **Tip:** You can disable any **Markdown Extra** feature in the **Extensions** tab of the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n> **Note:** You can find more information about **Markdown** syntax [here][2] and **Markdown Extra** extension [here][3].\n\n\n### Tables\n\n**Markdown Extra** has a special syntax for tables:\n\nItem     | Value\n-------- | ---\nComputer | $1600\nPhone    | $12\nPipe     | $1\n\nYou can specify column alignment with one or two colons:\n\n| Item     | Value | Qty   |\n| :------- | ----: | :---: |\n| Computer | $1600 |  5    |\n| Phone    | $12   |  12   |\n| Pipe     | $1    |  234  |\n\n\n### Definition Lists\n\n**Markdown Extra** has a special syntax for definition lists too:\n\nTerm 1\nTerm 2\n:   Definition A\n:   Definition B\n\nTerm 3\n\n:   Definition C\n\n:   Definition D\n\n\t> part of definition D\n\n\n### Fenced code blocks\n\nGitHub\\'s fenced code blocks are also supported with **Highlight.js** syntax highlighting:\n\n```\n// Foo\nvar bar = 0;\n```\n\n> **Tip:** To use **Prettify** instead of **Highlight.js**, just configure the **Markdown Extra** extension in the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n> **Note:** You can find more information:\n\n> - about **Prettify** syntax highlighting [here][5],\n> - about **Highlight.js** syntax highlighting [here][6].\n\n\n### Footnotes\n\nYou can create footnotes like this[^footnote].\n\n  [^footnote]: Here is the *text* of the **footnote**.\n\n\n### SmartyPants\n\nSmartyPants converts ASCII punctuation characters into \"smart\" typographic punctuation HTML entities. For example:\n\n|                  | ASCII                        | HTML              |\n ----------------- | ---------------------------- | ------------------\n| Single backticks | `\\'Isn\\'t this fun?\\'`            | \\'Isn\\'t this fun?\\' |\n| Quotes           | `\"Isn\\'t this fun?\"`            | \"Isn\\'t this fun?\" |\n| Dashes           | `-- is en-dash, --- is em-dash` | -- is en-dash, --- is em-dash |\n\n\n### Table of contents\n\nYou can insert a table of contents using the marker `[TOC]`:\n\n[TOC]\n\n\n### MathJax\n\nYou can render *LaTeX* mathematical expressions using **MathJax**, as on [math.stackexchange.com][1]:\n\nThe *Gamma function* satisfying $\\Gamma(n) = (n-1)!\\quad\\forall n\\in\\mathbb N$ is via the Euler integral\n\n$$\n\\Gamma(z) = \\int_0^\\infty t^{z-1}e^{-t}dt\\,.\n$$\n\n> **Tip:** To make sure mathematical expressions are rendered properly on your website, include **MathJax** into your template:\n\n```\n<script type=\"text/javascript\" src=\"https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML\"></script>\n```\n\n> **Note:** You can find more information about **LaTeX** mathematical expressions [here][4].\n\n\n### UML diagrams\n\nYou can also render sequence diagrams like this:\n\n```sequence\nAlice->Bob: Hello Bob, how are you?\nNote right of Bob: Bob thinks\nBob-->Alice: I am good thanks!\n```\n\nAnd flow charts like this:\n\n```flow\nst=>start: Start\ne=>end\nop=>operation: My Operation\ncond=>condition: Yes or No?\n\nst->op->cond\ncond(yes)->e\ncond(no)->op\n```\n\n> **Note:** You can find more information:\n\n> - about **Sequence diagrams** syntax [here][7],\n> - about **Flow charts** syntax [here][8].\n\n### Support StackEdit\n\n[![](https://cdn.monetizejs.com/resources/button-32.png)](https://monetizejs.com/authorize?client_id=ESTHdCYOi18iLhhO&summary=true)\n\n  [^stackedit]: [StackEdit](https://stackedit.io/) is a full-featured, open-source Markdown editor based on PageDown, the Markdown library used by Stack Overflow and the other Stack Exchange sites.\n\n\n  [1]: http://math.stackexchange.com/\n  [2]: http://daringfireball.net/projects/markdown/syntax \"Markdown\"\n  [3]: https://github.com/jmcmanus/pagedown-extra \"Pagedown Extra\"\n  [4]: http://meta.math.stackexchange.com/questions/5020/mathjax-basic-tutorial-and-quick-reference\n  [5]: https://code.google.com/p/google-code-prettify/\n  [6]: http://highlightjs.org/\n  [7]: http://bramp.github.io/js-sequence-diagrams/\n  [8]: http://adrai.github.io/flowchart.js/\n",
                "number" => 1,
                "date" => "2016-08-07T00:00:00+0530",
                "boolean" => true,
                "reference" => array()
            ),
            "reference" => array(),
            "file" => null,
            "date" => "2016-08-07T00:00:00+0530",
            "boolean" => false,
            "number2" => array(
                0,
                1,
                2
            ),
            "number1" => 0,
            "markdown" => "Welcome to StackEdit!\n===================\n\n\nHey! I\\'m your first Markdown document in **StackEdit**[^stackedit]. Don\\'t delete me, I\\'m very helpful! I can be recovered anyway in the **Utils** tab of the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n----------\n\n\nDocuments\n-------------\n\nStackEdit stores your documents in your browser, which means all your documents are automatically saved locally and are accessible **offline!**\n\n> **Note:**\n\n> - StackEdit is accessible offline after the application has been loaded for the first time.\n> - Your local documents are not shared between different browsers or computers.\n> - Clearing your browser\\'s data may **delete all your local documents!** Make sure your documents are synchronized with **Google Drive** or **Dropbox** (check out the [<i class=\"icon-refresh\"></i> Synchronization](#synchronization) section).\n\n#### <i class=\"icon-file\"></i> Create a document\n\nThe document panel is accessible using the <i class=\"icon-folder-open\"></i> button in the navigation bar. You can create a new document by clicking <i class=\"icon-file\"></i> **New document** in the document panel.\n\n#### <i class=\"icon-folder-open\"></i> Switch to another document\n\nAll your local documents are listed in the document panel. You can switch from one to another by clicking a document in the list or you can toggle documents using <kbd>Ctrl+[</kbd> and <kbd>Ctrl+]</kbd>.\n\n#### <i class=\"icon-pencil\"></i> Rename a document\n\nYou can rename the current document by clicking the document title in the navigation bar.\n\n#### <i class=\"icon-trash\"></i> Delete a document\n\nYou can delete the current document by clicking <i class=\"icon-trash\"></i> **Delete document** in the document panel.\n\n#### <i class=\"icon-hdd\"></i> Export a document\n\nYou can save the current document to a file by clicking <i class=\"icon-hdd\"></i> **Export to disk** from the <i class=\"icon-provider-stackedit\"></i> menu panel.\n\n> **Tip:** Check out the [<i class=\"icon-upload\"></i> Publish a document](#publish-a-document) section for a description of the different output formats.\n\n\n----------\n\n\nSynchronization\n-------------------\n\nStackEdit can be combined with <i class=\"icon-provider-gdrive\"></i> **Google Drive** and <i class=\"icon-provider-dropbox\"></i> **Dropbox** to have your documents saved in the *Cloud*. The synchronization mechanism takes care of uploading your modifications or downloading the latest version of your documents.\n\n> **Note:**\n\n> - Full access to **Google Drive** or **Dropbox** is required to be able to import any document in StackEdit. Permission restrictions can be configured in the settings.\n> - Imported documents are downloaded in your browser and are not transmitted to a server.\n> - If you experience problems saving your documents on Google Drive, check and optionally disable browser extensions, such as Disconnect.\n\n#### <i class=\"icon-refresh\"></i> Open a document\n\nYou can open a document from <i class=\"icon-provider-gdrive\"></i> **Google Drive** or the <i class=\"icon-provider-dropbox\"></i> **Dropbox** by opening the <i class=\"icon-refresh\"></i> **Synchronize** sub-menu and by clicking **Open from...**. Once opened, any modification in your document will be automatically synchronized with the file in your **Google Drive** / **Dropbox** account.\n\n#### <i class=\"icon-refresh\"></i> Save a document\n\nYou can save any document by opening the <i class=\"icon-refresh\"></i> **Synchronize** sub-menu and by clicking **Save on...**. Even if your document is already synchronized with **Google Drive** or **Dropbox**, you can export it to a another location. StackEdit can synchronize one document with multiple locations and accounts.\n\n#### <i class=\"icon-refresh\"></i> Synchronize a document\n\nOnce your document is linked to a <i class=\"icon-provider-gdrive\"></i> **Google Drive** or a <i class=\"icon-provider-dropbox\"></i> **Dropbox** file, StackEdit will periodically (every 3 minutes) synchronize it by downloading/uploading any modification. A merge will be performed if necessary and conflicts will be detected.\n\nIf you just have modified your document and you want to force the synchronization, click the <i class=\"icon-refresh\"></i> button in the navigation bar.\n\n> **Note:** The <i class=\"icon-refresh\"></i> button is disabled when you have no document to synchronize.\n\n#### <i class=\"icon-refresh\"></i> Manage document synchronization\n\nSince one document can be synchronized with multiple locations, you can list and manage synchronized locations by clicking <i class=\"icon-refresh\"></i> **Manage synchronization** in the <i class=\"icon-refresh\"></i> **Synchronize** sub-menu. This will let you remove synchronization locations that are associated to your document.\n\n> **Note:** If you delete the file from **Google Drive** or from **Dropbox**, the document will no longer be synchronized with that location.\n\n----------\n\n\nPublication\n-------------\n\nOnce you are happy with your document, you can publish it on different websites directly from StackEdit. As for now, StackEdit can publish on **Blogger**, **Dropbox**, **Gist**, **GitHub**, **Google Drive**, **Tumblr**, **WordPress** and on any SSH server.\n\n#### <i class=\"icon-upload\"></i> Publish a document\n\nYou can publish your document by opening the <i class=\"icon-upload\"></i> **Publish** sub-menu and by choosing a website. In the dialog box, you can choose the publication format:\n\n- Markdown, to publish the Markdown text on a website that can interpret it (**GitHub** for instance),\n- HTML, to publish the document converted into HTML (on a blog for example),\n- Template, to have a full control of the output.\n\n> **Note:** The default template is a simple webpage wrapping your document in HTML format. You can customize it in the **Advanced** tab of the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n#### <i class=\"icon-upload\"></i> Update a publication\n\nAfter publishing, StackEdit will keep your document linked to that publication which makes it easy for you to update it. Once you have modified your document and you want to update your publication, click on the <i class=\"icon-upload\"></i> button in the navigation bar.\n\n> **Note:** The <i class=\"icon-upload\"></i> button is disabled when your document has not been published yet.\n\n#### <i class=\"icon-upload\"></i> Manage document publication\n\nSince one document can be published on multiple locations, you can list and manage publish locations by clicking <i class=\"icon-upload\"></i> **Manage publication** in the <i class=\"icon-provider-stackedit\"></i> menu panel. This will let you remove publication locations that are associated to your document.\n\n> **Note:** If the file has been removed from the website or the blog, the document will no longer be published on that location.\n\n----------\n\n\nMarkdown Extra\n--------------------\n\nStackEdit supports **Markdown Extra**, which extends **Markdown** syntax with some nice features.\n\n> **Tip:** You can disable any **Markdown Extra** feature in the **Extensions** tab of the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n> **Note:** You can find more information about **Markdown** syntax [here][2] and **Markdown Extra** extension [here][3].\n\n\n### Tables\n\n**Markdown Extra** has a special syntax for tables:\n\nItem     | Value\n-------- | ---\nComputer | $1600\nPhone    | $12\nPipe     | $1\n\nYou can specify column alignment with one or two colons:\n\n| Item     | Value | Qty   |\n| :------- | ----: | :---: |\n| Computer | $1600 |  5    |\n| Phone    | $12   |  12   |\n| Pipe     | $1    |  234  |\n\n\n### Definition Lists\n\n**Markdown Extra** has a special syntax for definition lists too:\n\nTerm 1\nTerm 2\n:   Definition A\n:   Definition B\n\nTerm 3\n\n:   Definition C\n\n:   Definition D\n\n\t> part of definition D\n\n\n### Fenced code blocks\n\nGitHub\\'s fenced code blocks are also supported with **Highlight.js** syntax highlighting:\n\n```\n// Foo\nvar bar = 0;\n```\n\n> **Tip:** To use **Prettify** instead of **Highlight.js**, just configure the **Markdown Extra** extension in the <i class=\"icon-cog\"></i> **Settings** dialog.\n\n> **Note:** You can find more information:\n\n> - about **Prettify** syntax highlighting [here][5],\n> - about **Highlight.js** syntax highlighting [here][6].\n\n\n### Footnotes\n\nYou can create footnotes like this[^footnote].\n\n  [^footnote]: Here is the *text* of the **footnote**.\n\n\n### SmartyPants\n\nSmartyPants converts ASCII punctuation characters into \"smart\" typographic punctuation HTML entities. For example:\n\n|                  | ASCII                        | HTML              |\n ----------------- | ---------------------------- | ------------------\n| Single backticks | `\\'Isn\\'t this fun?\\'`            | \\'Isn\\'t this fun?\\' |\n| Quotes           | `\"Isn\\'t this fun?\"`            | \"Isn\\'t this fun?\" |\n| Dashes           | `-- is en-dash, --- is em-dash` | -- is en-dash, --- is em-dash |\n\n\n### Table of contents\n\nYou can insert a table of contents using the marker `[TOC]`:\n\n[TOC]\n\n\n### MathJax\n\nYou can render *LaTeX* mathematical expressions using **MathJax**, as on [math.stackexchange.com][1]:\n\nThe *Gamma function* satisfying $\\Gamma(n) = (n-1)!\\quad\\forall n\\in\\mathbb N$ is via the Euler integral\n\n$$\n\\Gamma(z) = \\int_0^\\infty t^{z-1}e^{-t}dt\\,.\n$$\n\n> **Tip:** To make sure mathematical expressions are rendered properly on your website, include **MathJax** into your template:\n\n```\n<script type=\"text/javascript\" src=\"https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML\"></script>\n```\n\n> **Note:** You can find more information about **LaTeX** mathematical expressions [here][4].\n\n\n### UML diagrams\n\nYou can also render sequence diagrams like this:\n\n```sequence\nAlice->Bob: Hello Bob, how are you?\nNote right of Bob: Bob thinks\nBob-->Alice: I am good thanks!\n```\n\nAnd flow charts like this:\n\n```flow\nst=>start: Start\ne=>end\nop=>operation: My Operation\ncond=>condition: Yes or No?\n\nst->op->cond\ncond(yes)->e\ncond(no)->op\n```\n\n> **Note:** You can find more information:\n\n> - about **Sequence diagrams** syntax [here][7],\n> - about **Flow charts** syntax [here][8].\n\n### Support StackEdit\n\n[![](https://cdn.monetizejs.com/resources/button-32.png)](https://monetizejs.com/authorize?client_id=ESTHdCYOi18iLhhO&summary=true)\n\n  [^stackedit]: [StackEdit](https://stackedit.io/) is a full-featured, open-source Markdown editor based on PageDown, the Markdown library used by Stack Overflow and the other Stack Exchange sites.\n\n\n  [1]: http://math.stackexchange.com/\n  [2]: http://daringfireball.net/projects/markdown/syntax \"Markdown\"\n  [3]: https://github.com/jmcmanus/pagedown-extra \"Pagedown Extra\"\n  [4]: http://meta.math.stackexchange.com/questions/5020/mathjax-basic-tutorial-and-quick-reference\n  [5]: https://code.google.com/p/google-code-prettify/\n  [6]: http://highlightjs.org/\n  [7]: http://bramp.github.io/js-sequence-diagrams/\n  [8]: http://adrai.github.io/flowchart.js/\n",
            "rte" => "<div class=\"clearfix _52s7\" style=\"zoom: 1; border-top: 1px solid rgb(233, 234, 237); color: rgb(29, 33, 41); font-family: helvetica, arial, sans-serif; font-size: 12px; line-height: 16.08px; background-color: rgb(255, 255, 255);\">\n\t<div class=\"uiHeader uiHeaderTopBorder _1pp_ _3pr8\" style=\"border-width: 0px; margin-bottom: 0px; align-items: center; display: flex; height: 16px; margin-top: 7px; background-image: none; background-position: initial;\">\n\t\t<div class=\"clearfix uiHeaderTop\" style=\"zoom: 1;\">\n\t\t\t<h6 class=\"uiHeaderTitle\" style=\"color: rgb(144, 148, 156); font-size: 11px; margin-bottom: 0px; outline: none; line-height: 15px; -webkit-font-smoothing: antialiased; display: inline-block; vertical-align: middle;\">TRENDING</h6>\n\t\t</div>\n\t</div>\n</div><div class=\"_2sns _5spf\" style=\"border-top: 1px solid rgb(246, 247, 249); padding-top: 4px; color: rgb(29, 33, 41); font-family: helvetica, arial, sans-serif; font-size: 12px; line-height: 16.08px; background-color: rgb(255, 255, 255);\">\n\t<div class=\"_5my7 _2snq\" id=\"u_ps_0_4_5\" style=\"margin-top: -2px;\">\n\t\t<ul class=\"_5myl\" style=\"list-style-type: none; margin-bottom: 0px; padding-left: 0px;\">\n\t\t\t<li data-topicid=\"107840139236901\" class=\"_5my2 _3uz4\" data-position=\"1\" data-categories=\"[6]\" style=\"display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\">\n\t\t\t<div class=\"clearfix _uhk _4_nm\" style=\"zoom: 1; position: relative; line-height: 15px; max-height: 45px; overflow: hidden;\"><img class=\"_3uz0 _5r-z _8o lfloat _ohe img\" alt=\"\" src=\"/testcase2\" style=\"float: left; display: block; height: 16px; margin-top: -1px; margin-right: 8px; margin-bottom: -1px; width: 16px; background-image: url(&quot;/rsrc.php/v2/yp/r/9R2TclzQ4gq.png&quot;); background-size: auto; background-position: 0px -381px; background-repeat: no-repeat;\">\n\t\t\t\t<div class=\"clearfix _42ef\" style=\"overflow: hidden; zoom: 1;\">\n\t\t\t\t\t<div class=\"_18dr rfloat _ohf\" style=\"float: right;\"><button class=\"_19_3\" title=\"Hide Trending Item\" aria-label=\"Hide Trending Item\" type=\"submit\" value=\"1\" style=\"font-family: helvetica, arial, sans-serif; font-size: 12px; margin-top: -1px; margin-left: 1px; opacity: 0; padding: 1px; -webkit-user-select: none; background: rgb(255, 255, 255);\"><span class=\"_4v8h\" data-topicid=\"107840139236901\" style=\"display: inline-block; height: 10px; width: 10px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -429px -275px; background-repeat: no-repeat;\"></span></button>\n\t\t\t\t\t</div><a class=\"_4qzh _5v0t _7ge\" href=\"https://www.facebook.com/topic/Torrentz/107840139236901?source=whfrt&position=1&trqid=6315909096032975845\" id=\"u_ps_0_4_i\" data-hovercard=\"/pubcontent/trending/hovercard/?topic_id=107840139236901&topic_link_id=u_ps_0_4_i&position=1&source=whfrt&trqid=6315909096032975845\" data-hovercard-position=\"left\" data-hovercard-offset-x=\"-15\" data-hovercard-offset-y=\"10\" style=\"color: rgb(54, 88, 153); text-decoration: none;\"><strong>Torrentz</strong><span class=\"_5v9v\" style=\"color: rgb(144, 148, 156);\">: Online Piracy Search Engine Shuts Down</span></a>\n\t\t\t\t</div>\n\t\t\t</div></li>\n\t\t\t<li data-topicid=\"344999862286077\" class=\"_5my2 _3uz4\" data-position=\"2\" data-categories=\"[10]\" style=\"display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\">\n\t\t\t<div class=\"clearfix _uhk _4_nm\" style=\"zoom: 1; position: relative; line-height: 15px; max-height: 45px; overflow: hidden;\"><img class=\"_3uz0 _5r-z _8o lfloat _ohe img\" alt=\"\" src=\"/testcase2\" style=\"float: left; display: block; height: 16px; margin-top: -1px; margin-right: 8px; margin-bottom: -1px; width: 16px; background-image: url(&quot;/rsrc.php/v2/yp/r/9R2TclzQ4gq.png&quot;); background-size: auto; background-position: 0px -381px; background-repeat: no-repeat;\">\n\t\t\t\t<div class=\"clearfix _42ef\" style=\"overflow: hidden; zoom: 1;\">\n\t\t\t\t\t<div class=\"_18dr rfloat _ohf\" style=\"float: right;\"><button class=\"_19_3\" title=\"Hide Trending Item\" aria-label=\"Hide Trending Item\" type=\"submit\" value=\"1\" style=\"font-family: helvetica, arial, sans-serif; font-size: 12px; margin-top: -1px; margin-left: 1px; opacity: 1; padding: 1px; -webkit-user-select: none; background: rgb(255, 255, 255);\"><span class=\"_4v8h\" data-topicid=\"344999862286077\" style=\"display: inline-block; height: 10px; width: 10px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -429px -275px; background-repeat: no-repeat;\"></span></button>\n\t\t\t\t\t</div><a class=\"_4qzh _5v0t _7ge\" href=\"https://www.facebook.com/hashtag/friendshipday?source=whfrt&position=2&trqid=6315909096032975845\" id=\"u_ps_0_4_h\" data-hovercard=\"/pubcontent/trending/hovercard/?topic_id=344999862286077&topic_link_id=u_ps_0_4_h&position=2&source=whfrt&trqid=6315909096032975845\" data-hovercard-position=\"left\" data-hovercard-offset-x=\"-15\" data-hovercard-offset-y=\"10\" style=\"color: rgb(54, 88, 153); text-decoration: none;\"><strong>#FriendshipDay</strong><span class=\"_5v9v\" style=\"color: rgb(144, 148, 156);\">: Aug. 7 Marks Celebration of Interpersonal Bond Between 2 or More People</span></a>\n\t\t\t\t</div>\n\t\t\t</div></li>\n\t\t\t<li data-topicid=\"150543951783325\" class=\"_5my2 _3uz4\" data-position=\"3\" data-categories=\"[200,201,203,208,207,2,21]\" style=\"display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\">\n\t\t\t<div class=\"clearfix _uhk _4_nm\" style=\"zoom: 1; position: relative; line-height: 15px; max-height: 45px; overflow: hidden;\"><img class=\"_3uz0 _5r-z _8o lfloat _ohe img\" alt=\"\" src=\"/testcase2\" style=\"float: left; display: block; height: 16px; margin-top: -1px; margin-right: 8px; margin-bottom: -1px; width: 16px; background-image: url(&quot;/rsrc.php/v2/yp/r/9R2TclzQ4gq.png&quot;); background-size: auto; background-position: 0px -381px; background-repeat: no-repeat;\">\n\t\t\t\t<div class=\"clearfix _42ef\" style=\"overflow: hidden; zoom: 1;\">\n\t\t\t\t\t<div class=\"_18dr rfloat _ohf\" style=\"float: right;\"><button class=\"_19_3\" title=\"Hide Trending Item\" aria-label=\"Hide Trending Item\" type=\"submit\" value=\"1\" style=\"font-family: helvetica, arial, sans-serif; font-size: 12px; margin-top: -1px; margin-left: 1px; opacity: 0; padding: 1px; -webkit-user-select: none; background: rgb(255, 255, 255);\"><span class=\"_4v8h\" data-topicid=\"150543951783325\" style=\"display: inline-block; height: 10px; width: 10px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -429px -275px; background-repeat: no-repeat;\"></span></button>\n\t\t\t\t\t</div><a class=\"_4qzh _5v0t _7ge\" href=\"https://www.facebook.com/hashtag/rio2016?source=whfrt&position=3&trqid=6315909096032975845\" id=\"u_ps_0_4_j\" data-hovercard=\"/pubcontent/trending/hovercard/?topic_id=150543951783325&topic_link_id=u_ps_0_4_j&position=3&source=whfrt&trqid=6315909096032975845\" data-hovercard-position=\"left\" data-hovercard-offset-x=\"-15\" data-hovercard-offset-y=\"10\" style=\"color: rgb(54, 88, 153); text-decoration: none;\"><strong>#Rio2016</strong><span class=\"_5v9v\" style=\"color: rgb(144, 148, 156);\">: International Sporting Event Continues in Rio de Janeiro</span></a>\n\t\t\t\t</div>\n\t\t\t</div></li>\n\t\t</ul>\n\t\t<div class=\"_3uz3\" style=\"padding-bottom: 2.5px;\"><a class=\"_5my2 _5my9 _3uz4\" data-position=\"seemore\" href=\"https://www.facebook.com/#\" role=\"button\" id=\"u_ps_0_4_6\" style=\"color: rgb(66, 103, 178); text-decoration: none; display: block; padding-top: 2.5px; padding-bottom: 2.5px; border-radius: 2px 0px 0px 2px; margin-left: 2px;\"><i class=\"_5myd _3uz1\" style=\"float: left; height: 5px; margin: 5.5px 11px 5.5px 4px; width: 9px; background-image: url(&quot;/rsrc.php/v2/yr/r/adutF6URVmC.png&quot;); background-size: auto; background-position: -262px -245px; background-repeat: no-repeat;\"></i>See More</a>\n\t\t</div>\n\t</div>\n</div>",
            "textbox2" => array(
                "textbox1"
            ),
            "textbox" => "textbox",
            "url" => "/cb1",
            "title" => "CB1"
        )), true));


        if(file_exists(RESULT_PATH) && ENV === 'TEST_LOCAL') {
            echo "\n Skipping tear up as result already present";
            $myfile = fopen(RESULT_PATH, "r") or die("Unable to open file!");
            $this->results = json_decode(fread($myfile, filesize(RESULT_PATH)), true);
        } else {
            $this->publishEntries();
            $myfile = fopen(RESULT_PATH, "w") or die("Unable to open file!");
            fwrite($myfile, json_encode($this->results));
        }
        fclose($myfile);
    }

    /*
     * Remove system keys from the values
     * */
    public function sanatize($value = array())
    {
        unset($value['SYS_ACL']);
        unset($value['DEFAULT_ACL']);
        unset($value['roles']);
        return $value;
    }

    /*
     * Set method is used to add the variable to the private variable of current instance
     * @param
     *      string|$key  - key which will hold the value
     *      array|$value - value of the key
     * @return null
     * */
    public function set($key = '', $value = '')
    {
        // unset values
        if (is_array($value) && isset($value[0]) && is_array($value[0])) {
            foreach ($value as $k => $val) {
                $val = $this->sanatize($val);
                $value[$k] = $val;
            }
        } else {
            $value = $this->sanatize($value);
        }
        // unset values

        // before set get the data
        $tmpValue = ($this->get($key)) ? $this->get($key) : array();
        $this->results[$key] = array_merge($value, $tmpValue);
    }

    /*
     * Get method is used to fetch the matched key's value of current instance
     * @param
     *      string|$key  - key which will hold the value
     * @return string|array|$value
     * */
    public function get($key = '')
    {
        return ($key && isset($this->results[$key])) ? $this->results[$key] : array();
    }

    /*
     * Create New session for the User
     * */
    public function createUserSession()
    {
       $user = $this->sendRequest('user-session', array('user' => array('email' => 'rohit.mishra@raweng.com', 'password' => 'comeonyaar123')));
        if (isset($user['user'])) {
            $this->set('user', $user['user']);
            $this->headers['authtoken'] = (isset($user['user']['authtoken'])) ? $user['user']['authtoken'] : '';
            $this->headers['organization_uid'] = (isset($user['user']['org_uid']) && is_array($user['user']['org_uid'])) ? $user['user']['org_uid'][0] : '';
            echo "\nUser Session created.";
        } else {
            echo "\nUser Session not created.";
        }
    }

    /*
     * Create New Stack By the current User
     * */
    public function createStack()
    {
        $this->createUserSession();
        $stack = $this->sendRequest('stack', array('stack' => array('name' => 'php-sdk-test')));
        if (isset($stack['stack'])) {
            $this->set('stack', $stack['stack']);
            //$this->set('org_uid', $headers['blt2b4991176c6c1d25']);
            $this->headers['api_key'] = (isset($stack['stack']['api_key'])) ? $stack['stack']['api_key'] : '';
            echo "\nStack created.";
        } else {
            echo "\nStack not created.".$stack;
        }
    }

    /*
     * Delete Created Stack By the current User
     * */
    public function deleteStack()
    {
        if ($this->headers && isset($this->headers['api_key'])) {
            $stack = $this->sendRequest('stack.delete', array(), 'DELETE');
            echo "\nStack deleted.";
        } else {
            echo "\nStack not deleted.";
        }
    }


    /*
     * Create ContentType under Stack
     * */
    public function createContentType()
    {
        $this->createStack();
        $contentTypeInput1 = json_decode('{"content_type":{"title":"Reference","uid":"reference","schema":[{"display_name":"Title","uid":"title","data_type":"text","field_metadata":{"_default":true},"unique":"global","mandatory":true,"multiple":false},{"display_name":"URL","uid":"url","data_type":"text","field_metadata":{"_default":true},"unique":null,"mandatory":false,"multiple":false}],"options":{"is_page":true,"title":"title","sub_title":[],"description":"Reference","url_pattern":"/:title","url_prefix":"/","singleton":false}}}', true);
        $contentType1 = $this->sendRequest('content_type', $contentTypeInput1);
        $contentTypeInput2 = json_decode('{"content_type":{"title":"CTWithAllFields","uid":"ctwithallfields","schema":[{"display_name":"Title","uid":"title","data_type":"text","field_metadata":{"_default":true},"unique":"global","mandatory":true,"multiple":false},{"display_name":"URL","uid":"url","data_type":"text","field_metadata":{"_default":true},"unique":null,"mandatory":false,"multiple":false},{"data_type":"text","display_name":"Textbox","uid":"textbox","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"text","display_name":"Textbox2","uid":"textbox2","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":true},{"data_type":"text","display_name":"RTE","uid":"rte","field_metadata":{"allow_rich_text":true,"description":"","multiline":false,"rich_text_type":"advanced"},"unique":null,"mandatory":false,"multiple":false},{"data_type":"text","display_name":"Markdown","uid":"markdown","field_metadata":{"description":"","markdown":true},"unique":null,"mandatory":false,"multiple":false},{"data_type":"number","display_name":"Number1","uid":"number1","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"number","display_name":"Number2","uid":"number2","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":true},{"data_type":"boolean","display_name":"Boolean","uid":"boolean","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"isodate","display_name":"Date","uid":"date","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"file","display_name":"File","uid":"file","field_metadata":{"description":"","rich_text_type":"standard"},"unique":null,"mandatory":false,"multiple":false},{"data_type":"reference","display_name":"Reference","reference_to":"reference","field_metadata":{"ref_multiple":true},"uid":"reference","unique":null,"mandatory":false,"multiple":false},{"data_type":"group","display_name":"Group","uid":"group","unique":null,"mandatory":false,"multiple":false,"schema":[{"data_type":"text","display_name":"textbox","uid":"textbox","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"text","display_name":"Multi line textbox","uid":"multi_line","field_metadata":{"description":"","default_value":"","multiline":true},"unique":null,"mandatory":false,"multiple":false},{"data_type":"text","display_name":"Rich text editor","uid":"rich_text_editor","field_metadata":{"allow_rich_text":true,"description":"","multiline":false,"rich_text_type":"advanced"},"unique":null,"mandatory":false,"multiple":false},{"data_type":"text","display_name":"Markdown","uid":"markdown","field_metadata":{"description":"","markdown":true},"unique":null,"mandatory":false,"multiple":false},{"data_type":"number","display_name":"Number","uid":"number","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"isodate","display_name":"Date","uid":"date","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"boolean","display_name":"Boolean","uid":"boolean","field_metadata":{"description":"","default_value":""},"unique":null,"mandatory":false,"multiple":false},{"data_type":"reference","display_name":"Reference","reference_to":"reference","field_metadata":{"ref_multiple":true},"uid":"reference","unique":null,"mandatory":false,"multiple":false}]}],"options":{"is_page":true,"title":"title","sub_title":[],"description":"CTWithAllFields","url_pattern":"/:title","url_prefix":"/","singleton":false}}}', true);
        $contentType2 = $this->sendRequest('content_type', $contentTypeInput2);
        if (isset($contentType1['content_type']) && isset($contentType2['content_type'])) {
            $this->set('content_types', array($contentType1['content_type'], $contentType2['content_type']));
            echo "\nContentTypes are created.";
        } else {
            echo "\nContentTypes are not created.";
        }
    }

    /*
     * Create Environments
     * */
    public function createEnvironment() {
        $environment = $this->sendRequest('environment', array('environment'=>array("name" => "mobile","deploy_content" => false)));
        if(isset($environment['environment'])) {
            $this->set('environment', $environment['environment']);
            echo "\n\nEnvironment created.";
        } else {
            echo "\n\nEnvironment not created.";
        }
    }

    /*
     * Publish Entries
     * */
    public function publishEntries() {
        $this->createEntries();
        $cts = $this->get('content_types');
        if (isset($cts) && is_array($cts) && count($cts) > 0) {
            for ($i = 0; $i < count($cts); $i++) {
                $_pubEntries = array();
                $_entries = $this->get('entries.'.$cts[$i]['uid']);
                for ($j = 0; $j < count($_entries); $j++) {
                    $_pubEntry = $this->publishEntry($_entries[$j], $cts[$i]);
                    array_push($_pubEntries, $_pubEntry);
                }
                $this->set('publish.entries.'.$cts[$i]['uid'], $_pubEntries);
                echo "\n\nEntries of ".$cts[$i]['title']." published.";
            }
        }
    }

    public function publishEntry($entry = array(), $ct = array()) {
        $body = array(
            "entry" => array(
                "locales" => $this->lang,
                "environments" => [$this->get('environment')['name']]
            ),
            "locale"=> $entry['locale']
        );
        return $this->sendRequest('publish', $body, 'POST', array('content_type'=>$ct['uid'], 'entry' => $entry['uid']));
    }


    /*
     * Create Entries under ContentType
     * */
    public function createEntries()
    {
        $this->createContentType();
        $this->createEnvironment();
        $cts = $this->get('content_types');
        if (isset($cts) && is_array($cts) && count($cts) > 0) {
            $_entries = array();
            for ($i = 0; $i < count($cts); $i++) {
                $entries = $this->generateEntries($cts[$i], ENTRY_COUNT);
                $_entries = array();
                for($e = 0; $e < count($entries); $e++) {
                    $tmp = $this->sendRequest('entries', array("entry" => $entries[$e]), 'POST', array('content_type' => $cts[$i]['uid']));
                    if($tmp['entry'])
                        array_push($_entries, $tmp['entry']);
                }
                $this->set('entries.'.$cts[$i]['uid'], $_entries);
                echo "\nEntries Created for '" . $cts[$i]['title'] . "' ContentType.";
            }
            echo "\nEntries Done";
        } else {
            echo "\nEntries not Done";
        }
    }

    public function generateEntries($contentType = '', $count = LIMIT_ENTRY_COUNT)
    {
        $entries = array();
        // reference overwriting
        if ($contentType['uid'] === 'reference') $count = REF_ENTRY_COUNT;
        for ($i = 1; $i <= $count; $i++) {
            $tmpEntry = $this->ENTRIES[$contentType['uid']][0];
            if ($contentType['uid'] === 'ctwithallfields') {
                $tmpEntry['number1'] = $i;

                $tmpEntry['tags'] = array();
                for ($j = 1; $j <= $i; $j++) {
                    array_push($tmpEntry['tags'], 'TaG-'.$j);
                }

                for($k = 0; $k < count($tmpEntry['number2']);$k++)
                    $tmpEntry['number2'][$k] = $tmpEntry['number2'][$k] * $i;

                $tmpEntry['group']['number'] = $i;

                $allEntries = $this->get('entries.reference');
                $index = ($i % 2);
                if(isset($allEntries[$index]) && isset($allEntries[$index]['uid'])) {
                    $tmpEntry['reference'] = array($allEntries[$index]['uid']);
                    $tmpEntry['group']['reference'] = array($allEntries[(~$index + 2)]['uid']);
                } else {
                    $tmpEntry['group']['reference'] = $tmpEntry['reference'] = array();
                }
            }
            $tmpEntry['title'] = $tmpEntry['title'] . '-' . $i;
            $tmpEntry['url'] = $tmpEntry['url'] . '-' . $i;
            array_push($entries, $tmpEntry);
        }
        return $entries;
    }

    public function createValues($schema = array(), $current = 1)
    {
        $entry = array();
        for ($i = 0, $_i = count($schema); $i < $_i; $i++) {
            $value = $schema[$i]['display_name'] + $current;
            switch ($schema[$i]['data_type']) {
                case 'text'      :
                case 'datetime'  :
                    $value = date('Y-m-d\TH:i:s.Z\Z', time());
                    break;
                case 'boolean'   :
                    $value = true;
                    break;
            }
            if ($schema[$i]['multiple']) {
                $tmpValues = array();
                for ($k = 0, $_k = 5; $k < $_k; $k++) {
                    array_push($tmpValues, $value . " -- " . $k);
                }
                $value = $tmpValues;
            }
            $entry[$schema[$i]['uid']] = $value;
        }
    }

    public function generateHeaders($headers = array())
    {
        $transformedHeader = array();
        if (is_array($headers)) {
            $headers['Content-Type'] = 'application/json';
            $headers['org_uid'] = 'blt2b4991176c6c1d25';
            if (is_array($headers)) {
                foreach ($headers as $key => $val) array_push($transformedHeader, $key . ':' . $val);
            }
        }
        return $transformedHeader;
    }

    public function generateURL($type = '', $values = array())
    {   
        $_url = PROTOCOL . '://' . HOST . ((!empty(PORT) && is_numeric(PORT)) ? ':' . PORT : '') . VERSION;
        switch ($type) {
            case 'stack':
            case 'stack.delete':
                $_url .= '/stacks';
                break;
            case 'environment':
                $_url .= '/environments';
                break;
            case 'content_type':
                $_url .= '/content_types/' . ((isset($values['content_type'])) ? $values['content_type'] : "");
                break;
            case 'entries':
                $_url .= '/content_types/' . $values['content_type'] . '/entries';
                break;
            case 'unpublish':
            case 'publish':
                $_url .= '/content_types/' . $values['content_type'] . '/entries/'.$values['entry'].'/'.$type;
                break;
            case 'user-session':
                $_url .= '/user-session';
                break;
        }
        return $_url;
    }

    public function sendRequest($type = '', $payload = array(), $method = 'POST', $values = array())
    {

        $ch = curl_init($this->generateURL($type, $values));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->generateHeaders($this->headers));
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $result;
    }

    public function getAPIKEY() {
        $stack = $this->get('stack');
        return $stack['api_key'];
    }

    public function getAccessToken() {
        $stack = $this->get('stack');
        return $stack['discrete_variables']['access_token'];
    }

    public function getEnvironmentUID() {
        $environment = $this->get('environment');
        return $environment['uid'];
    }

    public function getEnvironmentName() {
        $environment = $this->get('environment');
        return $environment['name'];
    }
}

function debug($input = array(), $exit = false)
{
    echo "<pre>";
    print_r($input);
    echo "</pre>";
    if ($exit) exit();
}