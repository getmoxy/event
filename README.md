Moxy\Event
=====
[![Build Status](https://travis-ci.org/getmoxy/event.png?branch=master)](https://travis-ci.org/getmoxy/event) 
[![Code Coverage](https://codeclimate.com/github/getmoxy/event/badges/coverage.svg)](https://codeclimate.com/github/getmoxy/event)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/getmoxy/event/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/getmoxy/event/?branch=master)


Mozy is a suite of loosely linked libraries for achieving "things" in PHP. Moxy\Event is Moxy's take on the classic mediater/event pattern. 

Moxy\Event is designed as a mediator event library; all event emitters inherit from a central class which mediates events and listeners. You can implement the \Moxy\Event\Listener interface, or simply pass in any PHP callable.

Installation
=====

    $ composer require moxy/event:dev-master


Yet Another Event Library
=====

Moxy as a collection is intended to be flexible; use only the bits you need, or merely a single library you really like. Moxy/Event is one part of the glue that binds the libraries together. For example, Moxy\Router issues a router.404 event in the case it is unable to do anything with a request; which allows you to create a 404 error handler.