<?php

/**
 * Push a shortened version of the post to Twitter, with OAuth.
 */
kirby()->hook('panel.page.create', function($page) {
    if (c::get('twitterpush.enabled') == false) {
        return false;
    }

    $keys = [
        'ck' => c::get('twitterpush.consumerKey'),
        'cs' => c::get('twitterpush.consumerSecret'),
        'at' => c::get('twitterpush.accessToken'),
        'ats' => c::get('twitterpush.accessTokenSecret')
    ];

    foreach ($keys as $key) {
        if ($key == null || $key == "") {
            return response::error("Keys not correctly set.");
        }
    }

    $oAuth = new OAuth(
        $keys['ck'],
        $keys['cs'],
        OAUTH_SIG_METHOD_HMACSHA1,
        OAUTH_AUTH_TYPE_URI
    );

    $oAuth->setToken($keys['at'], $keys['ats']);

    $baseUrl = 'https://api.twitter.com/1.1/statuses/update.json?include_entities=true';

    try {
        $oAuth->fetch($baseUrl, [
            'status' => getTweetContent($page),
        ], OAUTH_HTTP_METHOD_POST);
    } catch (OAuthException $e) {
        return response::error($e->getMessage());
    }

    return true;
});

/**
 * Generate the content of the Tweet.
 * Can be customised, but beware of 140 char limit.
 *
 * @param $page
 * @return string
 */
function getTweetContent($page)
{
    return substr($page->text(), 0, 120) . ' ' . $page->url();
}