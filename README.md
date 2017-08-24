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

## Articles 

### `GET /articles`

Will return a list of all blog articles

### `POST /articles`

Will create a new blog article 

#### Request

- `title`: required, article title
- `article`: required, article content
- `tags`: an array of tags

### `GET /articles/:id`

Will return an article with the given `id`

### `PUT /articles/:id`

Will update an existing article

#### Request

- `title`: required, article title
- `article`: required, article content
- `tags`: an array of tags

### `DELETE /articles/:id`

Will delete an existing article

---

## Comments 

### `GET /articles/:id/comments`

Get the comments for an article

### `POST /articles/:id/comments`

Add a comment to an article

#### Request

- `email`: required, email of comment 
- `comment`: required, comment content

---

## Tags 

### `GET /tags`

List all tags

### `GET /tags/:id/articles`

List all articles for a specific tag
