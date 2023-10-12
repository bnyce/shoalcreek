# Austin Public Library

Drupal 9 powered website for the Austin Public Library. See it live at https://library.austintexas.gov/.

## Development

It's recommended you use [Docker](https://www.docker.com/) and [`ddev`](https://ddev.com/) to manage your local Drupal environment.

1. Install Docker Desktop: https://www.docker.com/products/docker-desktop/
2. Install `ddev`: https://ddev.com/get-started/
3. Start ddev and install Drupal 9
   ```sh
   ddev start
   ddev composer install
   ddev drush site:install --account-name=admin --account-pass=admin -y
   ```
4. Load the database backup
   ```sh
   ddev import-db --file=export/db.sql.gz
   ```
5. Run the latest database migrations
   ```sh
   ddev drush updatedb
   ```
   (You may get warnings about missing or invalid modules, just continue with `yes`)
6. Download all of the static files necessary with this command
   ```sh
   curl -s -L https://library.austintexas.gov/library/shoalcreek/files.tar.gz | tar xvz - -C web/sites/default
   ```
   and then move everything from `web/sites/default/files_test` into `web/sites/default/files`
7. Run `ddev drush uli` to get a URL for resetting the admin password

From there you can access the site!

### Troubleshooting

#### Problems with port 80 or 443

`ddev` tries to use ports 80 and 443 for HTTP/S traffic respectively. If you can't use these ports, try changing the following configs in `.ddev/config.yaml`:

```diff
-# router_http_port: <port>  # Port to be used for http (defaults to global configuration, usually 80)
-# router_https_port: <port> # Port for https (defaults to global configuration, usually 443)
+router_http_port: 4000 # Port to be used for http (defaults to global configuration, usually 80)
+router_https_port: 4443 # Port for https (defaults to global configuration, usually 443)
```

You can make the ports anything you want, just make sure you don't accidentally commit your changes to the repo.
