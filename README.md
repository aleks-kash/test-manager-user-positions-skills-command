# positions-skills manager console commands

### Install
* Clone the repository:
```
git clone git@github.com:aleks-kash/test-manager-user-positions-skills-command.git
```
* Run composer
```
composer install
```
* Install is finish
* Now, new commands are available to you

### Available commands:

* help --------------------- Displays help for a command
* list ----------------------- Lists commands
* can
  - can:designer - - - Checking skill for position 'Designer'
  - can:developer - - Checking skill for position 'Developer'
  - can:manager - - - Checking skill for position 'Manager'
  - can:tester - - - - - Checking skill for position 'Tester'
* user
  - user:designer - - Designer position
  - user:developer - Developer position
  - user:manager - - Manager position
  - user:tester - - - - Tester position


### Command Example:
* php bin/console can:developer writeCode
  * true
* php bin/console can:developer draw
  * false
* php bin/console can:designer draw
  * true
* php bin/console can:manager communicationWithManager
  * false
* php bin/console can:tester communicationWithManager
  * true

###### v2.0