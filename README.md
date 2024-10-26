## About Laravel

composer install

## install java sdk 20
## download keycloak

https://www.keycloak.org/getting-started/getting-started-zip
put in c:/program files/{KEYCLOAK}

## run following commands

Short Path Name: Sometimes long file paths with spaces can cause issues. You can try using the short path name for the Keycloak installation directory. To find the short path name, open a command prompt and navigate to the directory containing kc.bat, then run:

sh

dir /x
Look for the short name in the output (it will be listed next to the long name).

Then use the short path to run the command:

C:\PROGRA~1\keycloak-22.0.1\bin\kc.bat start-dev
Here, PROGRA~1 is a common abbreviation for "Program Files."

Environment Variables: Instead of using the full path, you can set up an environment variable for the Keycloak installation path. This can simplify the command and make it less prone to errors. Here's how you can do it:

Open a command prompt as an administrator.

Run the following command to set the environment variable (replace C:\Program Files\keycloak-22.0.1 with your actual installation path):

setx KEYCLOAK_HOME "C:\Program Files\keycloak-22.0.1"
Close and reopen the command prompt to ensure the new environment variable takes effect.

Now you should be able to run the command using the environment variable:

%KEYCLOAK_HOME%\bin\kc.bat start-dev
Command Prompt Alternative: If using the Command Prompt continues to be problematic, you can consider using alternative command-line interfaces like Git Bash or PowerShell. These alternative shells might handle file paths and quoting differently.

Consult the Community: If you've tried all of the above and are still having issues, it might be beneficial to reach out to the Keycloak community or forums for more specific help. They might be able to provide insights or solutions based on your specific environment.

Consider a Script: As a last resort, you can create a simple batch script (e.g., start-keycloak.bat) in the same directory as kc.bat with the following content:

@echo off
cd "C:\Program Files\keycloak-22.0.1\bin"
kc.bat start-dev
Then you can run the script from the command prompt:

start-keycloak.bat

php artisan migrate
php artisan serve
