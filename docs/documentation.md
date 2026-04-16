# `imet-core` - Technical documentation

> [!IMPORTANT]
> This repository does not contain a standalone application. In order to execute this codebase, you need to integrate it
> into a hosting laravel based application such as `imet-offline` or `imet-online`.

## Architecture & technology overview
:construction: under development

The `imet-core` codebase is built using web technologies: the choice derives from the need to create a versatile tool that 
can be easily deployed across different platforms. By using web technologies, the application can be accessed through 
a standard web application, but it can also be integrated into desktop applications using frameworks like Electron or similar.

The `imet-core` is built on top of [andreamarelli/modular-forms](https://github.com/andreamarelli/modular-forms), a PHP package 
designed for building dynamic, modular data collection forms using Laravel. `imet-core` leverages its robust framework for 
creating, managing, and customizing forms, which includes models, controllers, route, and views to build the IMET assessment forms.

The **backend** is written in PHP and developed using [_Laravel_](https://laravel.com/), a popular PHP framework known 
for its elegant syntax and its robust and scalable architecture, and leveraging its features for routing, database management,
and security. The `imet-core` does not directly require _Laravel,_ but requires to be integrated into a hosting application based 
on it.
PHP dependency management is handled using [_Composer_](https://getcomposer.org/), which allows an easy integration of third-party libraries 
and packages, ensuring a high level of modularity of the codebase using a `composer.json` configuration file to declare, install, 
and autoload depndencies to their required version. 

The database interaction is managed using _Eloquent_, Laravel's Object-Relational Mapping system, which provides a simple 
and intuitive interface for working with databases. The application is actually designed to work with SQLite and PostgreSQL,
but it can be easily adapted to other relational databases with little efforts if needed.

The **frontend** is built using a combination of _Blade_ templating engine (native to Laravel) and [Vue.js](https://vuejs.org/), 
a modern JavaScript framework which ensures a dynamic and responsive user interface. The styling is done using [_Tailwind CSS_](https://tailwindcss.com/), 
an utility-first CSS framework that allows for rapid UI development and a consistent design system.

The codebase provides a `package.json` Package management is handled using [_npm_](https://www.npmjs.com/) (Node Package Manager), but the build 
process is delegated to the hosting application which can manage it using tools like [_Vite_](https://vitejs.dev/), a modern frontend build
tool which provides fast and efficient development experience.

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
:construction: under development

## Module descriptions
### _Intervention context_ and _Management effectiveness_
A significant part of the `imet-core` codebase is dedicated to the definition of the assessment modules, which are responsible 
for managing the different sections of the IMET assessment form (_Intervention context_ and _Management effectiveness_). 
Each module corresponds to a specific aspect of the protected area management effectiveness evaluation. These modules are 
designed to be extremely flexible and modular, allowing for easy customization and extension to accommodate different 
assessment needs. 

> [!IMPORTANT]
> _Intervention context_ and _Management effectiveness_ models are built on top of [andreamarelli/modular-forms](https://github.com/andreamarelli/modular-forms)
> package. It is highly recommended to refer to its documentation for a comprehensive understanding of the underlying 
> architecture and functionalities.

:construction: under development

### Analysis report
:construction: under development
### Scaling up
:construction: under development

## Development workflow
:construction: under development
### Development environment setup
:construction: under development
### Git branching strategy and contribution guidelines
:construction: under development
### Coding standards and conventions
:construction: under development
### Code quality and testing
:construction: under development
