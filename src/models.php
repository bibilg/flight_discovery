<?php

class User extends Model 
{
    public static $_table = 'Users';

    public function tweets() {
        return $this->has_many('Tweet'); // Note we use the model name literally - not a pluralised version
    }
    /* It work as fallow : */
    /*
    // Select a particular user from the database
    $user = Model::factory('User')->find_one($user_id);

    // Find the posts associated with the user
    $posts = $user->posts()->find_many();
     */
}

class Tweet extends Model
{
    public static $_table = 'Tweets';

    public function user(){
        return $this->has_one('User');
    }
    /* It work as follow : */
    /*
        // Select a particular user from the database
        $user = Model::factory('User')->find_one($user_id);

        // Find the profile associated with the user
        $profile = $user->profile()->find_one();    

        By default, Paris assumes that the foreign key column on the 
        related table has the same name as the current (base) table, with _id appended.
        // To override this behaviour, add a second argument to your has_one call, passing the name of the column to use.
    */

    public static function liste_tweets() {
        return Tweet::raw_query('SELECT t.publication_date, t.body, u.username
            FROM tweets AS t, users as u WHERE t.user_id = u.id')
                      ->find_many();
      }

}

/*------- Documentation on https://paris.readthedocs.io/en ---------*/

/* Models */
//If the name of class is TweetUser, paris will look for a table named tweet_user.
//    \Models\CarTyre would be converted to models_car_tyre. This can be modified (see configuration Model::$short_table_names = true; )
// public static $_table = 'my_user_table'; is just for directly specify a table name
// public static $_id_column = 'my_id_column'; for redefine the primary key, 'id' by default

/* Association */
// There is one example of one-to-one
// There is one example for one-to-many
// See doc for many-to-many

/* Querying */
//It's almost the same system as idiorm : https://idiorm.readthedocs.io/en/latest/querying.html