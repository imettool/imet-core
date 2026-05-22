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

namespace ImetCore\Models\Imet\ScalingUp;

use Exception;
use Illuminate\Database\Eloquent\Model;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\ScalingUp\Analysis\ComparisonProtectedAreaAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\GeneralInfoAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\GroupingAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ManagementContextAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ManagementCycleAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\OverallManagementEffectivenessAnalysis;
use ImetCore\Models\Imet\ScalingUp\Analysis\ProtectedAreaAnalysis;

/**
 * Main orchestrator class for scaling up analysis
 * Delegates responsibilities to specialized analysis classes
 *
 * @property mixed $wdpas
 */
final class ScalingUpAnalysis extends Model
{
    private static int $ttl = 2;

    private static ?string $schema = Database::IMET_SCHEMA;

    protected $table = 'scaling_up';

    protected $fillable = ['wdpas'];

    public $timestamps = false;

    public const int UNDEFINED_VALUE = -99999999;

    public static ?int $scaling_id = null;

    #[\Override]
    public function getTable(): string
    {
        return Database::getTable(self::$schema, parent::getTable());
    }

    public static function get_scaling_up_by_wdpas(string $wdpas)
    {
        return self::query()->where('wdpas', $wdpas)->get();
    }

    /**
     * Get the protected area country
     *
     * @throws Exception
     */
    public static function get_protected_area_with_countries(array $form_ids): array
    {
        ProtectedAreaAnalysis::setScalingId(self::$scaling_id);

        return ProtectedAreaAnalysis::getProtectedAreaWithCountries($form_ids);
    }

    /**
     * Get protected area custom names with all the information
     */
    public static function get_protected_area(array $form_ids, bool $show_original_names = false): array
    {
        return ProtectedAreaAnalysis::data(['form_ids' => $form_ids, 'show_original_names' => $show_original_names]);
    }

    /**
     * Get general info of protected areas by form ids
     */
    public static function general_info(array $form_ids): array
    {
        GeneralInfoAnalysis::setScalingId(self::$scaling_id);

        return GeneralInfoAnalysis::data(['form_ids' => $form_ids]);
    }

    /**
     * Get management context for protected areas by form ids
     */
    public static function get_management_context(array $form_ids): array
    {
        ManagementContextAnalysis::setScalingId(self::$scaling_id);

        return ManagementContextAnalysis::data(['form_ids' => $form_ids]);
    }

    /**
     * Get the threats categories for the protected areas by form ids
     */
    public static function get_threats_categories_per_protected_area(array $form_ids): array
    {
        ManagementCycleAnalysis::setScalingId(self::$scaling_id);

        return ManagementCycleAnalysis::data(['form_ids' => $form_ids]);
    }

    /**
     * Get all management effectiveness scores for the protected areas by form ids
     */
    public static function get_overall_management_effectiveness_scores(array $form_ids): array
    {
        OverallManagementEffectivenessAnalysis::setScalingId(self::$scaling_id);

        return OverallManagementEffectivenessAnalysis::data(['form_ids' => $form_ids]);
    }

    public static function analysis_per_element_of_the_management_cycle(array $form_ids): array
    {
        ManagementCycleAnalysis::setScalingId(self::$scaling_id);

        return ManagementCycleAnalysis::analysisPerElementOfTheManagementCycle($form_ids);
    }

    public static function get_upper_lower_protected_areas_diagram_compare(array $form_ids, bool $width = true, array $assessments = [], bool $overall = true): array
    {
        ComparisonProtectedAreaAnalysis::setScalingId(self::$scaling_id);

        return ComparisonProtectedAreaAnalysis::data(['form_ids' => $form_ids, 'width' => $width, 'assessments' => $assessments, 'overall' => $overall]);
    }

    public static function get_grouping_analysis(array $parameters, array $assessments = []): array
    {
        GroupingAnalysis::setScalingId(self::$scaling_id);

        return GroupingAnalysis::data(['parameters' => $parameters, 'assessments' => $assessments]);
    }

    /**
     * @return array|array[]
     */
    public static function get_scatter_grouping_analysis(array $parameters, array $assessments = [], bool $not_grouped = false): array
    {
        GroupingAnalysis::setScalingId(self::$scaling_id);

        return GroupingAnalysis::getScatterGroupingAnalysis($parameters, $assessments, $not_grouped);
    }

    public static function get_wdpas_by_form_id(array $form_ids): array
    {
        ProtectedAreaAnalysis::setScalingId(self::$scaling_id);

        return ProtectedAreaAnalysis::getWdpasByFormId($form_ids);
    }

    /**
     * @return array|array[]
     */
    public static function get_assessments(array $form_ids): array
    {
        GroupingAnalysis::setScalingId(self::$scaling_id);

        return GroupingAnalysis::getAssessments($form_ids);
    }
}
