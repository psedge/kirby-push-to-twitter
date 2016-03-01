# Kirby Twitter Push

A plugin for [Kirby](http://getkirby.com) which autopublished a shortened version of new posts in
configured categories to Twitter. Access keys must be set in your configuration, as below.

Tweets pushed will have the first 120 characters of the article text, followed by a shortened URL.

# Installation

1. Download ZIP or checkout master branch.
2. Copy files into root of Kirby directory.
3. Navigate in code editor to site/config/config.php
4. Add the following lines:

```
c::set('twitterpush.consumerKey', *Consumer Key*);
c::set('twitterpush.consumerSecret', *Consumer Secret*);
c::set('twitterpush.accessToken', *Access Token*);
c::set('twitterpush.accessTokenSecret', *Access Token Secret*);
```

5. Replace the keys / tokens marked with ** with the values found in your Twitter developer account,
creating the app and generating these if not done already. Tools can be found 
in the [Twitter Developer Panel](https://apps.twitter.com/)


# Technical Notes

This plugin uses PHP's OAuth library, so this extension must be installed and functional on your server.
Checks for this plugin are done, and if not found you will receive an error when saving pages.
You can enable debug mode by adding the following to your site's config:


c::set('twitterpush.enabled', false);


This setting will disable any use of the library, and prevent the plugin being called.
 
 ---