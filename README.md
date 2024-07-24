# SECRET wp theme

## Required dependencies
- Install [node](https://nodejs.org/en) >= 18.16.1 or above if you need
- Install npm >= 9.5.1 or above if you need

## Theme installation
- Download wordpress files form [official site](https://wordpress.org/download/) or install it with [Local](https://localwp.com/)
- Move to ```./wp-content/themes``` folder
- Run in **themes** folder:
  - ```git clone git@gitlabhq.paymentop.dev:frontend/SECRET-wp-theme.git SECRET``` for ssh
  - ```git clone https://gitlabhq.paymentop.dev/frontend/SECRET-wp-theme.git SECRET``` for https
- Run ```npm i```
- Be sure you migrated database and plugins from prod using **wp-migrate** plugin

- **Enjoy** 

## Project styles and scripts structure
- After you have finished the installation, we work with the src folder
- Src folder has next subfolders:
  - ```core``` - folder for core styles and scripts for all pages
  - ```parts``` - folder for cross site sections styles and scripts (**entry points folder**)
  - ```shared``` - folder for necessary combine scripts for external modules
  - ```views``` - folder with pages scripts and styles (**entry points folder**)

**Attention!!!** *entry points* - is the pages' and sections' styles and scripts. This styles and scripts compile into ```public``` folder with same name folders with builded files in it. Entry points' folder **must have the same name as templates or template-parts php files name**.

**View folder structure**
- personal-main
  - stylesheets
    - index.scss
    - components
      - index.scss
      - ...components.scss files
  - personal-main.scss
  - personal-main-js (*if page has js scripts*)

**Views example**

Enter structure:
- src
  - views
    - personal-main
      - stylesheets
      - personal-main.scss
      - personal-main-js
      
Will be builded into:
- public
  - views
    - personal-main
      - personal-main.css
      - personal-main.js

**Parts example**

Enter structure:
- src
  - parts
    - callback-section
      - callback-section.scss
      - callback-section.js
      

Will be builded into:
- public
  - parts
    - callback-section
      - callback-section.css
      - callback-section-js

## Release Steps
### Environment Setup
Before starting the release process, ensure you have the necessary environment configuration files:

```sh
cp .env.stage.example .env.stage
```
```sh
cp .env.production.example .env.production
```
Set the following environment variables in your configuration files:

- `SERVER_URI="server_uri"` - Example: ubuntu@111.11.11.11
- `THEME_DIR="/path/to/theme"` - Path to the theme directory on the server
- `DEFAULT_BRANCH="default_branch_name"` - Default branch name for the environment
- `USER_NAME="user_name"` - Your username
- `PERSONAL_ACCESS_TOKEN="personal_access_token"` - Your personal access token

### Release Process
1. Checkout to a release branch
2. Run commands:
_Replace_ `[version]` _with_ `major`, `minor` _or_ `patch`.
```sh
npm run release -- [version]
```
3. Go to the repository, release Pull Request will created automattically
4. Ensure all **pipelines pass successfully**.
5. Deploy the release branch to production and test the production environment.
6. Once testing is complete, merge the release PR to the main branch.
7. Deploy the main branch to production.
8. Ensure all **pipelines pass successfully**.
9. Go to the repository and merge the backmerge PR into the development branch.
10. **Create a release** in the repository using the latest tag and describe all the changes

By following these steps, you can ensure a smooth and organized release process for your project.

### Staging Deployment
#### Deploy to Staging:
_Using npm script:_
```sh
npm run deploy:stage
```
```sh
npm run deploy:stage -- branch_name
```

### Production Deployment
#### Deploy to Production:
_Using npm script:_
```sh
npm run deploy:prod
```
```sh
npm run deploy:prod -- branch_name
```
