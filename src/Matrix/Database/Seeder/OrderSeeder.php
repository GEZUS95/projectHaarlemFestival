<?php

namespace Matrix\Database\Seeder;

use App\Model\Event;
use App\Model\Item;
use App\Model\Order;
use App\Model\Permissions;
use App\Model\Program;
use App\Model\Restaurant;
use App\Model\Role;
use App\Model\User;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class OrderSeeder
{
    public function seed()
    {
        $faker = Factory::create();

        Role::create([
            'name' => "visitor",
            'permissions' => json_encode(array()),
        ]);

        User::create([
            'name'=> $faker->name,
            'email' => 'order@example.com',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'role_id' => 1,
        ]);

        $user = User::query()->where("email", "=", "order@example.com")->first();

        Order::create([
            'uuid' => Uuid::uuid4(),
            'status' => 'open',
            'user_id' => $user->id,
        ]);

        $order =  Order::query()->where("user_id", "=", $user->id)->first();

        $event = Event::find(1);
        $program = Program::find(1);
        $item = Item::find(1);
        //$restaurant = Restaurant::find(1);

        //attach items in relationship!
        $order->events()->save($event);
        $order->programs()->save($program);
        $order->items()->save($item);
    }
}
