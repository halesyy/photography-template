#!/bin/bash
#start from ./ - /dev
#watching ./assets/scss/all.scss to place in ./../assets/css/all.min.css

scss --watch ./assets/scss/all.scss:./../assets/css/all.min.css --style compressed
