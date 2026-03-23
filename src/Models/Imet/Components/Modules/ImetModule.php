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

namespace ImetCore\Models\Imet\Components\Modules;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;
use ImetCore\Helpers\Database;
use ImetCore\Models\Imet\Components\Dependencies;
use ImetCore\Models\User\Role;
use ImetCore\View\CustomInput;
use ImetCore\View\CustomInputPreview;
use ModularForms\Exceptions\ValidationException;
use ModularForms\Models\Module;
use ReflectionException;

class ImetModule extends Module
{
    use Dependencies;
    use InjectInView;

    protected static ?string $form_class;

    public const CREATED_AT = 'UpdateDate';

    public const UPDATED_AT = 'UpdateDate';

    public const UPDATED_BY = 'UpdateBy';

    public const TERRESTRIAL = 'terrestrial';

    public const TERRESTRIAL_AND_MARINE = 'terrestrial_and_marine';

    public const MARINE = 'marine';

    public const ?string MODULE_SCOPE = self::TERRESTRIAL_AND_MARINE;

    public const string SCRIPT_EDIT_BLADE_VIEW = 'imet-core::components.module.edit.script';
    public const string SCRIPT_SHOW_BLADE_VIEW = 'imet-core::components.module.show.script';

    public const string INPUT_COMPONENT_VIEW = CustomInput::class;
    public const string INPUT_PREVIEW_COMPONENT_VIEW = CustomInputPreview::class;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static ?string $schema = null;

    protected $primaryKey = 'id';

    public static ?string $foreign_key = 'FormID';

    public bool $enable_raw_export = true;

    /** @phpstan-var null|array<string, array<string|int, string>> $ratingLegend */
    public ?array $ratingLegend;

    public $module_subTitle;

    public $module_info_EvaluationQuestion;

    public $module_info_Rating;

    // Override modular-forms views
    public const string MODULE_TITLE_VIEW = 'imet-core::components.module.components.title';

    public const string MODULE_INFO_BAR_VIEW = 'imet-core::components.module.components.bars.info';

    public const string MODULE_SCRIPT_EDIT_VIEW = 'imet-core::components.module.edit.script';

    public const string MODULE_SCRIPT_SHOW_VIEW = 'imet-core::components.module.show.script';

    /**
     * Override: get the table name with schema
     */
    #[\Override]
    public function getTable(): ?string
    {
        return static::$schema !== null ?
            Database::getTable(static::$schema, parent::getTable())
            : null;
    }

    /**
     * Relation to IMET form
     */
    public function imet(): BelongsTo
    {
        return $this->belongsTo(static::$form_class, 'FormID');
    }

    /**
     * Override: additional info labels
     *
     * @throws ReflectionException
     */
    #[\Override]
    public static function getDefinitions(?int $form_id = null): array
    {
        $definitions = parent::getDefinitions($form_id);
        $model = new (static::class);
        $definitions['ratingLegend'] = $model->ratingLegend ?? null;
        $definitions['module_subTitle'] = $model->module_subTitle;
        $definitions['module_info_EvaluationQuestion'] = $model->module_info_EvaluationQuestion;
        $definitions['module_info_Rating'] = $model->module_info_Rating;
        $definitions['module_scope'] = static::MODULE_SCOPE;

        return $definitions;
    }

    /**
     * Override: Get predefined_values according to form language
     */
    public static function getPredefined(?int $form_id = null): ?array
    {
        static::forceLanguage($form_id);

        return parent::getPredefined($form_id);
    }

    /**
     * Override: Check for "warning_on_save" labels
     */
    #[\Override]
    public static function getVueData(?int $form_id, array $records, array $definitions): array
    {
        $vue_data = parent::getVueData($form_id, $records, $definitions);

        return static::warningOnSave($vue_data);
    }

    /**
     * Override: update dependent modules
     *
     * @throws ValidationException
     */
    #[\Override]
    public static function updateModuleRecords(array $records, ?int $form_id): void
    {
        static::updateDependencies($records, $form_id);
        parent::updateModuleRecords($records, $form_id);
    }

    /**
     * Force locale to IMET language in order to retrieve correct label from lang
     */
    public static function forceLanguage($form_id = null): void
    {
        if ($form_id !== null) {
            $FormLang = (static::$form_class)::getLanguage($form_id);
            if ($FormLang != App::getLocale()) {
                App::setLocale($FormLang);
            }
        }
    }
}
