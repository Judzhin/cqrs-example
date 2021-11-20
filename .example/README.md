CQRS + ES Blog Engine
=====================

A blog engine written in PHP and powered with CQRS + Event Sourcing

## Requirements

All you need to run this application is Vagrant.

**http://www.vagrantup.com/**

## Installation

```bash
git clone https://github.com/theUniC/blog-cqrs.git
cd blog-cqrs
wget http://getcomposer.org/composer.phar
php composer.phar install
```

Next you have to update your hosts file (usually located at */etc/hosts*), with the line below

    172.21.99.6 mydddblog.test www.mydddblog.test redis.mydddblog.test
    
## Running the application

From the root application folder, run

    vagrant up --provision
    
When vagrant finishes bootstraping the VM, open up a browser and go to

**http://www.mydddblog.test**

Have fun!
