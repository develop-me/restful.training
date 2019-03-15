# RESTful.training

[http://restful.training](http://restful.training) was created to give you some experience with using RESTful APIs. It is an API for a basic blog that has articles, comments, and tags.

## General

All requests should be sent using JSON and with the `Accept: application/json` header.

---

## Auth

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

Will return a list of all blog articles

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
