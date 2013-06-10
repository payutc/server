#!/bin/bash


python --version
virtualenv venv
source venv/bin/activate
pip install lettuce

curl http://localhost:8080/POSS2WithExceptions/getCasUrl
