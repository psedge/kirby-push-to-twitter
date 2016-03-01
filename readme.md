# Kirby Twitter Push

A plugin for [Kirby](http://getkirby.com) which autopublished a shortened version of new posts in
configured categories to Twitter. Access keys must be set in your configuration, as below.

Tweets pushed will have the first 120 characters of the article text, followed by a shortened URL.

# Installation

Download ZIP or checkout master branch.
Copy files into root of Kirby directory.
Navigate in code editor to site/config/config.php
Add the following lines:

c::set('twitterpush.consumerKey', *Access Token Secret*);
c::set('twitterpush.consumerSecret', *Access Token Secret*);
c::set('twitterpush.accessToken', *Access Token Secret*);
c::set('twitterpush.accessTokenSecret', *Access Token Secret*);


# Technical Notes

This plugin uses PHP's OAuth library, so this extension must be installed and functional on your server.
Checks for this plugin are done, and if not found you will receive an error when saving pages.
You can enable debug mode by adding the following to your site's config:


c::set('twitterpush.enabled', false);


This setting will disable any use of the library, and prevent the plugin being called. 