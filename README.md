# APM Instrumentation Team
## Coding Interview
Thanks for your interest in working with us to build awesome application performance monitoring software!

This repo outlines a small project that we'd like you to build in advance of your interview. You'll submit a copy of your work in advance, then we'll discuss it with you as part of the interview.

## Project goal
Given is a PHP Extension Skeleton that provides a basis structure for implementing a custom PHP extension. The goal is to add new PHP functions to increment/get/reset a global counter. Please implement:

#### SolarwindsIncrement()
PHP function that increments a global internal counter by 1.

#### SolarwindsGetTotal()
PHP function that returns the value of the global internal counter.

#### SolarwindsReset()
PHP function that resets the global internal counter to 0.

Provided is also a demo script called `script.php`. This script starts 8 worker threads that each increment the global counter. Please do not modify the demo script but do all the work needed inside the extension code (`php_solarwinds.h` and `solarwinds.c`).

You can run the demo script in CLI mode to verify your output: `php script.php`.

## Project requirements checklist
- [ ] Compile, install and run the PHP extension
- [ ] Add three new PHP functions: SolarwindsIncrement, SolarwindsGetTotal, SolarwindsReset
- [ ] In addition to the demo script provide some basic tests

_Note: It is not necessary to use a web server (e.g. Apache) for this challenge. The CLI should be sufficient._

## Working with the project
We've made a copy of this repo just for you and given you push access.  When you're ready to start working, clone the repo and edit away.  The repo is just yours, so you can commit straight to master if you want, but bonus points for opening a PR for a feature branch.  When you're done, make sure you've pushed all your changes to the repo and drop us a line.

## Getting started
To help get started we've provided a Dockerfile which can be run to create a useful environment for implementing, building and testing the PHP extension. You will need to have docker installed.

First clone this repo and cd into it:
```
# git clone <THIS_REPO> instrumentation-coding-interview-php
# cd instrumentation-coding-interview-php
```

Run this command to build the docker image:
```
# docker build -t php-extension-challenge .
```

Start a new container based on the newly created image:
```
# docker run -it -v $(pwd):/php-extension-challenge php-extension-challenge bash
```

Inside the container, build the empty PHP extension:
```
# cd php-extension-challenge/extension/
# phpize
# ./configure
# make
# make install
# echo extension=solarwinds.so >> /usr/local/lib/php.ini
```

At this point you have a functioning and properly installed PHP extension. You can test by running this command and check the output:
```
# php -r ''
PHP_MINIT_FUNCTION solarwinds
PHP_RINIT_FUNCTION solarwinds
PHP_RSHUTDOWN_FUNCTION solarwinds
PHP_MSHUTDOWN_FUNCTION solarwinds
```
_Note: The last line (`PHP_MSHUTDOWN_FUNCTION`) may not be always printed, although the `MSHUTDOWN` is being executed._
