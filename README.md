# Installation and first start

Get project from https://github.com/fica990/posters.git

`git clone https://github.com/fica990/posters.git`

Create **.env** based on **.env.example**, and edit database section:

```
DB_HOST=poster_mysql
DB_DATABASE=api_posters
DB_USERNAME=docker
DB_PASSWORD=docker
```

Start docker for the first time by running this script located in project root

`sh setup.sh`

the script will also:
* install composer
* generate app key
* create a database (named **api_posters**)
* run migrations
* create symlink for images
---
### Routes

#### Images

* GET /images
* POST /images (saves a row in DB)
    * **path** - `/images/planes/`
    * **name** - `plane.jpg`    
* POST /filesystem/{bucket}/{file_path} - (for example: `/filesystem/images/planes/plane.jpg` this route uploads a file, saves it in **storage/app/public**)
* DEL /images/{id}
---
#### Albums

* GET /albums
* GET /albums/{id}
* POST /albums
    * **name** - `Album Title`
* PUT /albums/{id}
    * **name** - `New Album Title` 
* DEL /albums/{id}
---
#### Posters

* POST /images/{id}/poster
    * **bg_color** - `00FF00` (HEX format)
    * **title** - `title` (no need for a capslock)
    * **text** - `some text here`
    * **album_id** - `1`
* PUT /posters/{id}
    * **bg_color** - `00FF00` (HEX format)
    * **title** - `title` (no need for a capslock)
    * **text** - `some text here`
    * **album_id** - `1`
* DEL /posters/{id}

when you create or edit posters, you will get an url to the poster in response

for example: you can open an image
/storage/images/planes/poster_5f9b59a5049e4_plane.jpg