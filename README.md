## Vanilla - Vagrant Box

### Prerequisites:

+ Vagrant installed in your environment ([More Info](https://www.vagrantup.com/downloads.html))

### Usage

+ Clone this repository into your computer: `git clone https://github.com/vanilla/vanilla-vagrant.git`
+ From the command line, go into that folder and run `vagrant up`.
  The first time, the VM will be fully provisioned.
  Once the VM is fully provisioned, run `vagrant reload` to do a clean reboot.
+ Install the certificate `/ansible/files/nginx/vanilla-box.crt` as a Trusted host in your Operating System.
+ Point for browser at `https://192.168.99.10`.
  Optionally, you can edit your hosts file and add an entry for `vanilla.local` or any subdomain (ex: `www.vanilla.local`) and access via that domain.
  The `vanilla-box` is running a a self-signed certificate for `vanilla.local`, `*.vanilla.local` and `192.168.99.10`.
+ You should have been redirected to `https://192.168.99.10/dev/dashboard/setup`. Use the following values:
  + Database Host: `localhost`
  + Database Name: `vanilla_dev`
  + Database User: `vanilla_dev`
  + Database Password: `password`
  + I don't need an .htaccess file
  + Complete the rest of the fields with your own preference and continue.
  + Congratulations!!! Vanilla Forums should be ready for use and development.

### Developing using the Vanilla-Box

Ideally, you will need a PHP IDE with support for:
+ PHP 7.x
+ xDebug
+ SSH Remote Project

#### Using PHPSTORM

+ Create a New Project of type `PHP Empty Project`
+ Go to `Tools -> Deployment -> Configuration`
+ Add a new configuration of type SFTP:
  + Server Name: `vanilla-box`

  **Connection**
  + Host: `192.168.99.10`
  + User name: `vagrant`
  + Authentication: `Key pair`
  + Private key path: `{REPO_FOLDER}/.vagrant/machines/vanilla_box/virtualbox/private_key`
  + Root path: `/var/www/vanilla`
  + Web server URL: `https://192.168.99.10`
  + Press the `OK` button to close the configuration window.

  **Mappings**
  + Local path: will point to your project folder
  + Deployment path: `/`
  + Web path: `/`

+ Go to `Tools -> Deployment -> Configuration -> Options`
  + Check Stop operation on the first error
  + Uncheck Overwrite up-to-date files
  + Check Preserve files timestamps
  + Check Delete target items when source ones fo not exist
  + Check Create empty directories
  + Check Propmt when overwriting or deleting local items
  + Upload changed files automatically to the default server: On explicit save action
  + Uncheck Skip external changes
  + Preserve original file permissions: yes
  + Warn when uploading over newer file: Compare content
  + Check Notify of remote changes
  + Check Show warning dialog on moving on Remote Host

+ Go to `Tools -> Deployment -> Download from vanilla-box` and wait. The first synchronization would take a while (around 15/20 minutes)

### Notes
+ The VM is provisioned for a local development environment. Security is very loose.
+ Using the default user `vagrant`, you can ssh into the VM (`vagrant ssh`) and take root privileges using `sudo su -`
+ A convenient `phpinfo` is located at `https://192.168.99.10/phpinfo.php`
+ Opcache, APCu and Memcached are disabled by default to avoid uncertainty. Therefore, there is a strong performance penalty.
+ A Percona Database is exposed on the standard MySQL port (TCP:3306). We can use any MySQL compatible tool to work with the Database. Default password for `root` is `password`
+ Please note, by default you will be using the slug `/dev` in your URL. You can change the slug to create several different instances of Vanilla running into the VM with the same source code. Although, you will need to create a Database for the site before the installation.
