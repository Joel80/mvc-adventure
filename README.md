[![Build Status](https://travis-ci.com/Joel80/mvc-adventure.svg?branch=main)](https://travis-ci.com/Joel80/mvc-adventure) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Joel80/mvc-adventure/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Joel80/mvc-adventure/?branch=main) [![Code Coverage](https://scrutinizer-ci.com/g/Joel80/mvc-adventure/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Joel80/mvc-adventure/?branch=main) [![Build Status](https://scrutinizer-ci.com/g/Joel80/mvc-adventure/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Joel80/mvc-adventure/build-status/main) 

# Readme
## About
This is a text adventure game demo playable in your browser. You play as an old robot awakening in in an abandoned underground shelter. Your goal is to find you way out. You go from room to room, pick up items and try to uncover the clues that will let you escape. 

[!Exit image](public/img/room1.jpg)

## Requirements
To be able to install and run the game you need Composer and PHP 7.4. You will also need a (local) server running php to run the game.
PHP 7.4

## Installation 
Clone the repo and run: 
<code>Composer install</code>
If you also want to install the same testsuite I used to develop the app you can run:
<code>Make install</code>
Then to migrate and set up the database tables in the pre selected sqlite database run: 
<code>php bin/console doctrine:migrations:migrate</code>

To run the game start your local server and point your browser to your installation directory