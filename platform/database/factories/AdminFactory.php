<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use stdClass;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * 'create' => true,
         * 'view' => true,
         * 'update' => true,
         * 'delete' => true,
         * 'viewAny' => true,
         * 'restore' => true,
         * 'forceDelete' => true,
         */

        $obj = new stdClass;

        $obj->create = true;
        $obj->view = true;
        $obj->update = true;
        $obj->delete = true;
        $obj->viewAny = true;
        $obj->restore = true;
        $obj->forceDelete = true;

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,

            'roles' => [
                'user' => $obj,
                'offer' => $obj,
            ],

            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ];
    }
}