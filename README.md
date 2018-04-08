Snowtricks
=======

Project 6 openclassrooms 
Snowboard community website with Symfony

Instructions:
=======
This website allows users to share and explain snowboard tricks and post comments about it.
Anonymous users can only look at the tricks and the comments .
Registered users can :
- Post tricks
- Edit tricks
- Delete tricks
- Post comments

Installation
======
- Donwload the master branch.
- run $ php composer install

Create database
======
- $ php bin/console doctrine:database:create
- $ php bin/console doctrine:schema:update --force

Load the sample data
=====
- $ php bin/console doctrine:fixtures:load

