# Drupal Update Client

Bootstrapping a new Drupal environment for CI workflows is somewhat in flux
right now. Drush no longer supports downloading projects, instead recommending
a composer-based workflow. Drupal core does not have reusable code for
interacting with `updates.drupal.org`'s API as it's all coupled to
`update.module`.

I wanted something to let me quickly download any release from drupal.org, as
well as a real-world opportunity to learn what the state of XML deserializers
in PHP was. If Drupal doesn't go to a full-composer workflow, perhaps this
library will be useful to modernize the Update module.

## Features

* A strongly-typed set of classes representing Projects, Releases, and Files.
* Serialization and deserialization of Projects from XML retreived from
  drupal.org.
* An example of using the JMS Serializer library.
  * This originally used Symfony's Serializer component, but it lacks support
    for XML namespaces and generally seems to better support JSON.
* A console command to download and extract projects.
