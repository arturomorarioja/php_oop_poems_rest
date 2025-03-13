# Poems REST API

RESTful version of the [Poems API](https://github.com/arturomorarioja/php_oop_poems).
- `.htaccess` redirects the REST endpoints to the former GET parameter based endpoints
- The API now returns proper HTTP status codes
- The corresponding Postman collection and environment are included in the repo

### Main usage

http://_<server_name>_/api/_<end_point>_

### Endpoints

| Method | Usage | Description |
| ------ |:----- |:----------- |
| GET    |/authors | Returns the list of authors |
| GET    |/authors/_<author_name>_ | Returns biographical information about an author |
| GET    |/authors/_<author_name>_/poems | Returns the list of poems by an author |
| GET    |/authors/_<author_name>_/poems/_<poem_title>_ | Returns the text of a poem |

### Examples

GET http://localhost/api/authors
```json
[
    "Benjamin Zephaniah",
    "Christina Rossetti",
    "Edgar Allan Poe",
    "Emily Dickinson",
    "Langston Hughes",
    "Walt Whitman"
]
```
GET http://localhost/api/authors/Emily%20Dickinson
```json
{
    "birthDate": "10/12/1830",
    "birthPlace": "Amherst, MA (USA)",
    "deathDate": "15/05/1886",
    "deathPlace": "Amherst, MA (USA)"
}
```
GET http://localhost/api/authors/Emily%20Dickinson/poems
```json
[
    "Because I could not stop for Death",
    "I felt a Funeral, in my Brain",
    "I heard a Fly buzz - when I died -"
]
```
GET http://localhost/api/authors/Emily%20Dickinson/poems/Because%20I%20could%20not%20stop%20for%20Death
```json
{
    "text": "Because I could not stop for Death –<br>He kindly stopped for me –<br>The Carriage held but just Ourselves –<br>And Immortality.<br><br>We slowly drove – He knew no haste<br>And I had put away<br>My labor and my leisure too,<br>For His Civility –<br><br>We passed the School, where Children strove<br>At Recess – in the Ring –<br>We passed the Fields of Gazing Grain –<br>We passed the Setting Sun –<br><br>Or rather – He passed Us –<br>The Dews drew quivering and Chill –<br>For only Gossamer, my Gown –<br>My Tippet – only Tulle –<br><br>We paused before a House that seemed<br>A Swelling of the Ground –<br>The Roof was scarcely visible –<br>The Cornice – in the Ground –<br><br>Since then – 'tis Centuries – and yet<br>Feels shorter than the Day<br>I first surmised the Horses' Heads<br>Were toward Eternity –"
}
```

### Tools
PHP8

### Author
Arturo Mora-Rioja