<?php

namespace ImetCore\Services\ScalingUp;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use ImetCore\Models\Imet\v2\Imet;

trait Common
{
    /**
     * @param array $wdpas
     * @param string $ability
     * @return void
     * @throws AuthorizationException
     */
    protected static function checkAuthorization(array $wdpas, string $ability = 'wdpa_scaling_up'): void
    {
        foreach ($wdpas as $wdpa) {
            if (Gate::denies($ability, Imet::find($wdpa))) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        }
    }

}
