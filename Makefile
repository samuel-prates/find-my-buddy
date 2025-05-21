SHELL = /bin/bash
ROOT_DIR := $(shell dirname $(shell pwd))
BACK_APP_NAME = find-my-buddy
BACK_APP_NAMESPACE = samuelprates
BACK_APP_VERSION = 0.1.0
BACK_APP_TAG = $(APP_VERSION)
BACK_APP_IMAGE = $(APP_NAME):$(APP_VERSION)