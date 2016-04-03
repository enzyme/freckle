<img src="https://cloud.githubusercontent.com/assets/2805249/14230969/0916d2f6-f9b3-11e5-8e30-864a599f2e2d.png" width="200">

[![Build Status](https://travis-ci.org/enzyme/freckle.svg?branch=master)](https://travis-ci.org/enzyme/freckle)
[![Coverage Status](https://coveralls.io/repos/enzyme/freckle/badge.svg?branch=master&service=github)](https://coveralls.io/github/enzyme/freckle?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/enzyme/freckle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/enzyme/freckle/?branch=master)

Freckle is a collection of information accessors. It allows you to traverse and get the values in arrays and other collection types using dot separated paths. For example, getting the value in a multi-dimensional-associative array for `users.bob456.name`, given the array:

```php
$array = [
    'users' => [
        'jane123' => ['name' => 'Jane Foo'],
        'bob456'  => ['name' => 'Bob Foo'],
    ]
];
```

would return the value of `Bob Foo`. Pretty straight forward hey?

# Installation

```bash
composer require enzyme/freckle
```

# Usage

Getting a value from a simple collection.

```php
use Enzyme\Freckle\Dot;

$array = [
    'users' => [
        'jane123' => ['name' => 'Jane Foo'],
        'bob456'  => ['name' => 'Bob Foo'],
    ]
];

$dot = new Dot;
$full_name = $dot->get($array, 'users.bob456.name'); // returns "Bob Foo".
```

Getting a value from a simple collection with numeric keys.

```php
use Enzyme\Freckle\Dot;

$array = [
    'users' => [
        0 => [
            'jane123' => ['name' => 'Jane Foo'],
        ],
        1 => [
            'bob456'  => ['name' => 'Bob Foo'],
        ]
    ]
];

$dot = new Dot;
$full_name = $dot->get($array, 'users.bob456.name'); // returns "Bob Foo".
```

In the event that a collection has numeric keys or supports multiple entries with the same key name, only the first result found will ever be returned.

If no value can be found, `null` will be returned instead. **Be careful though** if you're checking against the null value for success as you may get false positives if an actual value was found, but that value happens to be `null`.

# Contributing

Please see `CONTRIBUTING.md`

# License

MIT - Copyright (c) 2015 Tristan Strathearn, see `LICENSE`
