# PHP SDK for Contentstack - Unit Testing

## Prerequisite
 - Contentstack Account

## Install phpunit

 - [Installation](https://phpunit.de/manual/current/en/installation.html).

## How to run?

### Run all the test cases
```
phpunit {FileName}.php
```
### Run using report formatter

```
phpunit {FileName}.php --[tap|testdox]
```

### Run only specific cases

```
phpunit --filter {testcasename} {FileName}.php
```
### Generate report from the test case excecution

```
phpunit {FileName}.php --log-junit report.xml
```
```
phpunit {FileName}.php --testdox-html report.html
```