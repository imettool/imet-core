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

> [!IMPORTANT]
> This repository does not contain a standalone application. In order to execute this codebase, you need to integrate it
> into a hosting laravel based application such as `imet-offline` or `imet-online`.

## Architecture and technology overview

The `imet-core` codebase is built using web technologies: the choice derives from the need to create a versatile tool that 
can be easily deployed across different platforms. By using web technologies, the application can be accessed through 
a standard web application, but it can also be integrated into desktop applications using frameworks like Electron or similar.

The `imet-core` is built on top of [andreamarelli/modular-forms](https://github.com/andreamarelli/modular-forms), a PHP package 
designed for building dynamic, modular data collection forms using Laravel. `imet-core` leverages its robust framework for 
creating, managing, and customizing forms, which includes models, controllers, route, and views to build the IMET assessment forms.
It is strongly suggested to read its [documentation](https://github.com/andreamarelli/modular-forms/blob/main/docs/user-guide.md) carefully.

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
|--------------------------|-------------------|----------------|------------------------------------------------------------------------|
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
> _Intervention context_, _Management effectiveness_ and _Analysis report_ models are built on top of [andreamarelli/modular-forms](https://github.com/andreamarelli/modular-forms)
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

### Scaling up
:construction: under development
