<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'class_loader.php';

class Sum1To10Job extends AbstractJob
{
    public function handle()
    {
        $sum = 0;
        for ($i = 1; $i < 11; $i++) {
            $sum += $i;
        }
        usleep(10000000);

        return $sum;
    }
}