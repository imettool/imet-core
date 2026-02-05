# IMET Core documentation

## Overall system and codebases architecture
*TBD*

## Technology stack
*TBD*

## Folder structure
The IMET core codebase is organized into several key folders, each serving a specific purpose in the development and deployment 
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
*TBD*

## Module descriptions
### Intervention context
*TBD*
### Management effectiveness
*TBD*
### Analysis report
*TBD*
### Scaling up
*TBD*

## Development workflow
*TBD*
### Development environment setup
*TBD*
### Git branching strategy and contribution guidelines
*TBD*
### Coding standards and conventions
*TBD*
### Code quality and testing
*TBD*

