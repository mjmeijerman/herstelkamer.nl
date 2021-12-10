SHELL=/bin/bash

.DEFAULT_GOAL := help

PHP_RUN := docker compose run -T --rm php-cli
ARGS ?= $(shell read -p "Additional arguments ([enter] for none): " args; echo $$args)

## setup: 	Setup the project for the first time
.PHONY: setup
setup: config up
	dev/composer install

## build: 	Build the docker containers
.PHONY: build
build:
	docker compose build --pull

## config: 	Copy the config.dist files (if needed)
.PHONY: config
config:
  # copy -n does not overwrite the target if it exists, but exits with an error, so || true ignores the error
	cp -n app/config/parameters.yml.dist app/config/parameters.yml || true

## up: 		Runs local environment
.PHONY: up
up:
	docker compose up -d

## destroy: 	Destroys the project
.PHONY: destroy
destroy:
	docker compose down --remove-orphans -v

.PHONY: php
php:
	@${PHP_RUN} $(ARGS)

## console:	Runs bin/console through docker
.PHONY: console
console:
	@${PHP_RUN} php bin/console $(ARGS) --ansi

## composer:      Runs composer through docker
.PHONY: composer
composer:
	@${PHP_RUN} composer $(ARGS) --ansi

## deploy:	Deploy the code to remote environments
.PHONY: deploy
deploy:
	./deploy

## release:	Checkout trunk, get most recent version, create new (minor) tag, push trunk and tags
.PHONY: release
release:
	git checkout trunk
	git pull
	dev/bump-tag.sh
	git push origin trunk && git push --tags
	./deploy

## branch:	Checkout trunk, get most recent version, create new branch based on trunk
.PHONY: branch
branch:
	git checkout trunk
	git pull
	@read -p "Enter Branch Name: " branchName; \
    git checkout -b $$branchName

## help:		Print this message
.PHONY: help
help: Makefile
	@sed -n 's/^##//p' $<
