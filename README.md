# Pinterest Bot for PHP

[![Build Status](https://travis-ci.org/seregazhuk/php-pinterest-bot.svg)](https://travis-ci.org/seregazhuk/php-pinterest-bot)
[![Code Climate](https://codeclimate.com/github/seregazhuk/php-pinterest-bot/badges/gpa.svg)](https://codeclimate.com/github/seregazhuk/php-pinterest-bot)
[![Test Coverage](https://codeclimate.com/github/seregazhuk/php-pinterest-bot/badges/coverage.svg)](https://codeclimate.com/github/seregazhuk/php-pinterest-bot/coverage)
This PHP class will help you to work with your Pinterest account. You don't
need to register application in Pintererst to get access token for api. Use
only your account login and password.

Some functions use pinterest navigation through results, for example,
get user followers. Function returns generator object with api results as batches in 
every iteration. By default functions return all pinterest result batches, but you can 
pass batches num as second argument. For example, 
```php 
$bot->searchPins('query', 2)
```
will return only 2 batches of search results.

## Dependencies

API requires CURL extension and PHP 5.5 or above.

## Installation
Via composer:
```
php composer.phar require "seregazhuk/pinterestapi:*"
```

## Quick Start

```php 
use seregazhuk\PinterestBot\PinterestBot;
use seregazhuk\PinterestBot\ApiRequest;

// pass useragent string to request object
$api = new ApiRequest("Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36");
$bot = new PinterestBot('mypinterestlogin', 'mypinterestpassword', $api);
$bot->login();
```

Next, get your list of boards:

```php
$boards = $bot->getBoards();
```

## Pins

Get pin info by its id.
```php
$info = $bot->getPinInfo(1234567890);
```

Create new pin. Accepts image url, board id, where to post image, description and preview url.

```php
$pinId = $bot->pin('http://exmaple.com/image.jpg', $boards[0]['id'], 'pin description');
```
    
Repin other pin by its id.
```php
$bot->repin($pinId, $boards[0]['id'], 'my repin');
``` 
Delete pin by id.
```php
$bot->deletePin($pinId);
```   
Like/dislike pin by id.
```php
$bot->likePin($pinId);
$bot->unLikePin($pinId);
```
Write a comment.
```php
$bot->commentPin($pinId, 'your comment');
```
Get all pins by username. Uses pinterest api pagination. Function returns pins batch every iteration.
```php
foreach($bot->getUserPins('username') as $pinsBatch)
{
	// ...
}
```    
## Pinners

Get your account name
```php
$bot->getAccountName(); 
```	
Follow/unfollow user by ID
```php
$bot->followUser($userId);
$bot->unFollowUser($userId);
```	
Get user info by username
```php
$userData = $bot->getUserInfo($username);
```	
Get user following. Uses pinterest api pagination.
```php
foreach($bot->getFollowing('username') as $followingBatch)
{
	// ...
}
```
Get user followers. Uses pinterest api pagination.
```php
foreach($bot->getFollowers('username') as $followersBatch)
{
	// ...
}
```
## Boards
Follow/unfollow board by ID
```php
$bot->followBoard($boardId);
$bot->unFollowBoard($boardId);
```

## Search

Search functions use pinterest pagination in fetching results and return generator.
```php
foreach($bot->searchPins('query') as $pinsBatch)
{
	// ...
}

foreach($bot->searchPinners('query') as $pinnersBatch)
{
	// ...
}

foreach($bot->searchBoards('query') as $boardsBatch);
{
	// ...
}
```
Questions?  Email me:  seregazhuk88@gmail.com