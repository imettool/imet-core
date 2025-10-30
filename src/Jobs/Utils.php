<?php

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Jobs;

use Symfony\Component\Console\Output\ConsoleOutput;

trait Utils
{
    private static function log($message, $type = 'comment'): void
    {
        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }

        $output = new ConsoleOutput;
        if ($type == 'info') {
            $output->writeln('<info>'.$message.'</info>');
        } elseif ($type == 'comment') {
            $output->writeln('<comment>'.$message.'</comment>');
        } elseif ($type == 'error') {
            $output->writeln('<error>'.$message.'</error>');
        } elseif ($type == null) {
            $output->writeln($message);
        }
    }
}
