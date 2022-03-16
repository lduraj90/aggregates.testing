# Article

This is an example code used in the article.

Link to the article: [Testowanie agregatów, czyli architektura wspierająca testowanie](http://devkick.pl)

## Run the code
### With docker and docker-compose

* run `make build` to build the dockerfile
* run `make up` to start containers, then:
    * run `make shell` to go to the container
    * run `make test` to run unit tests
