# Kahlan Issue

Code for reproducing an issue I've found with Kahlan.

When running `spec/functional/example.com.spec.php`, I'm getting errors along these lines:

```shell
✖ Tests that example.com can be curled
  an uncaught exception has been thrown in `vendor/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php` line 158

  message:`ParseError` Code(0) with message "Unclosed '{' on line 142 does not match ')'"

    [NA] - vendor/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php, line  to 158
```

If I then touch that file with a code change (I've been inserting a `true;` into it) - whitespace changes are not enough -
then I get another similar error in three subsquent files, and after I touch each of those, the test runs fine.

By way of contrast, running the equivalent code in PHPUnit has no such issue, so am certain it's not a problem with
Guzzle, it's something with how Kahlan is calling code.

The problem only seems to occur *once* for the life time of the file at that location: I can blow-away `vendor` and reinstall,
and the problem does not recur. If I relocate the app (say from `C:\src\kahlanIssue` to `C:\temp\kahlanIssue`), then
the issue recurs again, in exactly the same way. It does not matter if I run the PHPUnit tests first to "warm-up" the code.
This is all quite puzzling as PHP (nor anything else) should be caching any knowledge of those files
across executions of the `php` app.

I can replicate at will this on the native Windows file system, on Ubuntu under WSL on the same machine, and on Ubuntu within
a Docker container on same machine.
