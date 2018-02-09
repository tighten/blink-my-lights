# Blink My Lights

Simple, 15-minute app for blinking smart lights from a web interface. Built on a whim for Laracon Online 2018.

## Installation
Normal Laravel installation; remember to get your IFTTT key and put it in `.env`.

## Sample
http://blink.mattstauffer.com

![](blink.gif?raw=true)

## IFTTT Settings
![](ifttt-settings.png?raw=true)

## Twitter Settings

1. While logged in, create an app at https://apps.twitter.com/app/new
2. In the "Keys and Access Tokens" tab, click "Create my access token".
3. Copy the corresponding keys into your `.env`

    ```
    TWITTER_OAUTH_TOKEN=      # Access Token
    TWITTER_OAUTH_SECRET=     # Access Token Secret
    TWITTER_CONSUMER_KEY=     # Consumer Key (API Key)
    TWITTER_CONSUMER_SECRET=  # Consumer Secret (API Secret)
    ```