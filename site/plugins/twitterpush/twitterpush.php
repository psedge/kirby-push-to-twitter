<?php

kirby()->hook('panel.page.create', 'push');

function push($page) {
    if (c::get('twitterpush.enabled') == true) {
        return false;
    }

    $keys = [
        'ck' => c::get('twitterpush.consumerKey'),
        'cs' => c::get('twitterpush.consumerSecret'),
        'at' => c::get('twitterpush.accessToken'),
        'ats' => c::get('twitterpush.accessTokenSecret')
    ];

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
            'status' => substr($page->text(), 0, 120) . ' ' . $page->url(),
        ], OAUTH_HTTP_METHOD_POST);
    } catch (OAuthException $e) {
        return response::error($e->getMessage());
    }

    return true;
}