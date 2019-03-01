# Stage File Proxy plugin for Craft CMS 3.x

Stage File Proxy is a general solution for getting production files on a development server on demand. It saves you time
and disk space by sending requests to your development environment's files directory to the production environment and 
making a copy of the production file in your development site. You should not need to enable this plugin in production.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require liftov/craft-stage-file-proxy

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Stage File Proxy.

## Stage File Proxy Overview
During development, when working with multiple developers on the same project, it can be very cumbersome and time consuming to have to transfer
uploaded files between development environments.
With this plugin you only need to keep one remote environment up-to-date, like a staging server and every local environment
will be updated. And only with the files needed.

In case of updates on a website in production, that site can be used as the source for all the assets. Again the locale development
environment will only retrieve the files necessary. This is especially useful for large sites with huge numbers of files.

The plugin idea is based in the Drupal Module 'Stage File Proxy' (https://www.drupal.org/project/stage_file_proxy). 
Although except for the description, non of the code is used.

## Configuring Stage File Proxy

Add the following line to your local .env file:

    STAGE_FILE_PROXY_REMOTE="http://remote.site.url/"

Optionally add the following line if your files don't live in the "files" folder

    STAGE_FILE_PROXY_BASE_FOLDER="custom/subfolder"


## Using Stage File Proxy

The plugin works behind the scenes so there is no need to do anything.

It will check the local file base for the file and if it can't be found, downloads it from the remote source.

Since this happens before any other actions are taken with the file, this also works well together with Image Transform
and plugins like Imager.


Brought to you by [Wouter Van Scharen](liftov.be)
