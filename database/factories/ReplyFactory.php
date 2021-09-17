<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $body = $this->faker->text;
        $question_id = function(){
            return Question::all()->random()->id;
        };
        $user_id = function(){
            return User::all()->random()->id;
        };
        return [
            //
            'body' => $body,
            'question_id' => $question_id,
            'user_id' => $user_id,
        ];
    }
}
