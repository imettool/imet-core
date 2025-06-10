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

namespace ImetCore\Helpers\API\DOPA;

use ModularForms\Helpers\API\DOPA\Wdpa as BaseWdpa;

trait Wdpa
{
    use BaseWdpa;

   /**
   * Returns the copernicus Global Landcover for wdpa
   * @param $wdpa
   * @return array
   */
    public static function get_wdpa_copernicus($wdpa): object
    {
         return self::request(self::API_URL . 'd6dopa/dopa_41/get_de_wdpa_lc_copernicus', [
            'format' => 'json',
            'wdpaid' => $wdpa,
            'agg' => 2
        ]);
    }

    /**
     * Returns all indicators for pa
     *
     * @param $wdpa
     * @return array
     */
    public static function get_de_wdpa_all_inds($wdpa): object
    {
        return self::request(self::API_URL . 'd6dopa/dopa_41/get_de_wdpa_all_inds', [
            'format' => 'json',
            'wdpaid' => $wdpa
        ]);
    }

}
