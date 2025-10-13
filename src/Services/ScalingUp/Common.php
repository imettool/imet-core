<?php

namespace ImetCore\Services\ScalingUp;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use ImetCore\Models\Imet\v2\Imet;
use Throwable;

trait Common
{
    /**
     * @throws AuthorizationException
     * @throws Throwable
     */
    protected static function checkAuthorization(array $wdpas, string $ability = 'api_scaling_up'): void
    {
        foreach ($wdpas as $wdpa) {
            throw_if(Gate::denies($ability, Imet::query()->find($wdpa)), AuthorizationException::class, 'This action is unauthorized.');
        }
    }

}
