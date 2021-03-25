# sure
Some really basic PHP testing.

## Example usage:
```php
<?php
use Sure\TestRunner;
$test = new TestRunner();
$test->url("localhost/", 200);
$test->url("localhost/urlthatdoesnotexist", 404);
$test->url("localhost/adminpanel", 403);
echo $test->test();
```
