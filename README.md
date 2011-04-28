SHMVC stands for Simple, Hierarchical Model-View-Controller

It's a PHP framework for making 

# FAQs

## What are SHMVC's aims?

- Easy to set up and create a basic app
- Extendibility (plugins) and extensibility (ready for future development)
- Speed (many requests per second)
- Lightweight (only a few kb to get a fully working site)
- Introduce people to PHP 5.3's namespaces and the HMVC design pattern
- Have an extensive test suite (PHPUnit)

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

App
config
	routes.php
Plugin
public
Shmvc
	Controller.php
index.php

# TODO

- Go up view folder structure to get parent (container views)
- Sub-requests
- License (BSD/MIT)
- Plugins (loaded before routing is done, e.g. caching)
- Helpers (helper classes)
- Demo app
- Documentation
- DB class
- ORM class
- Models extending from ORM
