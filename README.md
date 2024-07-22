A basic service in Symfony that takes in a user id and attempts to send a notification via various channels (SMS, push, email).

Note: this project is to exhibit the use of DDD and abstracting away business logic in order to make a scalable microservice and is not fully-functioning.

**Key aspects:**
- Configuration is driven by config.yaml, which outlines the priority order of notification providers, depending on channel.
- Currently the implementation is driven by SendNotificationCommand.php, which handles sending the notification to a given user, depending on the channel provided and the configuration of priority order.
- The business can seamlessly add a new provider by creating a new class in the Infrastructure folder and adding a service to the services.yaml file for dependency injection, meaning the system is scalable and testable with little change to the rest of the codebase.

**Still to do:**
- - There are 'TODOs' littered throughout the code.
  - It was decided that the important element of this project was to explore DDD and showcase the benefit of abstracting out the business logic, and so code for integating with third party providers have been commented out. In its place, the code returns a random 'true' or 'false' for a notification being sent, so that the code is still testable.
  - In order to improve this project, it would be good to include a relationsional database, which would hold users and notifications. This would mean the code could find a user based on a given id and save notifications sent, as well as recording the status and time of the notification. This would allow for handling unsent notifications.
  - In addition to the above, having a table would enable the system to wait if all channels fail and resend at another time, using the timestamp on the failed notifications.
 
**Enter docker container:**

`docker compose build`

`docker compose up`

open new terminal 

`docker exec -it tutorial_symfony bash`

**Run tests:**

`composer require phpunit/phpunit`

`vendor/bin/phpunit project/tests/NotificationPublisher/Service/NotificationManagerTest.php`

**Sample commands to run:**

`php bin/console app:send-notification 1 test email sms`

`php bin/console app:send-notification 1 test2 sms push`

`php bin/console app:send-notification 1 test3 push email`
