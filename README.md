# Media Formats Reports

## Introduction

A Drupal 8 module to provide a visual report (chart) showing the frequency of formats using either MIME type or, if Islandora FITS is installed, [PRONOM PUID](https://en.wikipedia.org/wiki/PRONOM).

## Overview

Users with "Administer Site Configuration" can visit the reports page from Drupal's Reports list. The link to "Media Formats" will show the default MIME type report:

![MIME type report](docs/images/media_report.png)

If Islandora FITS is installed, users can choose "PUID" from the "Report type" list.

Checking the "Generate a CSV file of this data" box and clicking the "Go" button will provide a link to download the CSV file.

## Configuration

To use the MIME type report, you need to configure the term IDs from the Islandora Media Use vocabulary that you want in the report. To do this, go to "Admin > Configuration > Islandora > Media Formats Reports settings".

## Pregenerating report data

This module comes with a set of Drush commands that generates the data used in the reports and caches it:

1. To list the enabled services that generate report data: `drush media_formats_reports:list_report_types`
1. To pregenerate the data for the 'puid' report: `drush media_formats_reports:build_cache puid`
1. To delete the data for the 'mimetype' report: `media_formats_reports:delete_cache mimetype`

## Requirements

* [Islandora 8](https://github.com/Islandora/islandora)
* [Islandora FITS](https://github.com/roblib/islandora_fits) is required if you want to generate the PUID report.

## Installation

1. Clone this repo into your Islandora's `drupal/web/modules/contrib` directory.
1. Enable the module either under the "Admin > Extend" menu or by running `drush en -y media_formats_reports`.

## Writing custom data source plugins

MIME type and PUID are taken from Drupal's database, but other format indicators, or sources for MIME type and PUID (such as Solr, if they are indexed) are possible through alternative data source plugins.

The `modules` subdirectory contains a sample data source plugin. The minimum requirements for a data source plugin are:

1. a .info.yml file
1. a .services.yml file
   * Within the .services.yml file, the service ID must be in the form `media_formats_reports.datasource.xxx`, where `xxx` is specific to the plugin. This pattern ensures that the plugin will show up in the list of media formats reports in the select list in the reports form.
1. a plugin class file that implements the `MediaFormatsReportsDataSourceInterface` interface.
   * The plugin's `getData()` method needs to return an associative array containing formatname => count members.

## Current maintainer

* [Mark Jordan](https://github.com/mjordan)

## License

[GPLv2](http://www.gnu.org/licenses/gpl-2.0.txt)
