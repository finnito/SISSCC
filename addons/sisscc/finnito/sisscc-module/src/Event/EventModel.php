<?php namespace Finnito\SissccModule\Event;

use Finnito\SissccModule\Event\Contract\EventInterface;
use Anomaly\Streams\Platform\Model\Sisscc\SissccEventEntryModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventModel extends SissccEventEntryModel implements EventInterface
{
    use HasFactory;

    /**
     * @return EventFactory
     */
    protected static function newFactory()
    {
        return EventFactory::new();
    }
}
