SHMVC stands for Simple, Hierarchical Model-View-Controller

It's a PHP framework for making websites. Simple.

# FAQs

## What are SHMVC's aims?

- Easy to set up and create a basic app
- Extendibility (plugins) and extensibility (ready for future development)
- Speed (many requests per second)
- Lightweight (only a few kb to get a fully working site)
- Introduce people to PHP 5.3's namespaces and the HMVC design pattern
- Have an extensive test suite (PHPUnit)
- Drop in to an existing project, without conflicting with anything

## Why Hierachial?

MVC is great but web pages are a collection of nested MVC blocks.

## Why not CodeIgniter / Kohana / Symphony / Zend / FUEL / ... ?

SHMVC has different aims.

## Is it ready for production?

Not yet.

## How can I help?

Test it, report issues, submit pull requests, write documentation.

# Getting started

- git clone git@github.com/dave1010/shmvc.git
- Edit ./App/Controller.php
- Edit ./config/routes.php

# Folder structure

    App - your models, controllers and views
    config
    	routes.php
    plugins
    public - js/css/images
    Shmvc - system files
    index.php - single bootsrap file

# Plugins

Plugins are similar to WordPress plugins. All .php files in the `plugins` folder are automatically included. They are loaded after the autoloader is set up (so they can use any class) but before any URL routing is done.

Plugins can either hook into actions:

    \Shmvc\add_action('hook_name', 'my_plugin_action');

Or filter variables:

    \Shmvc\add_filter('hook_name', 'my_plugin_filter', $variable);

# Helpers

Helpers are normal classes that are used from a models/views/controllers, similar to Kohana helpers. E.g.

    echo \Shmvc\Helper\Text::escape('>');

# Features

- Nice autoloading of classes
- Plugin system (loaded before routing is done)
- Controllers and basic views
- Default routing of URLs to controllers
- Custom routing, including parameters
- A configuration store (`config()`)

# TODO

- Hierachial views: Go up view folder structure to get parent (container views)
- Make sub-requests work nicely (the H in HMVC)
- Filters
- Helpers (helper classes, like Kohana)
- DB class
- ORM class
- Models extending from ORM
- Demo plugins (e.g. caching)
- Demo app
- Documentation



