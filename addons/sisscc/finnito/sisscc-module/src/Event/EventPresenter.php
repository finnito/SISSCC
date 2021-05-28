<?php namespace Finnito\SissccModule\Event;

use Anomaly\Streams\Platform\Entry\EntryPresenter;

class EventPresenter extends EntryPresenter
{
    public function publicLabelClass()
    {
        if ($this->public->isTrue()) {
            $class = "tag-success";
        } else {
            $class = "tag-warning";
        }
        return $class;
    }

    public function publicLabelText()
    {
        if ($this->public->isTrue()) {
            return "Public";
        } else {
            return "Private";
        }
    }
}
