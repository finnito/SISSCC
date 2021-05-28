<?php namespace Finnito\SissccModule\Event;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var EventModel
     */
    protected $model = EventModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [];
    }
}
