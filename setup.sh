#!/usr/bin/env bash
# A well-documented script to set up the Shoalcreek APL website locally using DDEV

# The following steps are included for completeness but are assumed to have already been done
# as they are required to even obtain this script.

# echo "Cloning the Shoalcreek repository..."
# git clone https://github.com/bnyce/shoalcreek.git shoalcreek23

# echo "Navigating to project directory..."
# cd shoalcreek23 || { echo "Failed to navigate to project directory"; exit 1; }

# Stop any running instances of Shoalcreek in DDEV
ddev stop --unlist shoalcreek

# Start DDEV before importing the database
ddev start

echo "Importing the database..."
ddev import-db --file=export/db.sql.gz

echo "Updating PHP dependencies..."
ddev composer update

echo "Starting the DDEV environment..."
ddev start

echo "Clearing Drupal cache and launching project..."
ddev drush cr; ddev launch

echo "Shoalcreek APL website is now running locally!"
