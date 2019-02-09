#!/bin/bash
pip install awscli
pip install aws-sam-cli
composer install --no-dev --optimize-autoloader
sam validate
sam package --output-template-file .stack.yaml --s3-bucket php-grandmaster
sam deploy --template-file .stack.yaml --capabilities CAPABILITY_IAM --stack-name php-grandmaster
