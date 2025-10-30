<?php

use Tests\TestCase;

pest()
    ->extend(TestCase::class)
    ->in('Browser', 'Feature');
