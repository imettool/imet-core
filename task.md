# Task: Remove all 'blade-' types from every module

## Goal
Replace any 'blade-' types found in every module of the package with a proper definition in Input ad InputPreview classes.

---

## Rules
- Do **not** change anything else but the module_fields type in the module classes
- If a specific 'blade-' type is found in multiple modules do not repeat the same definition but reuse what had been already defined in Input ad InputPreview classes
- create the new blade view files in `src/resources/views/components/inputs` and `src/resources/views/components/inputs-preview`
- remove any existing blade view files that are no longer needed

---

## Context to read 
1. `src/View/CustomInput.php` and `src/View/CustomInputPreview.php` — proper classes where to define custom input types
2. `src/Models/Imet/ImetV2/Modules` and `src/Models/Imet/ImetOecm/Modules` — module classes
3. `src/resources/views/v2/**/fields/*.php` and `src/resources/views/oecm/**/fields/*.php` — existing custom types blade view files to be moved and renamed
4. `src/resources/views/components/input` and `src/resources/views/components/input-preview` — destination folders for the new custom types blade view files

---

## Steps
1. Identify and list all the module classes from `src/Models/Imet/ImetV2/Modules` and `src/Models/Imet/ImetOecm/Modules` where a `module_fields` `type` has the `blade-` prefix
2. List all the found types with its related class
3. **Pause and show me this list before continuing.**
4. For each item of the list execute the following steps

    1. Parse each custom type definition to extract the existing blade view path. For example, if the `type` is `'blade-imet-core::v2.evaluation.fields.key_element'`, the blade views can be found at `src/resources/views/v2/evaluation/edit/fields/key_element.blade.php` and/or at `src/resources/views/v2/evaluation/show/fields/key_element.blade.php`
    2. If the `edit` blade view is found:
       1. Change the `type` in the module class, giving it a unique logical name
       2. move the existing blade view to `src/resources/views/components/input/` renaming the file using the new `type`. Skip if an identical blade view already exists
       3. Add an if statement in `src/View/CustomInput.php` class which return the new blade view
    3. If the `show` blade view is found:
       1. Change the `type` in the module class, giving it a unique logical name
       2. move the existing blade view to `src/resources/views/components/input-preview/` renaming the file using the new `type`. Skip if an identical blade view already exists
       3. Add an if statement in `src/View/CustomInputPreview.php` class which return the new blade view
