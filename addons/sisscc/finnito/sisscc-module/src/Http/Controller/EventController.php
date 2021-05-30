<?php namespace Finnito\SissccModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Finnito\SissccModule\Event\EventRepository;
use Finnito\SissccModule\Event\Form\EventFormBuilder;
use Illuminate\Support\Facades\Auth;

class EventController extends PublicController
{

    public function adminFrontend(EventRepository $events, Auth $auth, $slug)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if (!$user->hasAnyRole(['admin', 'user'])) {
            abort(403, "You must have user or admin rights.");
        }

        $event = $events->newQuery()->whereSlug($slug)->first();

        if (!$event) {
            abort(404, "Event Not Found");
        }

        $this->template->set("meta_title", $event->name . " Input");

        return view(
            "finnito.module.sisscc::input",
            [
                "slug" => $slug,
            ]
        );
    }

    public function frontendEditForm(EventFormBuilder $formBuilder, EventRepository $events, Auth $auth, $slug)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if (!$user->hasAnyRole(['admin', 'user'])) {
            abort(403, "You must have user or admin rights.");
        }

        $event = $events->newQuery()->whereSlug($slug)->first();

        if (!$event) {
            abort(404, "Event Not Found");
        }

        $this->template->set("meta_title", "Edit " . $event->name);

        return view("finnito.module.sisscc::edit_event", ["event" => $event]);
    }

    public function frontendCreateForm(EventFormBuilder $formBuilder, Auth $auth)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if (!$user->hasAnyRole(['admin', 'user'])) {
            abort(403, "You must have user or admin rights.");
        }

        $this->template->set("meta_title", "Create Event");

        return view("finnito.module.sisscc::create_event");
    }

    public function publicFrontend(EventRepository $events, $slug)
    {
        $event = $events->newQuery()->whereSlug($slug)->first();

        if (!$event) {
            abort(404, "Event Not Found");
        }

        $this->template->set("meta_title", $event->name . " Leaderboard");

        $user = auth()->user();
        if (!$user) {
            if (!$event->public) {
                return view("finnito.module.sisscc::upcoming", ["event" => $event]);
            }
        } else {
            if (!$event->public) {
                if ($user->hasAnyRole(['admin', 'user'])) {
                    return view("finnito.module.sisscc::public",
                        [
                            "event" => $event, 
                            "notice" => "This event is visible because you are an admin/user. It is hidden to the public."
                        ]
                    );
                }
            } else {
                return view("finnito.module.sisscc::public",
                    [
                        "event" => $event, 
                    ]
                );
            }
        }

        return view("finnito.module.sisscc::public", ["event" => $event]);
    }

    public function home(EventRepository $events)
    {
        $this->template->set("meta_title", "Home");
        return view("finnito.module.sisscc::home", ["events" => $events->newQuery()->orderBy("date", "desc")->get()]);
    }
}
