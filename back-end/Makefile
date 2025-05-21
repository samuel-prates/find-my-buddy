SHELL = /bin/bash
ROOT_DIR := $(shell dirname $(shell pwd))
APP_NAME = find-my-buddy
APP_NAMESPACE = samuelprates
APP_VERSION = 0.1.0
APP_TAG = $(APP_VERSION)
APP_IMAGE = $(APP_NAME):$(APP_VERSION)

docker-build:
	docker build \
		--build-arg APP_NAME=$(APP_NAME) \
		--build-arg APP_VERSION=$(APP_VERSION) \
		--build-arg APP_IMAGE=$(APP_IMAGE) \
		-t $(APP_IMAGE) \
		-f docker/Dockerfile ./

docker-tag:
	docker tag $(APP_IMAGE) $(APP_NAMESPACE)/$(APP_IMAGE)

docker-push:
	docker push $(APP_NAMESPACE)/$(APP_IMAGE)