[![Contentstack](https://www.contentstack.com/docs/static/images/contentstack.png)](https://www.contentstack.com/)

## PHP SDK for Contentstack

Contentstack is a headless CMS with an API-first approach. It is a CMS that developers can use to build powerful cross-platform applications in their favorite languages. Build your application frontend, and Contentstack will take care of the rest. [Read More](https://www.contentstack.com/). 

Contentstack provides PHP SDK to build application on top of PHP. Given below is the detailed guide and helpful resources to get started with our PHP SDK.


### Prerequisite

You need PHP version &gt;= 5.5.0 or later installed to use the Contentstack PHP SDK.

### Setup and Installation

To use the PHP SDK, you need to perform the following steps:

1. Download/clone the PHP SDK from [here](https://github.com/builtio-contentstack/contentstack-php.git). 
2. Paste the downloaded ZIP file of the PHP SDK to a folder of your choice. 

To initialize the SDK, you will need to specify the API Key, Access Token, and Environment Name of your stack.

    use Contentstack\Contentstack;include_once "contentstack/index.php";
    $stack = Contentstack::Stack(API_KEY, ACCESS_TOKEN, ENV_NAME);

### Key Concepts for using Contentstack

#### Stack

A stack is like a container that holds the content of your app. Learn more about [Stacks](https://www.contentstack.com/docs/guide/stack).

#### Content Type

Content type lets you define the structure or blueprint of a page or a section of your digital property. It is a form-like page that gives Content Managers an interface to input and upload content. [Read more](https://www.contentstack.com/docs/guide/content-types).

#### Entry

An entry is the actual piece of content created using one of the defined content types. Learn more about [Entries](https://www.contentstack.com/docs/guide/content-management#working-with-entries). 

#### Asset

Assets refer to all the media files (images, videos, PDFs, audio files, and so on) uploaded to Contentstack. These files can be used in multiple entries. Read more about [Assets](https://www.contentstack.com/docs/guide/content-management#working-with-assets). 

#### Environment

A publishing environment corresponds to one or more deployment servers or a content delivery destination where the entries need to be published. Learn how to work with [Environments](https://www.contentstack.com/docs/guide/environments). 

  
  

### Contentstack PHP SDK: 5-minute Quickstart

#### Initializing your SDK 

To initialize the SDK, you need to provide values for the keys given in the snippet below:

    use Contentstack\Contentstack;include_once "contentstack/index.php";
    $stack = Contentstack::Stack(API_KEY, ACCESS_TOKEN, ENV_NAME);

To get the API credentials mentioned above, log in to your Contentstack account and then in your top panel navigation, go to Settings &gt; Stack to view the API Key and Access Token.

  

#### Querying content from your stack

To find all entries  of a content type, use the query given below:

    $result = $stack->ContentType(CONTENT_TYPE_UID)->Query()->toJSON()->includeCount()->includeContentType()->find()
    // $result[0] - array of entries
    // $result[1] - content type
    // $result[2] - count of the entries

  
  

To fetch a specific entry from a content type, use the following query:

    $result = $stack->ContentType(CONTENT_TYPE_UID)->Entry(ENTRY_UID)->toJSON()->fetch()
    // $result - entry object

### Advanced Queries

You can query for content types, entries, assets and more using our PHP API Reference. 

[PHP API Reference Doc](https://www.contentstack.com/docs/platforms/php/api-reference/)

  

### Working with Images

We have introduced Image Delivery APIs that let you retrieve images and then manipulate and optimize them for your digital properties. It lets you perform a host of other actions such as crop, trim, resize, rotate, overlay, and so on. 

For example, if you want to crop an image (with width as 300 and height as 400), you simply need to append query parameters at the end of the image URL, such as, https://images.contentstack.io/v3/assets/blteae40eb499811073/bltc5064f36b5855343/59e0c41ac0eddd140d5a8e3e/download?crop=300,400. There are several more parameters that you can use for your images. 

[Read Image Delivery API documentation](https://www.contentstack.com/docs/apis/image-delivery-api/). 

You can use the Image Delivery API functions in this SDK as well. Here are a few examples of its usage in the SDK.

// set the image quality to 100
imageUrl = Stack->imageTransform(imageUrl, array(
'quality'=> 100
));

// resize the image by specifying width and height
imageUrl = Stack->imageTransform(imageUrl, array(
'width'=> 100,
'height'=> 100
));

// enable auto optimization for the image
imageUrl = Stack.imageTransform(imageUrl, array(
'auto'=> 'webp'
))



### Helpful Links

- [Contentstack Website](https://www.contentstack.com) 
- [Official Documentation](https://contentstack.com/docs) 
- [Content Delivery API Docs](https://contentstack.com/docs/apis/content-delivery-api/) 

### The MIT License (MIT)

Copyright © 2012-2017 [Built.io](https://www.built.io/). All Rights Reserved

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
