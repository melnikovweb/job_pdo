#!/bin/bash

YELLOW='\033[0;33m'
GREEN='\033[0;32m'
LIGHT_BLUE='\033[1;34m'
LIGHT_CORAL='\033[1;31m'
NC='\033[0m'

if [ $# -eq 0 ]; then
  echo "${LIGHT_CORAL}No arguments provided. Please use '${YELLOW}major${LIGHT_CORAL}', '${YELLOW}minor${LIGHT_CORAL}', or '${YELLOW}patch${LIGHT_CORAL}'.${NC}"
  exit 0
fi

if [ "$1" != "major" ] && [ "$1" != "minor" ] && [ "$1" != "patch" ]; then
  echo "${LIGHT_CORAL}Invalid argument: $1. Please use '${YELLOW}major${LIGHT_CORAL}', '${YELLOW}minor${LIGHT_CORAL}', or '${YELLOW}patch${LIGHT_CORAL}'.${NC}"
  exit 1
fi

INCREMENT_PART=$1
DEFAULT_VERSION="1.0.0"
WP_FILE_VERSION_PATH="functions-parts/theme-version.php"

increment_version() {
  local version=$1
  local part=$2
  local clean_version="${version#v}"
  IFS='.' read -ra parts <<<"$clean_version"

  case $part in
  "major")
    ((parts[0]++))
    parts[1]=0
    parts[2]=0
    ;;
  "minor")
    ((parts[1]++))
    parts[2]=0
    ;;
  "patch")
    ((parts[2]++))
    ;;
  *)
    echo "Invalid version part: $part"
    exit 1
    ;;
  esac

  echo "v${parts[0]}.${parts[1]}.${parts[2]}"
}

print_step() {
  printf "\n${LIGHT_BLUE}%b${NC}" "$1"
}

print_success() {
  printf "${GREEN}%b${NC}\n" "$1"
}

update_wp_version() {
  local new_version=$1

  print_step "-> Incrementing the wp version..."

  if [ -f "$WP_FILE_VERSION_PATH" ]; then
    # Using '' with -i for macOS compatibility; remove if on Linux
    sed -i '' "s/define('_S_VERSION', '[^']*')/define('_S_VERSION', '$new_version')/" "$WP_FILE_VERSION_PATH"
    print_success "\n<- Updated ${YELLOW}_S_VERSION${GREEN} in ${YELLOW}${WP_FILE_VERSION_PATH}${GREEN} to ${YELLOW}${new_version}${GREEN}."
  else
    printf "\n${LIGHT_CORAL}<- Error: ${YELLOW}%b${LIGHT_CORAL} not found.${NC}" "$WP_FILE_VERSION_PATH"
    exit 1
  fi
}

print_progress_bar() {
  local progress=$1
  local bar_length=50
  local filled_length=$((progress * bar_length / 100))
  filled_length=$((filled_length > bar_length ? bar_length : filled_length))
  local empty_length=$((bar_length - filled_length))
  local progress_bar="${YELLOW}["
  progress_bar+="$(printf '#%.0s' $(seq 1 "$filled_length"))"
  progress_bar+="$(printf ' %.0s' $(seq 1 "$empty_length"))"
  progress_bar+="]${LIGHT_BLUE} $progress%${NC}"
  printf "\r%b" "$progress_bar"
}

simulate_processing() {
  local seconds=$1
  sleep "$seconds"
}

git_quiet() {
  git "$@" >/dev/null 2>&1
}

pull_latest_changes() {
  local branch=$1
  local max_time=30
  local progress=0

  print_step "-> Pulling the latest changes from the remote repository..."
  git_quiet pull origin "$branch" &

  local pid=$!
  local start_time=$(date +%s)

  while kill -0 $pid 2>/dev/null; do
    local current_time=$(date +%s)
    local elapsed_time=$((current_time - start_time))
    progress=$((elapsed_time * 100 / max_time))
    progress=$((progress > 100 ? 100 : progress))
    print_progress_bar $progress
    sleep 1
  done

  wait $pid
  print_progress_bar 100
  echo ""
  print_success "-> Pulling succeeded."
}

install_packages() {
  print_step "-> Installing the packages...\n"
  npm install >/dev/null 2>&1 &

  local max_time=30
  local progress=0
  local pid=$!
  local start_time=$(date +%s)

  while kill -0 $pid 2>/dev/null; do
    local current_time=$(date +%s)
    local elapsed_time=$((current_time - start_time))
    progress=$((elapsed_time * 100 / max_time))
    progress=$((progress > 100 ? 100 : progress))
    print_progress_bar $progress
    sleep 1
  done

  wait $pid
  print_progress_bar 100
  echo ""
  print_success "<- The latest packages are installed."
}

push_branch() {
  local branch_name=$1
  local release_tag=$2

  local PROD_BRANCH="main"
  local DEV_BRANCH="develop"

  print_step "-> Pushing the new branch to the remote repository...\n"

  git_quiet merge --no-ff "$PROD_BRANCH"

  git_quiet push origin "$branch_name" \
    -o merge_request.create \
    -o merge_request.label=release \
    -o merge_request.target="$PROD_BRANCH" \
    -o merge_request.title="RELEASE v$release_tag" \
    -o merge_request.description="New release version $release_tag" &

  local max_time=30
  local progress=0
  local pid=$!
  local start_time=$(date +%s)

  while kill -0 $pid 2>/dev/null; do
    local current_time=$(date +%s)
    local elapsed_time=$((current_time - start_time))
    progress=$((elapsed_time * 100 / max_time))
    progress=$((progress > 100 ? 100 : progress))
    print_progress_bar $progress
    sleep 1
  done

  wait $pid
  print_progress_bar 100
  echo ""
  print_success "<- Pushed at remote repository."
}

print_step "-> Retrieving the last release version from Git tags..."
git_quiet fetch --tags
LAST_TAG=$(git tag -l --sort=v:refname "v*" | tail -n 1 2>/dev/null || echo "$DEFAULT_VERSION")
print_success "\n<- Last release version: ${YELLOW}$LAST_TAG"

print_step "-> Incrementing the version number..."
NEW_TAG=$(increment_version "$LAST_TAG" "$INCREMENT_PART")
NEW_VERSION="${NEW_TAG#v}"
BRANCH_NAME="RELEASE-$NEW_VERSION"
print_success "\n<- New version: ${YELLOW}$NEW_VERSION"

update_wp_version "$NEW_VERSION"

# DEFAULT_BRANCH="develop"
# print_step "-> Switching to the default branch: ${YELLOW}$DEFAULT_BRANCH${GREEN}..."
# git_quiet checkout $DEFAULT_BRANCH
#
# pull_latest_changes $DEFAULT_BRANCH
# print_success "<- Current branch: ${YELLOW}$DEFAULT_BRANCH"

print_step "-> Creating and switching to the release branch: ${YELLOW}$BRANCH_NAME${LIGHT_BLUE}..."
git_quiet checkout -b "$BRANCH_NAME"
print_success "\n<- Branch created: ${YELLOW}$BRANCH_NAME"

install_packages

print_step "-> Production build is running..."
npm run build:prod
print_success "<- Production build has succeeded."

print_step "-> Check public folder changes..."
RELEASE_FILES_CHANGES="public $WP_FILE_VERSION_PATH"
release_status=$(git status --porcelain $RELEASE_FILES_CHANGES)

if [[ -n "$release_status" ]]; then
  print_success "\n<- The files $RELEASE_FILES_CHANGES has changes."
  print_success "${NC}<- Files changed:"
  echo "${YELLOW}$release_status${NC}"

  git_quiet add $RELEASE_FILES_CHANGES
  git_quiet commit -m "Release v$NEW_VERSION"
else
  print_success "\n${YELLOW}<- The folder $PUBLIC_FOLDER is clean, with no changes.${NC}"
fi

push_branch "$BRANCH_NAME" "$NEW_VERSION"

print_step "-> Creating a new tag: ${YELLOW}$NEW_TAG${LIGHT_BLUE}..."
git_quiet tag -a "$NEW_TAG" -m "Release v$NEW_VERSION"
git_quiet push origin "$NEW_TAG"
print_success "\n<- Tag created: ${YELLOW}$NEW_TAG"

print_success "\n\nRelease branch ${YELLOW}$BRANCH_NAME${GREEN} and tagged as ${YELLOW}$NEW_TAG${GREEN}."
