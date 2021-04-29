<img width="500" alt="Houseify.io" src="https://i.postimg.cc/2jcqDgMd/houseify-13.png">

## Aplicación Oficial de Houseify.io

#### Sections
* [x] Properties
* [x] Businesses Directory
* [x] Job Profiles
* [] Forum
* [] Ads
* [] Job Posts
* [] Quotes

more...

### Installation

##### Clone repo
`git clone git@github.com:albertorsesc/app.houseify.io.git`

##### Install Dependencies
`composer install && npm install`

##### Create Environment file
`cp ./.env.example .env`

##### Setup DB variables

##### Seed database
`php artisan migrate --seed`

##### Start app
* `npm run watch`
* `php artisan serve`

##### Visit app URL
`localhost:3000`
