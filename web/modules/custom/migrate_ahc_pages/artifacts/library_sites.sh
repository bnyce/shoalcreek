#!/bin/bash

# Check if the ahc_pages.json file exists
if [ ! -f "ahc_pages.json" ]; then
  echo "ahc_pages.json does not exist. Exiting."
  exit 1
fi

# Substitute text using sed and save it to a new file
sed 's/\\\/library\\\//\\\/sites\\\/default\\\/files\\\//g' ahc_pages.json > ahc_pages_modified.json

echo "Text substitution complete. New file saved as ahc_pages_modified.json."

