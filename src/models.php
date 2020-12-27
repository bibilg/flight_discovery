<?php

class User extends Model 
{
    public static $_table = 'Users';
}

class Tweet extends Model
{
    public static $_table = 'Tweets';

    public static function liste_tweets() {
        return Tweet::raw_query('SELECT t.publication_date, t.body, u.username
            FROM tweets AS t, users as u WHERE t.user_id = u.id')
                      ->find_many();
      }

}

/*------- Documentation on https://paris.readthedocs.io/en ---------*/

//If the name of class is TweetUser, paris will look for a table named tweet_user.
//    \Models\CarTyre would be converted to models_car_tyre. This can be modified (see configuration Model::$short_table_names = true; )
