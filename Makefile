build:
	docker-compose -f ./docker/docker-compose.yml build

up:
	docker-compose -f ./docker/docker-compose.yml up

down:
	docker-compose -f ./docker/docker-compose.yml down

exec:
	docker exec -it jr-php-fpm bash
