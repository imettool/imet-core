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

namespace ImetCore\Helpers;

use Illuminate\Support\Str;


class ModuleKey{

    public const separator = '__';

    /**
     * Return ClassName from module key
     */
    public static function KeyToClassName($module_key): ?string
    {
        $items = explode(self::separator, $module_key);

        $module_class = 'ImetCore\\Models';
        foreach ($items as $index => $item) {
            if($index===1){
                $module_class .= '\\' . $item; // Version
                $module_class .= '\\Modules';
            } else{
                $module_class .= '\\' . ucfirst(Str::camel($item));
            }
        }
        if (class_exists($module_class)) {
            return $module_class;
        }
        return null;
    }

    /**
     * Return view for the given module
     */
    public static function KeyToView($module_key, $view_mode = null): ?string
    {
        if (Str::startsWith($module_key, 'imet')) {
            $view = Str::replaceLast(ModuleKey::separator, '.' . $view_mode . '.modules.', $module_key);
            $view = str_replace(ModuleKey::separator, '.', $view);
            $view = Str::replaceFirst('imet.', 'imet-core::', $view);
            if ($view !== null && view()->exists($view)) {
                return $view;
            }
        }

        return null;
    }

}
