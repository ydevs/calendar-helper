# YDevs\CalendarHelper

A set of calendar helper functions we feel are missing from PHP and usual libraries.
For more info, check the code. It's pretty self-explanatory.

## What is this

This is just a set of functions and nice things to have concerning the manipulation
of dates, calendars, periods, etc.

This comes as a result of repeating the same helper functions project after project,
finding we always end having the same needs when it comes to developing complex PHP
applications.

Expect this library to keep piling up more functionality as we need it. **PRs are welcome
and expect no BC breaks as a general rule** (better to pile up things than to break them,
it's a helper collection anyway!)

In any case **use at your own risk**, of course.

## Dependencies

This set of functions depend heavily (and only) on `cakephp/chronos` for a saner implementation of
`\DateTimeImmutable` handling only the Date part. 

## Testing

Some tricky bits are testing and the goal is to cover as much non-trivial code as possible.
Still, it's not a priority.

To run the tests, install dependencies with `composer install` and run phpunit with `vendor/bin/phpunit`.

## Authors and License

This is the work of the PHP development team at [YDEVS](http://ydevs.com), a B2B software
development agency based in Valencia, Spain. If you need quality dev work done, contact us!

This library is released under a **MIT license**.