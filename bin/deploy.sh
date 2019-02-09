#!/bin/bash
pip install --user awscli
pip install --user aws-sam-cli
composer install --no-dev --optimize-autoloader
sam validate
sam package --output-template-file .stack.yaml --s3-bucket php-grandmaster
sam deploy --template-file .stack.yaml --capabilities CAPABILITY_IAM --stack-name php-grandmaster
