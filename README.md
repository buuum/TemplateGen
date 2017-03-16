TemplateGen
================================

[![Packagist](https://img.shields.io/packagist/v/buuum/templategen.svg)](https://packagist.org/packages/buuum/templategen)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](#license)

## Install

### System Requirements

You need PHP >= 5.5.0 to use Buuum\templategen but the latest stable version of PHP is recommended.

### Composer

Buuum\templategen is available on Packagist and can be installed using Composer:

```
composer require buuum/templategen
```

### Manually

You may use your own autoloader as long as it follows PSR-0 or PSR-4 standards. Just put src directory contents in your vendor directory.

### Init
```php
php vendor/bin/templategen init
```

yaml config output
```yaml
groups:
  group1:
    title: Grupo 1
    templates:
      template1:
        srcs:
          - test/demo/template.php
        dest:
          - test/--file--.php
        questions:
          question1:
            title: ¿En que carpeta pondremos esto?
            replaces:
              - --folder--
              - --upper-folder--:
                - uppercase: true
              - --folder-pre-su--:
                - prefix: \
                - suffix: \
          question2:
            title: ¿Nombre del archivo de esto?
            replaces:
              - --file--
```

### Generate
```php
php vendor/bin/templategen generate
```

 
## LICENSE

The MIT License (MIT)

Copyright (c) 2017

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.