<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'DIEGO',
                'last_name' => NULL,
                'email' => 'diego@diego.com',
                'password' => '$2y$10$KM3JdffEFGOU7nSB9j8GYOcTEnGL3p1rkIzQb40Y9YQRdBFoLGwR2',
                'active' => 1,
                'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjdiN2M2ZmI5ZmE0MTExZjI3YmY1ZDc2MDE0ZmJkMjBiYzMzNTU0MjM0NGFhODY1YWU1YmE4MGI0MzQ1ODRhOWEzMzZhZmVlNTcxYmVjMmRjIn0.eyJhdWQiOiIxIiwianRpIjoiN2I3YzZmYjlmYTQxMTFmMjdiZjVkNzYwMTRmYmQyMGJjMzM1NTQyMzQ0YWE4NjVhZTViYTgwYjQzNDU4NGE5YTMzNmFmZWU1NzFiZWMyZGMiLCJpYXQiOjE2MTczODYwMTYsIm5iZiI6MTYxNzM4NjAxNiwiZXhwIjoxNjQ4OTIyMDE2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.FLdTvaUttnXTu3HkXVanqmW741uAa0GEOXh7rcqalCx8a-LFWFzQlE3Bexo8c7M34ms63itChN8-kTH8AN_C04NtqpJt9buI5YFIRoxTlNpCsBWWiSZxAYCrGnA9qoODxlhPqfYnsMleI43KYLGA9TeJo9xidcGFJjtQbHN7b6tETbvTbfYWZ5ZKJL644vLDr1_nrJN_NAsoGtM2N5eKv-gjacuJGQUxWtWfL5hwaskVYXLzArwthTK5yZZfQDjV2yksbsDbcYFfy7Pr7fbCoageU5HxWaJQeTEeTZe3wvinuYpN6gYJVjRM6Il8njhQi6LRyZswYGgZPbAmjWKZ6d8Xk03kCfUwx-f85tuIZotL8P7wvkkoBuAWSGjWCADb9GcUUT3MrayAdzBFO7qgPYotyrmGFhENmdzBvNaRtE7JusuX1jQkTEtDxm7V4gb-4rqdLhbEl1I5_odjYA7kbsa6iuq7YnnW4J1jiuUGYwKxtWjgFTuqNGYeSytc4PhJYwl0gx2dZxITNAb_-ZM3QgwBi0i7bxh2t_RHtWmCiT8Z0ND4uF_qTyfaG4nrY98IdOI4Q2baoWf9M358HN8uQV_G9F4egZzQWQhM4wojbU9AxYu0i9T-UEh8WUbYQj1Rau4vx4IonW0Fu4cS4knXSzY7T_WjP06DGtAy-Qduj4o',
                'refresh_token' => NULL,
                'activation_token' => NULL,
                'token_type' => 'bearer',
                'meli_token' => '',
                'meli_refresh_token' => '',
                'meli_token_expiration_time' => '',
                'meli_scope' => NULL,
                'meli_token_type' => 'bearer',
                'meli_user_id' => NULL,
                'type_user_id' => 1,
                'company_id' => 1,
                'remember_token' => 'r35k8rNtEgEGtVNRnFbKT0jP90RNaQv96LBjvgd3IZKlB3B9snuCbOUaztOA',
                'created_at' => '2021-03-11 14:12:38',
                'updated_at' => '2021-04-02 17:53:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}