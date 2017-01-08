## Modifications for testing environment
  In order for testing to work properly, the dbowner (reprophet) must own the db public schema
  ```
    ALTER SCHEMA public OWNER TO reprophet;
  ```
  This needs to be run because by default pgsql doesn't change the default schema owner from the postgres super user
  
  Additionally, you must set your environment variables for the testing environment:
  ```
    export TEST_DB_HOST=10.0.1.4
    export TEST_DB_USER=reprophet
    export TEST_DB_NAME=reprophet-blog-testing
    export TEST_DB_PASS='redacted'
  ```

  Finally, copy over your .env to .env.testing and modify settings accordingly, and run the app server for testing with
  ```
    php artisan serve --port=8001 --env=testing
  ```
