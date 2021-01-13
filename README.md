# laravel_api

1) Clone this repository into your personal directory and in terminal run command:
$ cd personal_directory/git clone https://github.com/dibeshsharma/laravel_api.git 
and enter into the clone directory with command:
$ cd personal_directory/laravel_api

2) Sign up to pusher : https://dashboard.pusher.com/accounts/sign_up. 
After successful sign up, under the APP keys you will see your app_id, key, secret and cluster.

Update your .env file located at laravel_api/src 
PUSHER_APP_ID={PUSHER_APP_ID}
PUSHER_APP_KEY={PUSHER_APP_KEY}
PUSHER_APP_SECRET={PUSHER_APP_SECRET}
PUSHER_APP_CLUSTER={PUSHER_APP_CLUSTER}

3) run the docker service ( note: you need to enable virtualization to run the docker service on your desktop)
4) In terminal run command :
$ docker-compose build && docker-compose up -d
5) After successful built, open the browser and run http://localhost:8088/ and you should see the home page with Laravel API Endpoints and you are good to go.
