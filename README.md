# Plesk-Error_Logging
Use PHP to log web server errors on plesk instances to a sqlite database

To update Plesk so that default error pages use PHP to report or log the errors, you can follow these steps:

Log in to your Plesk control panel as the administrator.
Go to the "Server" tab and select "Tools & Settings".
Click on the "PHP Settings" option under the "Security" section.
In the "PHP Settings" page, find the "error_reporting" option and set it to the desired level of error reporting (e.g., E_ALL).
Next, go to the "Apache & nginx Settings" option under the "Web Server Settings" section.
Scroll down to the "Additional directives" field and add the following directives:
vbnet
Copy code
Alias /error/ "/var/www/vhosts/default/htdocs/error/"
ErrorDocument 400 /error/error.php
ErrorDocument 401 /error/error.php
ErrorDocument 403 /error/error.php
ErrorDocument 404 /error/error.php
ErrorDocument 500 /error/error.php
Save the changes and restart the Apache and nginx services.
These directives will create an alias for the default error pages directory and set the error pages to use the "error.php" file located in the directory specified in the alias. This file can be customized to log errors or display error messages using PHP.
