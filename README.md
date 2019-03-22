# RESTful.training

[http://restful.training](http://restful.training) was created to give you some experience with using RESTful APIs. It is an API for a basic blog that has articles, comments, and tags.

- [Authentication](#auth)
- End Points:
    - [Blog](#blog)
    - [Counter](#counter)
    - [PingPong](#pingpong)


## General

All requests should be sent using JSON and with the `Accept: application/json` header.

---

## Authentication

In order to use the service you'll need to create an account. You only need to do this once.

`POST http://restful.training/api/accounts`

### Request

- `key`: use the password you've been given
- `name`: pick a username

### Response

- `uri`: where you should make your API requests to
- `api_key`: your unique API key, write this down you'll need it for all other requests

### Usage

**Once you have created your account use the provided uri for all other requests**

For example, if your response was:

```json
{
    "uri": "test.restful.training/api/",
    "api_key": "15beab53cc8880738da99953d2f6ceffbe83418a"
}
```

All future requests should use the root uri `http://test.restful.training/api/` with the query string `?key=15beab53cc8880738da99953d2f6ceffbe83418a`

---

## Blog

### Articles

#### `GET /blog/articles`

Will return a list of all blog articles.

**Does not include the full article text.**

#### `POST /blog/articles`

Will create a new blog article

##### Request

- `title`: required, article title
- `article`: required, article content
- `tags`: an array of tags

#### `GET /blog/articles/<id>`

Will return an article with the given `id`

#### `PUT /blog/articles/<id>`

Will update an entire existing article

##### Request

- `title`: required, article title
- `article`: required, article content
- `tags`: an array of tags

#### `PATCH /blog/articles/<id>`

Will update parts of an existing article

##### Request

- `title`: article title
- `article`: article content
- `tags`: an array of tags

#### `DELETE /blog/articles/<id>`

Will delete an existing article

### Comments

#### `GET /blog/articles/<id>/comments`

Get the comments for an article

#### `POST /blog/articles/<id>/comments`

Add a comment to an article

##### Request

- `email`: required, email of comment
- `comment`: required, comment content

### Tags

#### `GET /blog/tags`

List all tags

#### `GET /blog/tags/<id>/articles`

List all articles for a specific tag

---

## Counter

Each user gets one counter

#### `GET /counters`

Will return your counter

#### `POST /counters`

Sets the `count` value

##### Request

- `count`: required, integer

#### `PUT /counters`

Sets the `step` value

##### Request

- `step`: required, integer

#### `DELETE /counters`

Resets the counter

---

## PingPong

### Standard Response

- `id`
- `complete`: boolean - is the game over
- `winning_score`: integer - score to stop on
- `change_serve`: integer - how often to alternate serve
- `player_1`: object - player 1 object
    - `name`: string - name
    - `score`: string - score
    - `serving`: bool - is this player serving?
    - `won`: bool - has this player won?
- `player_2`: object - player 2 object
    - `name`: string - name
    - `score`: string - score
    - `serving`: bool - is this player serving?
    - `won`: bool - has this player won?

### End Points

#### `GET /ping-pong/games`

All of the games that have been played, with the latest game first.

#### `GET /ping-pong/games/<id>`

The specified game

#### `POST /ping-pong/games`

Create a new game of ping-pong

##### Request

- `player_1`: string - player 1 name
- `player_2`: string - player 2 name
- `winning_score`: *optional* integer - score to stop on (default: 21)
- `change_serve`: *optional* integer - how often to alternate serve (default: 5)

#### `PATCH /ping-pong/games/<id>/score`

Add one point to a player's score

##### Request

- `player`: integer (`1`|`2`) - the player to add a point for

#### `DELETE /ping-pong/games/<id>`

Delete a game of ping-pong
