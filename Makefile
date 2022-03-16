SERVICE_NAME=aggregate.testing
PHP_CONTAINER_NAME=aggregate.testing

compose:
	docker-compose -f ./docker-compose.yml --project-name=${SERVICE_NAME} ${action}

execute:
	docker exec -it ${PHP_CONTAINER_NAME} ${action}

build:
	$(MAKE) compose action=build

up:
	$(MAKE) compose action=up

upd:
	$(MAKE) compose action="up --build -d"

shell:
	$(MAKE) execute action="bash"

stop:
	$(MAKE) compose action="stop"

rm:
	$(MAKE) compose action="rm"

test:
	docker exec -it ${PHP_CONTAINER_NAME} composer -- test
