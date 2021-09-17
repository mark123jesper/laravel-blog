<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        $body = $this->faker->text;
        $category_id = function(){
            return Category::all()->random()->id;
        };
        $user_id = function(){
            return User::all()->random()->id;
        };
        return [
            //
            'title' => $title,
            'slug' => $slug,
            'body' => $body,
            'category_id' => $category_id,
            'user_id' => $user_id,
        ];
    }
}
