#!/bin/bash

ENVIRONMENT=$1
BRANCH_NAME=$2

if [[ -z "$ENVIRONMENT" ]]; then
	echo "Error: No environment specified. Usage: ./deploy.sh [stage|production]"
	exit 1
fi

if [[ "$ENVIRONMENT" == "stage" ]]; then
	ENV_FILE=".env.stage"
elif [[ "$ENVIRONMENT" == "production" ]]; then
	ENV_FILE=".env.production"
else
	echo "Error: Invalid environment specified. Use 'stage' or 'production'."
	exit 1
fi

if [ ! -f $ENV_FILE ]; then
	echo "Error: $ENV_FILE does not exist."
	exit 1
fi

source $ENV_FILE

if [[ -z "$USER_NAME" || -z "$PERSONAL_ACCESS_TOKEN" ]]; then
	echo "Error: USER_NAME and PERSONAL_ACCESS_TOKEN must be set in $ENV_FILE"
	exit 1
fi

ssh $SERVER_URI <<ENDSSH
sudo su

cd $THEME_DIR

git config credential.helper 'store --file .git-credentials'
echo "https://$USER_NAME:$PERSONAL_ACCESS_TOKEN@gitlabhq.paymentop.dev" > .git-credentials

git fetch


if [[ -n "$BRANCH_NAME" ]]; then
  BRANCH_NAME=$DEFAULT_BRANCH
fi

CURRENT_BRANCH=\$(git rev-parse --abbrev-ref HEAD)

if [[ "\$CURRENT_BRANCH" != "$BRANCH_NAME" ]]; then
  if git show-ref --verify --quiet refs/heads/$BRANCH_NAME; then
    git checkout $BRANCH_NAME
  else
    # If it doesn't exist locally, track it from origin
    git checkout -t origin/$BRANCH_NAME
  fi
fi

git pull origin $BRANCH_NAME

rm -f .git-credentials
git config --unset credential.helper

ENDSSH
