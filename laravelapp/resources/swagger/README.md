# swagger-build

This package prepared for building swagger

# installation and usage

## laravel
**install:**

``cd {project-folder}``

``git clone ssh://git@gitlab.addamant-work.ru:2222/packages/swagger-build.git resources/swagger``

``rm resources/swagger/.gitignore``

``rm -rf resources/swagger/.git/``

**usage and build:**

prepare your openapi yamls

``cd {project-folder}``

``/bin/bash ./resources/swagger/build.sh``

script will gather all the .yaml files in "yaml" directory and glue them up into one "buld.yaml" file.

you can use any folders/filepaths structure in "yaml" directory
