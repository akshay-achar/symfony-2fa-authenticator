# Two Factor Authenticator Implementation in Symfony

### Steps Followed 
  - composer create-project symfony/website-skeleton symfony-2fa-authenticator
  - cd symfony-2fa-authenticator
  - composer require symfony/security-bundle
  - php bin/console make:user
  - composer require scheb/two-factor-bundle
  - Update the Database Details in the .env file
  - Doctrine Schema Update
  - Create the User via front end or inserting directly into the DB
  - Update the code and config with the Simple Login 
  - Update the exist route of 2FA route/scheb_two_factor.yaml into the routes.yaml file
  - Configure the firewall in the security.yaml file
  - Update the authentication token we are using in the config/packages/scheb_two_factor.yaml file 
  - For the Model file of the entity, implement the TwoFactorInterface based on the 2-factor Authenticator ( Google, TOTP) and create a column to the store the secret key for the user.
  - Doctrine Schema Update
  - Create a twig for the 2-factor authenticator form
  - Update the configuration for Google Authenticator or TOTP in the config/packages/scheb_two_factor.yaml about enabling it, server name, issuer name, etc.
  - Composer require endroid/qr-code-bundle for the QR code display
  - Create a controller, and service to generate the secret key for the Authenticator of that user to store in the DB  and display the QR code 
  - From the Front end do a normal login and go the secret key generator routes defined in the above step and generate the secret key, scan the QR code displayed, and logout.
  - Next time when you log in for the same user it will ask for the 2-factor authenticator password, just the enter the password from the Authenticator. 
