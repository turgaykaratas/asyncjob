<?php
require_once 'class_loader.php';

/**
 * @var string
 */
$encodeJob = $argv[1];

/**
 * @var AbstructJob $job
 */
$job = unserialize(base64_decode($encodeJob));

try {
    $r = $job->handle();
    $result = new Result(Result::OK, $r);
} catch (Exception $e) {
    $result = new Result(Result::ERR, $e->getMessage());
}

$encodeResult = base64_encode(serialize($result));

fwrite(STDOUT, $encodeResult);

exit(0);
?>