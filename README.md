# Shoalcreek: APL Website Setup

## Overview

This repository contains everything needed to set up the Shoalcreek APL website locally using DDEV. It could also serve as a resource for other environments like Lando, XAMPP, or bare-metal installations of LAMP. The essentials for any Drupal installation—code, database, and files—are all included.

## Prerequisites

- DDEV installed
- Colima installed and running
- Composer (usually comes with DDEV)

## Quick Start

For those who want to get started quickly and have the prerequisites already in place, just clone this repository and run the setup script:

```bash
./setup.sh
```

This will take care of database import, dependency updates, and environment setup.

## Manual Setup Steps

### Code

The Drupal codebase, including the core and modules, are managed using Composer, allowing for easy updates and dependency management.

### Database

A recent backup of the database is available in the `export/` directory. Import it using:

```bash
ddev import-db --file=export/db.sql.gz
```

### Files

The essential Drupal 'files' directory is included in this repository and can be found in the standard location: sites/default/files.

### Additional Configuration Steps

1. Run the following command to update dependencies, including downloading Drupal core and contributed modules as listed in composer.json:

```bash
ddev composer update
```


2. Start the DDEV environment:

Before starting the new instance, make sure to stop any running instances of Shoalcreek:

```bash
ddev stop --unlist shoalcreek
```

Then, start the DDEV environment:

```bash
ddev start
```


3. To clear the Drupal cache and launch the website, execute:

```bash
ddev drush cr; ddev launch
```

## Troubleshooting

If you encounter issues, check the DDEV logs:

```bash
ddev logs
```

## Additional Notes

This setup is specifically tailored for DDEV but can be adapted for other setups like Lando, XAMPP, or a bare-metal installation of LAMP. It can also be integrated into an existing Drupal setup.


