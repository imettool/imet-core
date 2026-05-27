# `imet-core` - Technical documentation

1. [Architecture & technology overview](#architecture-and-technology-overview)
   1. [Backend](#backend)
   2. [Database](#database)
   3. [Frontend](#frontend)
   4. [Development environment](#development-environment)
2. [Folder structure](#folder-structure)
3. [Database structure](#database-structure)
   1. [Schemas and prefixes](#schemas-and-prefixes)
   2. [Table organization within an assessment schema](#table-organization-within-an-assessment-schema)
4. [Module descriptions](#module-descriptions)
   1. [_Intervention context_,  _Management effectiveness_ and _Analysis report_](#_intervention-context_-_management-effectiveness_-and-_analysis-report_)
   2. [Scaling up](#scaling-up)
5. [Import / Export](#import--export)
   1. [Export](#export)
   2. [Import](#import)
   3. [Upgrade system](#upgrade-system)
   4. [Automatic backups](#automatic-backups)
6. [Scoring system](#scoring-system)
   1. [What gets scored](#what-gets-scored)
   2. [How a score is computed](#how-a-score-is-computed)
   3. [Per-version differences](#per-version-differences)
   4. [Caching and refresh](#caching-and-refresh)
   5. [Public API and UI consumption](#public-api-and-ui-consumption)

> [!IMPORTANT]
> This repository does not contain a standalone application. In order to execute this codebase, you need to integrate it
> into a hosting laravel based application such as `imet-offline` or `imet-online`.

## Architecture and technology overview

The `imet-core` codebase is built using web technologies: the choice derives from the need to create a versatile tool that 
can be easily deployed across different platforms. By using web technologies, the application can be accessed through 
a standard web application, but it can also be integrated into desktop applications using frameworks like Electron or similar.

The `imet-core` is built on top of [akp/modular-forms](https://code.europa.eu/akp/modular-forms), a PHP package 
designed for building dynamic, modular data collection forms using Laravel. `imet-core` leverages its robust framework for 
creating, managing, and customizing forms, which includes models, controllers, route, and views to build the IMET assessment forms.
It is strongly suggested to read its [documentation](https://code.europa.eu/akp/modular-forms/blob/main/docs/user-guide.md) carefully.

#### Backend

The backend is written in PHP and developed using [_Laravel_](https://laravel.com/), a popular PHP framework known 
for its elegant syntax and its robust and scalable architecture, and leveraging its features for routing, database management,
and security. The `imet-core` does not directly require _Laravel,_ but requires to be integrated into a hosting application based 
on it.
PHP dependency management is handled using [_Composer_](https://getcomposer.org/), which allows an easy integration of third-party libraries 
and packages, ensuring a high level of modularity of the codebase using a `composer.json` configuration file to declare, install, 
and autoload depndencies to their required version. 

#### Database

The database interaction is managed using _Eloquent_, Laravel's Object-Relational Mapping system, which provides a simple 
and intuitive interface for working with databases. The application is actually designed to work with SQLite and PostgreSQL,
but it can be easily adapted to other relational databases with little efforts if needed.

#### Frontend

The **frontend** is built using a combination of _Blade_ templating engine (native to Laravel) and [Vue.js](https://vuejs.org/), 
a modern JavaScript framework which ensures a dynamic and responsive user interface. The styling is done using [_Tailwind CSS_](https://tailwindcss.com/), 
an utility-first CSS framework that allows for rapid UI development and a consistent design system.
The codebase provides a `package.json` package management is handled using [_npm_](https://www.npmjs.com/) (Node Package Manager), but the build 
process is delegated to the hosting application which can manage it using tools like [_Vite_](https://vitejs.dev/), a modern frontend build
tool which provides fast and efficient development experience.

### Development environment

A _docker_-based environment is available in `dev/` for development purposes, allowing developers to easily set up a consistent 
and isolated environment for working on the codebase. This is particularly useful for ensuring that all developers are working with
the same versions of dependencies and configurations, and it simplifies the process of onboarding new contributors to the project.

## Folder structure

The `imet-core` codebase is organized into several key folders, each serving a specific purpose in the development and deployment 
of the application. Below is an overview of the main folders and their contents:

- `dev/`: contains a full Laravel base application to be used for development purposes: it is not intended
  for production use. It includes all necessary dependencies and configurations to run the IMET code.
- `docs/`: documentation files
- `docker/`: together with `docker-compose.yml` in the root folder, contains the necessary files to build a Docker based environment
  for development purposes.
- `src/`: contains the main source code of the application. This is where the core functionalities of IMET are implemented
  and its structure reflects the Laravel framework conventions:
  - `Commands/`: artisan command definitions
  - `config/`: configuration files and settings
  - `Controllers/`: controller classes that handle HTTP requests and responses
  - `database/`: database migrations to set up the database
  - `Exceptions/`: custom exception classes
  - `Factories/`: model factories for generating test data
  - `Helpers/`: helper functions and utilities
  - `Jobs/`: background job classes
  - `Lang/`: localization files for different languages
  - `Middleware/`: middleware classes to manage and process HTTP requests
  - `Models/`: Eloquent model classes representing database tables
  - `Policies/`: authorization policies
  - `resources/`: views, assets, and other resources
    - `assets/`: CSS, JavaScript, images, and other static files
    - `views/`: Blade templates for rendering HTML views
  - `Routes/`: route definitions for the application
  - `Services/`: service classes encapsulating business logic
  - `View/`: custom view components and directives
  - `ServiceProvider.php`: main service provider for the application

## Database structure

The database is organized around two central concepts: the **form** and the **module**.

A **form** represents a single IMET assessment for a specific protected area and year. Each form record holds identifying metadata (protected area, country, year, language, version) and acts as the anchor to which all data is attached. A **module** is an individual thematic section of the assessment (e.g. habitats, staff, budget); each module stores its own rows in a dedicated table, linked back to the parent form via a `FormID` foreign key.

### Schemas and prefixes

To keep data sets cleanly separated, tables are organized into three logical groups, implemented as **schemas** in PostgreSQL and as **table name prefixes** in SQLite:

| Group                    | PostgreSQL schema | SQLite prefix  | Contents                                                               |
| ------------------------ | ----------------- | -------------- | ---------------------------------------------------------------------- |
| Common reference data    | `imet_common`     | `imet_common_` | Countries, currencies, regions, protected areas, species               |
| IMET v1 & v2 assessments | `imet_v1v2`       | `imet_v1v2_`   | Forms, context modules, evaluation modules, report modules, scaling-up |
| OECM assessments         | `imet_oecm`       | `imet_oecm_`   | Forms, context modules, evaluation modules, report modules             |

The `Database` helper class (`src/Helpers/Database.php`) centralises this logic and is used by every model to build its qualified table name at runtime.

### Table organization within an assessment schema

Within `imet_v1v2` (and mirrored in `imet_oecm`), tables follow a naming convention that reflects the section of the assessment they belong to:

- **`forms`** — the main assessment record (one row per IMET assessment)
- **`imet_encoders`** — people who encoded or were interviewed for the assessment
- **`context_*`** — one table per _Intervention context_ module (e.g. `context_general_info`, `context_habitats`, `context_management_staff`)
- **`eval_*`** — one table per _Management effectiveness_ evaluation module (e.g. `eval_boundary_level`, `eval_staff`, `eval_budget_adequacy`)
- **`report_*`** — one table per _Analysis report_ module, present in v2 only (e.g. `report_management_context`, `report_key_conservation_elements`)
- **`scaling_up_*`** — tables for the _Scaling up_ section, present in v1v2 only

## Module descriptions

### _Intervention context_,  _Management effectiveness_ and _Analysis report_

A significant part of the `imet-core` codebase is dedicated to the definition of the assessment modules, which are responsible 
for managing the different sections of the IMET assessment form (_Intervention context_, _Management effectiveness_ and _Analysis report_). 
Each module corresponds to a specific aspect of the protected area management effectiveness evaluation. These modules are 
designed to be extremely flexible and modular, allowing for easy customization and extension to accommodate different 
assessment needs. 

> [!IMPORTANT]
> _Intervention context_, _Management effectiveness_ and _Analysis report_ models are built on top of [akp/modular-forms](https://code.europa.eu/akp/modular-forms)
> package. It is highly recommended to refer to its documentation for a comprehensive understanding of the underlying 
> architecture and functionalities.

#### Model classes

The models are layered in a three-level hierarchy that separates generic form management, IMET-specific behaviour, and version-specific details.

At the top sits `Form` class from the `modular-forms` package which is extended by `ImetCore\Models\Imet` class: it holds logic common to all IMET 
versions — listing and filtering assessments, resolving protected area data, driving import/export, and so on. Each version then 
provides a concrete subclass (`ImetV1\Imet`, `ImetV2\Imet`, `ImetOecm\Imet`) that declares its own `$modules` map: an associative 
array grouping the module classes that belong to each navigational step (tab) of the context form. The _management effectiveness_ 
evaluation is handled by a parallel subclass (`Imet_Eval`) of the same version-specific form, whose `$modules` map covers the 
evaluation steps (context, planning, inputs, process, outputs, outcomes). The same pattern is followed by `Imet_Report` classes.

```
    ┌─────────────────────────────┐
    │   ModularForms\Models\Form  │
    └─────────────┬───────────────┘
                  │                     
                  ▼               
    ┌─────────────────────────────┐
    │     ImetCore\Models\Imet    │
    └──┬──────────────────────────┘
       │            
 ── ── │ ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── 
       │            
       │   ┌─────────────────────────┐   ┌───────────────────────┐   ┌───────────────────────┐
       ├──▶│     ..\ImetV2\Imet      │   │  ..\ImetV2\Imet_Eval  │   │ ..\ImetV2\Imet_Report │
       │   └──────┬──────────────┬───┘   └───────────────────────┘   └────┬──────────────────┘
       │          │ $modules[]   │         ▲   │ $modules[]            ▲  │ $modules[]        
       │          │              │         │   │                       │  │
       │          │              └─────────┴───│───────────────────────┘  │                   
       │          │                            │                          │                   
       │          │                            │                          │                   
       │          │     ┌───────────┐          │     ┌───────────┐        │     ┌───────────┐ 
       │          ├────▶│  Module1  │          ├────▶│  Module1  │        ├────▶│  Module1  │ 
       │          │     └───────────┘          │     └───────────┘        │     └───────────┘ 
       │          │     ┌───────────┐          │     ┌───────────┐        │     ┌───────────┐ 
       │          ├────▶│  Module2  │          ├────▶│  Module2  │        ├────▶│  Module2  │ 
       │          │     └───────────┘          │     └───────────┘        │     └───────────┘ 
       │          │     ┌───────────┐          │     ┌───────────┐        │     ┌───────────┐ 
       │          └────▶│   [...]   │          └────▶│   [...]   │        └────▶│   [...]   │ 
       │                └───────────┘                └───────────┘              └───────────┘ 
       │
       │   ┌──────────────────────────┐   ┌───────────────────────┐   ┌───────────────────────┐
       ├──▶│    ..\ImetV1\Imet        │   │  ..\ImetV1\Imet_Eval  │   │ ..\ImetV1\Imet_Report │
       │   └───────┬──────────────┬───┘   └───────────────────────┘   └────┬──────────────────┘
       │           │ $modules[]   │         ▲   │ $modules[]            ▲  │ $modules[]              
       │           .              │         │   │                       │  │      
       │           .              └─────────┴───│───────────────────────┘  │        
       │                                        .                          .  
       │   ┌─────────────────────────┐          .                          .       
       └──▶│   ..\ImetOecm\Imet      │ 
           └───────┬─────────────────┘
                   │ $modules[]
                   .
                   .
```

Module classes follow the same layered pattern. The `modular-forms` base `Module` class is extended by `ImetModule` 
(in `ImetCore\Models\Imet\Components\Modules`) which adds IMET-specific behaviour: schema-aware table resolution, dependency propagation between
modules, and injection of extra metadata into the Vue.js view layer. A sibling class `ImetModule_Eval` marks evaluation-specific 
modules. Each version then provides its own thin subclasses (`ImetV1\Modules\Component\ImetModule`, `ImetV2\Modules\Component\ImetModule`, etc.) 
that pin the schema and the parent form class. Individual modules — one PHP class per thematic section — extend the 
version-specific component class and live under `ImetV1\Modules\Context\*`, `ImetV1\Modules\Evaluation\*`, `ImetV2\Modules\Context\*`, 
and so on.

```
                                        ┌──────────────────────────────┐
                                        │  ModularForms\Models\Module  │
                                        └──────────────┬───────────────┘
                                                       │               ┌───────┐  
                                                       ▼               │       ▼
                            ┌───────────────────────────────────────┐  │   ┌──────────────────────────┐
                            │  ImetCore\Models\Imet\...\ImetModule  │  │   │    ..\ImetModule_Eval    │
                            └───────────────────┬─────────────┬─────┘  │   └────────────┬─────────────┘
                                                │             └────────┘                │    
── ── ── ── ── ── ── ── ── ── ── ── ── ── ── ── │ ── ── ── ── ── ── ── ── ── ── ── ── ──│── ── ── ── ── ── ── ── ── ── ── ─ 
                                                │                                       │
                                                │                                       └───────────────────────────────┐
                                                │                                                                       │
                       ┌────────────────────────┴───────────────┬────────────────────────────────────┐                  │
                       ▼                                        ▼                                    ▼                  │
┌─────────────────────────────────────────────┐   ┌────────────────────────────┐   ┌───────────────────────────────┐    │
│  ImetCore\Models\Imet\ImetV2\..\ImetModule  │   │  ..\ImetV1\...\ImetModule  │   │  ..\ImetVOecm\...\ImetModule  │    │
└─────────────────────┬───────────────────────┘   └─────────────┬──────────────┘   └─────────────┬─────────────────┘    │ 
                      │     ┌───────────┐                       │                                │                      │
                      ├────▶│  Module1  │                       .                                .                      │
                      │     └───────────┘                       .                                .                      │
                      │     ┌───────────┐                                                                               │
                      ├────▶│  Module2  │                                                                               │
                      │     └───────────┘                     ┌─────────────────────────────────────────────────────────┘
                      │     ┌───────────┐                     │
                      └────▶│   [...]   │                     │
                            └───────────┘                     │
                                                              │
                       ┌──────────────────────────────────────┼────────────────────────────────┐                  
                       ▼                                      ▼                                ▼
┌────────────────────────────────────────────────┐ ┌──────────────────────────────┐ ┌─────────────────────────────────┐ 
│ ImetCore\Models\Imet\ImetV2\..\ImetModule_Eval │ │ ..\ImetV1\..\ImetModule_Eval │ │ ..\ImetVOecm\..\ImetModule_Eval │ 
└────────────────────┬───────────────────────────┘ └───────────────┬──────────────┘ └───────────────┬─────────────────┘ 
                     │     ┌───────────┐                           │                                │
                     ├────▶│  Module1  │                           .                                .
                     │     └───────────┘                           .                                .
                     │     ┌───────────┐                
                     ├────▶│  Module2  │
                     │     └───────────┘
                     │     ┌───────────┐
                     └────▶│   [...]   │
                           └───────────┘
```

#### Controllers

Controllers are organized along the same version axis. The base `Controller` class (extending `__Controller`) handles the 
IMET assessment list (index) and deletion and is extended by `ImetV1\Controller` and `ImetV2\Controller`, each bound to the 
corresponding form class and view prefix.

The context, evaluation and report sections each get a dedicated controller per version:

- **`ContextController`** (`ImetV1\ContextController`, `ImetV2\ContextController`, `ImetOecm\ContextController`) — manages editing and viewing the intervention context steps; it extends the version-specific `Controller`.
- **`EvalController`** (`ImetV1\EvalController`, `ImetV2\EvalController`, `ImetOecm\EvalController`) — manages the management effectiveness evaluation steps; it extends the base `EvalController`.
- **`ReportController`** (`ImetV1\ReportController`, `ImetV2\ReportController`, `ImetOecm\ReportController`) —  adds three report-specific actions: `report` (edit view), `report_show` (read-only view), and `report_update` (save)

The `modular-forms` framework handles the actual saving and retrieving of individual module records through API endpoints; 
the `ContextController` and `EvalController` are therefore thin wrappers that resolve the form instance, check authorization, 
and delegate rendering to the appropriate Blade view.

#### Views

Blade views mirror the controller and version structure. For each version and section, there is an entry-point view 
(`edit.blade.php` / `show.blade.php`) that extends the shared `page.edit` or `page.show` layout. Individual module views 
live under a `modules/` subfolder and are loaded dynamically based on the current step and the module definitions declared 
in the form's `$modules` property. The `modules/` views are plain Blade templates that receive the module data and definition 
objects passed down from `modular-forms` and render the Vue.js component entry points.

```
resources/views/
├── v1/
│   ├── context/
│   │   ├── edit.blade.php          ← entry point for editing context
│   │   ├── show.blade.php          ← entry point for read-only view
│   │   ├── edit/modules/           ← custom blade view for `edit` mode
│   │   └── show/modules/           ← custom blade view for `show` mode
│   ├── context/
│   │   ├── edit.blade.php          
│   │   ├── show.blade.php          
│   │   ├── edit/modules/ 
│   │   └── show/modules/
│   └── report/
│       ├── edit.blade.php         
│       ├── show.blade.php          
│       ├── edit/modules/           
├── v2/                             ← same structure as v1
└── oecm/                           ← same structure as v1
```

#### Customisations over modular-forms

A useful mental model for `imet-core` is a **definition layer between `akp/modular-forms` and the hosting Laravel
application**: modular-forms supplies the generic form engine (modules, fields, persistence, the basic widget kit), the
hosting app supplies routing and a frontend build pipeline, and `imet-core` slots in the IMET-specific vocabulary —
custom input types, custom selection lists, custom Vue widgets, and custom Blade components — that make a generic form
behave like a management-effectiveness assessment.

##### Custom input types

modular-forms looks at a field's `type` to pick a renderer. `imet-core` introduces a `custom::` prefix and dispatches
those types through `ImetCore\View\CustomInput`, which extends modular-forms's `Input` component. A field definition
inside a module looks like this:

```php
$this->module_fields = [
    ['name' => 'DocumentedConnectivity',
     'type' => 'custom::radio-ImetV2_DocumentedConnectivity',
     'label' => trans('imet-core::v2_context.Connectivity.fields.DocumentedConnectivity')],
    ['name' => 'wdpa_id',
     'type' => 'custom::selector-wdpa',
     'label' => trans_choice('imet-core::common.protected_area.protected_area', 1)],
];
```

`CustomInput::render()` parses the suffix and returns the right Blade component. The catalogue falls into three groups:

- **Generic IMET widgets** — `radio-<ListType>` (styled radio bound to a selection list), `rating` (the 0–3 evaluation
  scale with its inline legend), `selector-wdpa` / `selector-wdpa_multiple` (typeahead over the protected-area
  registry), and `selector-species` / `selector-species-withInsert` (typeahead over the species registry, the second
  variant lets the encoder add a new entry inline).
- **Form-bootstrap widgets** — `version-v2`, `version-oecm`, `designation-eng`, `sub-governance-model`, used on the
  _Create_ and _CreateNonWdpa_ modules to drive assessment creation.
- **Composite domain widgets** — bespoke inputs that need to bind several fields at once: `v2-key-element`,
  `v2-ctx11-type`, `v2-importance-ecosystem-services-aspect`, `v2-menaces-aspect`,
  `v2-ecosystem-services-intervention`, `oecm-key-elements-element`, `oecm-ctx11-type`,
  `oecm-threat-with-ranking`, `oecm-support-integration-stakeholder-with-ranking`. These are the inputs the encoder
  actually spends most of their time in.

A `custom::` type the dispatcher doesn't recognise raises `UnrecognizedInputType` — typos fail loud at render time
rather than silently falling through to a generic input.

##### Custom selection lists

modular-forms's `SelectionList` resolves a list code (e.g. `Yes_No`) to an array of `value => label` pairs.
`ImetCore\Helpers\SelectionList` extends it and recognises the version-prefixed naming convention used everywhere in
`imet-core`:

| Code pattern | Resolves to |
|--------------|-------------|
| `ImetV1_*`, `ImetV2_*`, `ImetOecm_*`, `OECM_*`, `Imet_*` | a translation under `imet-core::{version}_lists.{name}` |
| `*_ProtectedArea`, `*_Country`, `*_PaCountry`, `*_Currency` | a dynamic list built from the reference-data models |
| `*_PaType` | the hard-coded OECM `terrestrial` / `marine_and_coastal` / `mixed` triple |
| anything else | fallback to modular-forms's base resolver |

So the `radio-ImetV2_DocumentedConnectivity` example above lands on the `DocumentedConnectivity` key inside
`Lang/en/v2_lists.php`. New static lists are added by dropping an entry into the relevant `*_lists.php` translation
file — no PHP changes — which keeps domain vocabulary purely declarative and translatable.

##### Vue widgets and Blade components

The custom Blade views the dispatcher returns are mostly thin shells that mount a Vue component. The Vue side lives
under `src/resources/assets/js/inputs/`:

- `selector-wdpa.vue` / `selector-wdpa_multiple.vue` — debounced typeahead against `/imet/selector/pas`.
- `selector-species.vue` — debounced typeahead against `/imet/selector/species` (with optional insert).
- `selector-user.vue` — encoder picker.
- `editor.vue` — rich-text editor used by report modules.
- `multiple-files-upload.vue` — Dropzone-based attachment uploader.
- `radio.vue` / `checkbox-boolean.vue` — styled versions of the native widgets, used wherever the design system needs
  to override the modular-forms defaults.

On the page-chrome side, `src/resources/views/components/` adds Blade components that surround the modular-forms
scaffold: `score-bar`, `score-container`, `scores` for the score widgets the encoder sees beside each evaluation
module; `heading`, `breadcrumbs_and_page_title`, `phase`, `side-buttons`, `common_filters` for the navigation and
filter chrome; and `module/not_allowed_container`, `module/nothing_to_evaluate` for the guard states (read-only because
of policy, or empty because the upstream context module hasn't been filled yet).

##### Custom module edit views

By default, modular-forms renders a module's edit form from its field definitions using a generic layout (table or
group). A module can replace that body wholesale by declaring `BODY_EDIT_BLADE_VIEW`:

```php
class Connectivity extends ImetModule
{
    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.connectivity';
    // ...
}
```

The view referenced here takes over rendering of the module body — but, depending on how much extra behaviour the
module needs, it can either lean entirely on modular-forms's JS app or swap in a custom one. The two patterns below
illustrate both ends of the spectrum.

**Blade-only customisation: `Connectivity` (v2 context)**

`Connectivity` needs a different visual layout — every field gets a sub-title under its label and the page ends with
a link-to-evaluation note — but the inputs themselves and their state management are unchanged. The custom blade
loops over the field definitions and hands each one to modular-forms's standard field renderer, then keeps the default
JS app by including the standard script component at the end:

```php
@foreach($definitions['fields'] as $i => $field)
    <div class="module-row !mb-4">
        <div class="module-row__label !w-2/5">
            <label for="{{ $field['name'] }}">{!! ucfirst($field['label'] ?? '') !!}</label>
            <div class="italic">@lang('imet-core::v2_context.Connectivity.sub_titles.' . $field['name'])</div>
        </div>
        @include('modular-forms::module.edit.field.module-to-vue', [
            'definitions' => $definitions, 'field' => $field, 'vue_record_index' => 0
        ])
    </div>
@endforeach

<x-modular-forms::module.components.script
    :module="$module" :controller="$controller" :mode="$mode"/>
```

The takeaway: `BODY_EDIT_BLADE_VIEW` is enough on its own when the customisation is layout-only. The blade is free to
restructure the HTML but still defers field rendering to `modular-forms::module.edit.field.module-to-vue`, so all
input dispatching, validation, and persistence keep working through the default JS Module instance instantiated by the
standard `<x-modular-forms::module.components.script>` component.

**Blade + custom JS class: `FinancialAvailableResources` (v2 context)**

This module is a budget grid where each row needs a live total, every column needs a sum, and the grand total has its
own validity flag. None of that is expressible through field definitions alone, so the module ships **both** a custom
blade body and a custom JS module class that extends `ModuleImet`:

```js
// src/resources/assets/js/apps/Modules/ImetV2/context/FinancialAvailableResources.js
import ModuleImet from "../../../Module.js";
import { computed } from "vue";

export default class FinancialAvailableResources extends ModuleImet {
    setupApp(props, input_data) {
        let setup_obj = super.setupApp(props, input_data);

        const line_totals   = computed(() => /* sum of the four columns for each row */);
        const column_totals = computed(() => /* sum of each column across all rows  */);
        const sumTotals     = computed(() => /* grand total                          */);
        const nationalBudgetIsValid = computed(() => columnIsValid('NationalBudget', 0));
        // ... other validity flags ...

        return { ...setup_obj, line_totals, column_totals, sumTotals,
                 nationalBudgetIsValid, /* ... */ };
    }
}
```

The blade body binds to those refs directly with regular Vue syntax — `:class="!annualTotalBudgetIsValid ? 'has-error' : ''"`,
`v-bind:value="line_totals[index]"` — and the script tag at the bottom mounts the custom class instead of the default
one:

```php
@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.FinancialAvailableResources(@json($module->vueData)))
            .mount('#module_{{ $definitions['slug'] }}');
    </script>
@endpush
```

The pattern is the same every time: extend `ModuleImet`, override `setupApp()` to call `super.setupApp()` and then
add the extra computeds / methods / watchers the module needs, register the class on the global `window.ImetCore.Apps.Modules.*`
namespace through the host app's entry point, and mount it explicitly from the custom blade. Everything modular-forms
gives you for free — records reactivity, dirty tracking, save-debounce, the score-refresh hook — keeps working because
it lives in the base class.

### Scaling up

The **Scaling Up Analysis** feature enables comparative analysis of management effectiveness across multiple protected areas.
It aggregates IMET assessment data from selected protected areas into unified visualizations, allowing users to identify
patterns, compare performance across sites, and generate consolidated reports. The system is built on a modular,
layered architecture that cleanly separates data access, business logic, and presentation concerns.

A typical scaling-up workflow:

1. **Session Creation** — The user selects multiple IMET forms (protected areas) to analyse together; the system creates
   a `scaling_id` that groups these forms into a persistent session.
2. **Analysis Execution** — The frontend sends analysis requests (e.g. _Management Context_, _Radar Analysis_); the backend
   orchestrates a pipeline of data providers, analysis classes, and chart formatters to transform raw module data into
   visualization-ready JSON.
3. **Basket Export** — The user captures charts or tables as PNG images, saves them to a temporary basket, and later
   downloads the entire collection as a ZIP archive.

#### Architecture

The feature is structured in seven layers:

| Layer | Components | Responsibility                                                        |
|-------|-----------|-----------------------------------------------------------------------|
| **Frontend** | Vue.js components, stores, composables | User interface, state management, chart rendering                     |
| **Controllers** | `ScalingUpAnalysisController`, `ScalingUpBasketController` | Receive HTTP requests, validate, authorize, dispatch to services      |
| **Services** | `DataHandleScalingUp`, `PreviewScalingUp`, `DownloadScalingUp`, helpers | Session initialization, data bundling, authorization logic            |
| **Orchestration** | `ScalingUpAnalysis` model (Facade pattern) | Dynamically route analysis method calls to the correct analysis class |
| **Analysis** | `BaseAnalysis` and 9 concrete subclasses | Compute specific analyses                                             |
| **Data Providers** | 10+ provider classes | Fetch and transform raw module data, apply filters and aggregations   |
| **Charts/Visualization** | Chart formatters (radar, table, ranking, scatter, etc.) | Convert analysis output into charts / visualization library JSON      |

The **Orchestrator pattern** is central: `ScalingUpAnalysis` acts as a facade. Controllers set a global `$scaling_id`,
then call a method like `ScalingUpAnalysis::get_radar_analysis($form_ids)`. The orchestrator resolves which analysis class
to instantiate, invokes it, and returns the result. This keeps controller logic thin and makes adding a new analysis section
a matter of adding a new analysis class and registering its method on the facade.

#### Key Components

**Backend Models:**
- **`ScalingUpAnalysis`** — the session record, orchestrator facade, and dynamic dispatcher for all analysis methods.
- **`ScalingUpWdpa`** — stores custom shortened names and colours for each protected area within a session, ensuring
  consistent labelling across all charts.
- **`Basket`** — holds temporary PNG images captured by the user; rows belong to a session and are purged on final download.

**Analysis Classes** (under `Services/Scores/ScalingUpAnalysis/`):
- Extend `BaseAnalysis`, inherit constructor pattern (`__construct($scalingId = null)`), and implement one or more public
  data methods.
- Examples: `ManagementContext`, `Grouping`, `ManagementCycle`, `DigitalTransformation`.
- Return a standard envelope: `['status' => 'success', 'data' => [...charts...]]` or `['status' => 'error', 'message' => '...']`.

**Data Providers** (under `Models/Imet/ScalingUp/Analysis/DataProviders/`):
- All **extend** `BaseDataProvider` abstract class, which provides common utility methods (constructor with `$scalingId`,
  `getProtectedAreaByFormId()`, `filterByMinOccurrences()`, `sortByOccurrenceCount()`, `getModuleAspects()`, etc.).
- Each provider encapsulates data fetching and transformation for a specific analysis domain.
- Examples: `AssessmentDataProvider`, `ComparisonProtectedAreaDataProvider`, `ThreatsDataProvider`, `ManagementCycleDataProvider`,
  `ManagementContextDataProvider`, `GeneralInfoDataProvider`, `OverallManagementEffectivenessDataProvider`.
- They apply transformations (colour assignment, indicator→label mapping, value corrections, filtering by `MIN_OCCURRENCES`),
  cache frequently used lookups, and return plain arrays/collections ready for chart formatters.
- The `BaseDataProvider` abstract class consolidates ~40+ lines of duplicate code per provider, ensuring consistency and
  maintainability across the system.

> **Architecture Note:** Previously, providers implemented an empty `DataProviderInterface`, which was removed as it provided
> no technical value. All providers now extend `BaseDataProvider` for code reuse and consistency.

**Services:**
- **`DataHandleScalingUp`** — main service; drives session initialization (`preparingData()`) which creates or updates the
  `ScalingUpAnalysis` record, populates `ScalingUpWdpa` custom names, builds a full data bundle for the initial frontend load,
  returns the section list (`templates()`), and enforces authorization via `checkAuthorization()`.
- **`PreviewScalingUp`** — read-only loader; resolves a `scaling_id`, retrieves its configuration and metadata, enforces
  authorization, and returns a summary for display (no modifications).
- **`DownloadScalingUp`** — handles ZIP export of basket items; gathers all saved PNGs for the given `scaling_id`, verifies
  authorization, zips them, and returns the archive.
- **`Common` Trait** — authorization utility; provides `checkAuthorization(array $wdpas, string $ability = 'wdpa_scaling_up')`
  method used by service classes. Iterates through IMET form IDs and throws `AuthorizationException` if the user lacks permission
  on any form. Mixed into `DataHandleScalingUp`, `PreviewScalingUp`, and `DownloadScalingUp`.

**Helpers:**
- `Helpers\ScalingUp\Common` provides 12 utility functions: `get_assessments()` (list of forms in the session),
  `get_labels()` (translate PA IDs → names/colours), `values_correction()` (normalise indicator scales),
  `get_all_indicator_labels_cached()` (memoized label dictionary), `indicator_labels()`, `modules_labels()`,
  `reset_areas_ids()` (swaps locale-dependent form lists), and locale-preservation wrappers.

**Controllers:**
- **`ScalingUpAnalysisController::analysis(Request)`** — POST endpoint; expects `{ func, parameter, scaling_id }`; performs
  authorization check on each FormID in parameters using `$this->authorize('wdpa_scaling_up', ...)`, calls
  `ModelScalingUpAnalysis::$func($parameter)` dynamically and returns JSON.
- **`ScalingUpAnalysisController::data_handle(Request)`** — delegates to `DataHandleScalingUp::preparingData()` which
  handles authorization and data preparation, then renders the report view.
- **`ScalingUpAnalysisController::download_zip_file(int)`** — delegates to `DownloadScalingUp::zipFile()` for ZIP export.
- **`ScalingUpAnalysisController::preview_template(int)`** — delegates to `PreviewScalingUp::preview()` for preview display.
- **`ScalingUpBasketController`** — CRUD for basket: `save` (store a PNG), `delete` (delete one item), `retrieve` (get one item),
  `all` (list items), `clear` (purge all). Note: Basket operations do not include explicit authorization checks; access control
  is assumed to be enforced through session creation.

#### Frontend

- **Vue.js 3 Composition API** components live under `resources/assets/js/components/scaling-up/`.
- **Stores** manage state: `BasketStore` (basket operations), `BaseStore` (shared scaling-up state), `LocalStorageStore`
  (persistent selection memory).
- **Composables** extract reusable logic (e.g. fetching analysis data, handling async state).
- **Key components:** `management-context.vue`, `scaling-radar.vue`, `datatable.vue`, `bar-category-stack.vue`,
  `scatter.vue`, `radar-threats.vue`, container components. Each receives `scaling_id` and `form_ids` as props, calls the
  backend analysis endpoint, and renders the returned charts using Apache ECharts. Users click a _Save to basket_
  button; the component uses `html2canvas` to capture the chart DOM node, encodes it as a data URL, and POSTs to
  `ScalingUpBasketController::save()`.

#### Session Management

Sessions are identified by `scaling_id` and stored in the `scaling_up` table. When the user selects a set of forms,
`DataHandleScalingUp` either **creates a new session** (if none exists for that exact combination) or **reuses an existing one**.
The `scaling_id` is returned to the frontend and attached to every subsequent analysis request. Custom PA names and colours
(stored in `scaling_up_wdpa`) persist across all analysis calls, ensuring chart legends and labels are consistent. Sessions
are long-lived by default (no automatic expiry), though basket items are purged after successful download.

#### Data Flow

1. **Request:** User clicks _Generate Management Context Analysis_ → Vue component emits `POST /scaling-up/analysis` with
   `{ func: 'get_management_context', parameter: [1, 2, 3], scaling_id: 5 }`.
2. **Controller:** `ScalingUpAnalysisController::analysis()` validates, authorizes, sets `ScalingUpAnalysis::$scaling_id = 5`,
   and calls `ScalingUpAnalysis::get_management_context([1, 2, 3])`.
3. **Orchestrator:** `ScalingUpAnalysis` sets scaling ID on `ManagementContextAnalysis`, then calls
   `ManagementContextAnalysis::data(['form_ids' => [1, 2, 3]])`.
4. **Analysis Class:** `ManagementContextAnalysis::data()` instantiates `ManagementContextDataProvider` with the scaling ID,
   fetches raw data from IMET evaluation modules (species, habitats, threats, climate change, ecosystem services), applies
   filtering (minimum 2 occurrences), sorting, and aggregation, then returns structured data.
5. **Response:** JSON structure `{ key_elements: { species: {...}, habitats: [...], threats: [...], ... } }`
   flows back to the Vue component, which renders the data using appropriate chart components.
6. **Chart Render:** Vue components use Apache ECharts library to draw visualizations. User clicks _Save to basket_ →
   `html2canvas` captures the canvas, converts to PNG, POSTs to `/basket/save`, stores the file in
   `public/basket/`.

#### Authorization & Security

**Service Layer Authorization:**
- The `Common` trait (`Services/ScalingUp/Common.php`) provides `checkAuthorization()` method that verifies `wdpa_scaling_up`
  permission on all IMET forms in the session.
- Used by service classes:
    - `DataHandleScalingUp::preparingData()` - checks authorization before preparing session data (line 120)
    - `PreviewScalingUp::preview()` - checks authorization before loading preview (line 26)
    - `DownloadScalingUp::zipFile()` - checks authorization before ZIP export (line 28)

**Controller-Level Authorization:**
- `ScalingUpAnalysisController::analysis()` - performs direct authorization using `$this->authorize('wdpa_scaling_up', ...)`
  for each FormID in the parameters array (lines 86-91), ensuring the user can access each protected area individually.
- `ScalingUpAnalysisController::data_handle()` - authorization delegated to `DataHandleScalingUp::preparingData()` service call.

**Security Measures:**
- Input `scaling_id` and `parameter` arrays are sanitized; integer coercion and array validation prevent injection.
- Authorization uses Laravel's Gate system: `Gate::denies($ability, Imet::query()->find($wdpa))`.
- Throws `AuthorizationException` if user lacks permission on any IMET form in the session.
- Basket images are stored in a non-public folder (`storage/app/scaling_analysis/basket/`).


#### Import/Export

- The feature does **not** persist analysis results in the database (scores are computed on demand). The only persistent
  artifacts are:
    - Session metadata (`scaling_up` table).
    - Custom PA names (`scaling_up_wdpa` table).
    - Basket images (filesystem, purged after download).
- **Export** is handled by `DownloadScalingUp`, which zips all PNGs in the basket and returns the archive.
- There is **no JSON import** for scaling-up sessions themselves (unlike normal IMET forms); if the underlying IMET forms
  are imported, the scaling-up session can be recreated by re-selecting the same forms.

#### Extending the Feature

Adding a new analysis section involves:

1. **Data Provider** — Create a class that extends `BaseDataProvider`, fetches the required module data,
   and returns shaped arrays. Leverage inherited utility methods from the base class for common operations.
2. **Analysis Class** — Extend `BaseAnalysis`, implement a `data($parameters)` method that instantiates
   the provider(s), computes the analysis, and returns `['status' => 'success', 'data' => [...] ]`.
3. **Orchestrator Method** — Add a public method on `ScalingUpAnalysis` (e.g. `get_budget_analysis()`) that calls
   `return (new BudgetAnalysis(static::$scaling_id))->data($parameters);`.
4. **Service Registration** — Add an entry to `DataHandleScalingUp::templates()` with the section key, translated title,
   and blade view path.
5. **View Template** — Create `resources/views/.../scaling-up/sections/budget_analysis.blade.php` that mounts the Vue component
   and passes down `scaling_id` / `form_ids`.
6. **Translation** — Add keys under `imet-core::analysis_report.*` for the section title and any UI strings.

## Import / Export

A complete assessment — the form header, its encoders, every context/evaluation/report module — can be packaged into
a single JSON file and later imported back into the same instance, or into a different one. This is how data moves
between the desktop tool (`imet-offline`) and the web instance (`imet-online`), how encoders share work, and how the
tool takes its own automatic backups.

Both directions live in one trait, `ImetCore\Controllers\Imet\Traits\ImportExportJSON`, which is mixed into every
version-specific `Controller`. The same code path serves UI downloads, batch ZIPs, and the silent backup routine.

### Export

The entry point is `Controller::export()`. It loads the requested form, checks the user is allowed to view its WDPA
(the export policy delegates to `view`), and then walks the form layer by layer to produce a tree shaped like this:

```
{
  "Imet":       { ...form header... },
  "Encoders":   [ ...encoders... ],
  "Context":    { "ModuleShortName": [ ...rows... ], ... },
  "Evaluation": { "ModuleShortName": [ ...rows... ], ... },
  "Report":     { ... }
}
```

The keys under each layer are the **short class names** of the modules (`Habitats`, `ManagementStaff`, …), which is
how the importer rediscovers where each block of rows belongs. Internal bookkeeping columns (`FormID`, `UpdateDate`,
`UpdateBy`, sync flags, internal PA pointer) are stripped so the JSON only describes the assessment, not the row that
held it.

One field is added that does **not** exist in the database: `imet_version`. It carries the version of the application
that produced the file (or the literal `online` if the offline-only helper isn't available). The importer reads this
field to decide which historical migrations need to run — without it, the upgrade chain has no way to tell a fresh
export from a five-year-old one.

If the assessment is attached to a user-defined (non-WDPA) protected area, an extra `NonWdpaProtectedArea` block is
appended so the target instance can recreate that PA before the form is inserted.

Two thin wrappers cover common UI flows: `export_no_attachments()` strips the binary `_BYTEA` fields (useful for sharing
small JSONs by email); `export_batch()` runs `export()` over a list of ids and zips the results. The CSV exporters
under _Tools_ produce one-module-across-many-assessments tables for analysts and do not go through this pipeline.

### Import

There are two entry points, both ending in the same place:

- **`upload(Request)`** receives a `.json` or `.zip` from the UI and dispatches the contents to the importer. ZIPs
  are unpacked in memory; up to ten JSON entries are honoured.
- **`import(Request, $json)`** is the actual importer. It can be called with a raw HTTP request or with a pre-decoded
  array (this is what `upload()` does internally).

`import()` wraps everything in a single database transaction so a partial failure leaves no half-imported form behind.
Inside the transaction it:

1. Recreates the local protected area if the JSON brought a `NonWdpaProtectedArea` block, and rewires the form's
   `wdpa_id` to point at it.
2. Looks at `$json['Imet']['version']` (`v1`, `v2`, `oecm`) and routes the payload to the matching family of model
   classes — `Imet::importForm`, `Imet::importModules`, `Imet_Eval::importModules`, `Encoder::importModule`. For v2
   it also runs `Imet_Report::upgradeLegacy` first to translate pre-3.x flat reports into the modular structure.
3. After the commit, **recomputes the form's scores** rather than trusting whatever scores the JSON contained — score
   values are derived data and the source instance may have computed them on a different formula version.
4. Triggers an immediate **backup** of the freshly imported form, so the new form is captured in the rolling backup
   set without waiting for the user to edit it.

A version it doesn't recognise raises `UnrecognizedVersionException`. In production any other failure is logged via
`report()` and the user sees a generic error response; in development and inside the offline tool the underlying
exception is re-thrown so the cause is visible.

One subtle behaviour worth knowing: `Imet::importForm()` reconciles the protected area against the **target** instance.
It looks up the PA by `protected_area_global_id` (or, failing that, by `wdpa_id`) and **overwrites the form's `name`
and `Country` with the local registry's values**. An assessment imported into an instance that uses different PA names
or country mappings will adopt the local naming rather than carrying the exporter's version.

### Upgrade system

A JSON exported from an older version of IMET will almost certainly carry fields that have since been renamed, removed,
split, or merged, and may reference predefined values that no longer exist. To keep historical assessments importable
indefinitely, every incoming payload runs through an **upgrade chain** before it reaches the database.

The chain has two layers, both driven by the trait `ImetCore\Models\Imet\Components\Upgrade`:

- **Per-record upgrades.** Each module class can override `upgradeModule($record, $imet_version)`, which is called
  on every row of that module before it is persisted. This is where you express things like "the column was renamed
  from `staff` to `staff_total`" or "the predefined value `MARINE_SMALL` is now `MARINE_COASTAL`". The default
  implementation is a no-op, so a module only needs to override the hook when it actually has migrations to apply.

- **Form-level upgrades.** `Imet::upgradeModules($data, $imet_version)` runs once per import, _before_ the per-record
  pass, and sees the whole multi-module payload at once. This is the right place for migrations that move data between
  modules — for instance `ImetV2\Imet::upgradeModules()` copies the currency from the financial-context module into
  the three financial-resource modules, merges the three legacy habitat modules into a single one, and splits
  connectivity data out of the territorial-context module into its own dedicated module. Cross-module migrations belong
  here because the per-record hook can't see sibling modules.

Both hooks receive `$imet_version` (the value stamped by the exporter), so overrides can branch on the source version
when they need to. In practice most migrations are written to be idempotent — the helpers below all no-op when the
input is already in the new shape — so they can simply run on every import without further checking.

A third, more specialised hook exists for v2 reports only: **`Imet_Report::upgradeLegacy()`**. Before IMET 3.x the
report was stored as a single flat record on the form; this method recognises the old field names
(`key_species_comment`, `analysis`, `strengths_swot`, `recommendations`, `priorities`, …) and synthesises rows for the
new modular report tables. It runs in addition to the regular module import, so payloads from any era still flow
through the same pipeline.

To keep individual module migrations short and uniform, the `Upgrade` trait provides a small kit of helpers:

- **`addField` / `dropField` / `renameField`** — add a column (defaulted to `null`), remove one, or rename one.
  They also handle the paired `_BYTEA` blob field used for attachments, so a renamed attachment column travels with
  its binary sibling automatically.
- **`replacePredefinedValue`** — translate one enum value to another.
- **`dropIfPredefinedValueObsolete`** — drop the entire row if it referenced a predefined value that no longer exists.
- **`dropIfValueNotInPredefinedList`** — filter a scalar or JSON-encoded array of values against the current
  `SelectionList`, dropping anything that is no longer accepted.
- **`forceCurrency`** — convert legacy monetary amounts to EUR through `Currency::exchange()` and normalise the
  currency field at the same time.
- **`replaceGroup`** — re-map a row into a renamed grouping field.

A typical module override is half a dozen calls to these helpers in sequence; the trait itself contains no business
logic beyond them.

What this means in practice for contributors:

- **Every export must carry `imet_version`.** The fallback `'online'` is treated as "older than any tagged version",
  which is the safe default.
- **Adding a column** in a module table is not just a database migration. The same column has to be added in
  `upgradeModule()` (or, if its value comes from a sibling module, in the form-level `upgradeModules()`); otherwise
  old JSONs will keep importing with the database default instead of a sensible value.
- **Removing or renaming a column** likewise needs a matching `dropField` / `renameField`. Old JSONs are in
  circulation indefinitely — the import pipeline is where they get cleaned, not the schema.
- **Cross-module migrations go on the form class**, not on an individual module, because only the form-level hook
  sees more than one module at a time.

### Automatic backups

`ImetCore\Controllers\Imet\Traits\Backup` runs only when `ImetEnv::isImetOfflineEnv()` is true — online relies on the
database as source of truth. It is invoked after every import and by other write paths.

A backup is a full JSON export under `backups/` on the default disk, named `IMET[_wdpa]_Year_FormID_YYYY-MM-DD-H-i-s.json`.
Limits: **`MAX_NUM_BACKUPS = 5` per form** (oldest is deleted on overflow); **`MIN_MINUTES_DIFF = 90` minutes** between
consecutive backups of the same form (save bursts don't flood the folder). The **first** backup of a form is always
written, regardless of the minute rule.

## Scoring system

The output of an assessment is a **set of management-effectiveness scores** derived from the raw evaluation data. Every
chart, every report, and every API value comes out of this pipeline. All scoring code lives under
`src/Services/Scores/`, with two public facades — **`ImetScores`** for v1 and v2 (v1 forms pass through a compatibility
layer that reshapes them as v2) and **`OecmScores`** for OECM — fronted by `AssessmentsScores`, the dispatch wrapper
controllers and the API actually call.

### What gets scored

Every evaluation is organised into the **six standard management-effectiveness steps**:

| Step     | Abbreviation    | Meaning                                                                                  |
| -------- | --------------- | ---------------------------------------------------------------------------------------- |
| Context  | `C`             | What the protected area protects and the pressures on it.                                |
| Planning | `P`             | Whether the area has the legal, design, and objective-setting basis it needs.            |
| Inputs   | `I`             | The resources actually available — staff, money, infrastructure, equipment, information. |
| Process  | `PR`            | How management is carried out day to day.                                                |
| Outputs  | `OP` (v1: `R`)  | Implementation of the planned work programme.                                            |
| Outcomes | `OC` (v1: `EI`) | Effects on biodiversity, ecosystem services, and local livelihoods.                      |

Each step contains a fixed list of **indicators** (`C1`, `C2`, …, `PR18`, …) that depends on the version — v2 reshapes
v1's set, OECM has its own. The constants live in `_Scores.php` and the per-version score classes; the `Labels` trait
produces the translated step titles.

A complete computation produces a two-tier structure:

```
{
  "context":  { "C1": 71.2, "C2": -45, ..., "avg_indicator": 58.4 },
  "planning": { "P1": 50.0, ..., "avg_indicator": 62.1 },
  ...
  "outcomes": { "OC1": 65.0, ..., "avg_indicator": 70.3 },
  "global":   { "context": 58.4, ..., "outcomes": 70.3 }
}
```

- **Indicator scores** are usually 0–100 (100 best). A few — notably `C2` _Supports & Constraints_, `C3` _Threats_, and
  some outcomes — are **signed pressures** on a `-100..+100` scale and are re-centred before being mixed with the rest.
- **`avg_indicator`** summarises the step: a null-skipping mean for most steps, a weighted formula for Context and
  Outcomes (which mix positive scores with signed pressures).

Indicators may legitimately be `null` when a module hasn't been filled yet. The pipeline carries `null` through every
layer (`Math::average()` is null-skipping) so partial assessments still produce scores for the steps that are complete.

### How a score is computed

Each version's score class inherits from `_Scores` and provides the six step methods
(`scores_context`, `scores_planning`, …). The base class glues them together: it calls each step method, copies each
step's `avg_indicator` into the `global` block, and computes `imet_index` from those six numbers.

Inside a step method, every indicator is computed by either a **standard helper** or a **custom function**:

- **Standard helpers** — `score_table()` and `score_group()` in `CommonFunctions`. These cover the common case where an
  indicator is the average of a single field across a module (`score_table`) or the average of per-group averages
  (`score_group`). Both filter out the sentinel value `-99` (used in the form to mean _not applicable / not assessable_)
  and scale the raw 0–3 evaluation scale to 0–100 unless a custom transform is given.
- **Custom functions** — anything more complex lives under `Services/Scores/Functions/CustomFunctions/{V1,V2,oecm}/`,
  one trait per step (`Context`, `Planning`, `Inputs`, `Process`, `Outputs`, `Outcomes`). These contain the bespoke
  formulas — weighted by species significance, ecosystem-service importance, climate vulnerability, currency-converted
  budgets, etc. Each method takes the IMET id, loads the relevant module(s), applies its formula, and returns one number
  (or `null`).

### Per-version differences

All three versions share the six-step shape; the indicators inside differ.

**v2** is the native path. `scores_context()` and `scores_outcomes()` use weighted aggregations to mix positive
indicators with the signed `C2`/`C3` and `OC2`/`OC3` pressures; the other four steps are plain means.

**v1** is read through `V1ToV2Scores`, a compatibility layer: v1's own formulas live in `V1Scores` but `ImetScores`
routes v1 forms through `V1ToV2Scores`, which re-keys and re-scales them to the v2 layout. Several mappings are
non-linear (`P3`, `I3`, `I4` use piecewise-linear curves from cross-version calibration), and a few v2 indicators
(`OP4`) have no v1 equivalent and come back as `null`. Downstream consumers don't have to care which version a form is.

**OECM** has its own indicator set, weights, and sub-aggregates (`PRA`–`PRD`). Its Process step has twelve indicators
instead of eighteen, and Outputs is `OP1`/`OP2` rather than `OP1`/`OP3`/`OP4`. It is therefore produced by its own
facade and cached under a separate key prefix.

### Caching and refresh

Scoring touches many rows and runs repeatedly per page, so results are cached in modular-forms's `Cache` model (a
database-backed key-value store) under the prefix `imet_scores` or `oecm_scores`. Entries have **no expiry** — they are
explicitly invalidated by writers:

1. **Saving an evaluation module** — modular-forms's save hook calls `refresh_scores()`, so the next chart reflects
   what was just entered.
2. **Importing a JSON** — `import()` calls `refresh_scores()` after the commit. JSON-carried scores are never trusted
   (source and target may run different formula versions).
3. **`?refresh_cache=true`** on the public API — the manual escape hatch for stale-cache suspicions.

The console command **`php artisan imet:calculate_scores`** walks every form and recomputes — the right tool after
deploying a formula change, since cache entries otherwise survive the deploy.

### Public API and UI consumption

Two endpoints expose scores: **`GET /api/imet/scores/{id}`** and **`GET /api/imet/scores_oecm/{id}`**.
Both return the full score tree plus the form's identifying fields (`form_id`, `wdpa_id`, `iso3`, `name`, `version`)
and a translated `labels` dictionary, and both honour `?refresh_cache=true`.

Inside the app, controllers and Blade views call `ImetScores::get_radar()` (radar payload), `get_step($step)` (one
step's full breakdown), or `get_score()` (just `imet_index`); the Vue charts hydrate from these. Everything routes
through the same `_Scores::get_scores()` plumbing, so a number shown in the UI is by construction the same number an
external consumer receives.
