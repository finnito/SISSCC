<?php namespace Finnito\SissccModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Finnito\SissccModule\Event\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class APIController extends PublicController
{
    public function getEventData(Auth $auth, EventRepository $events, $slug)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, "You must be logged in.");
        }

        if (!$user->hasAnyRole(['admin', 'user'])) {
            abort(403, "You must have user or admin rights.");
        }

        $event = $events->newQuery()->whereSlug($slug)->first();

        if (!$event) {
            abort(404, "Event Not Found");
        }

        if ($event->results == "") {
            return Response::json("", 200);
        }

        $results = json_decode($event->results, true);
        ksort($results);
        $event->results = json_encode($results);
        return Response::json($event, 200);
    }

    public function saveEventData(Auth $auth, EventRepository $events, Request $request, $slug)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, "You must be logged in.");
        }

        if (!$user->hasAnyRole(['admin', 'user'])) {
            abort(403, "You must have user or admin rights.");
        }

        $event = $events->newQuery()->whereSlug($slug)->first();

        if (!$event) {
            abort(404, "Event Not Found");
        }

        $data = $request->input("data");
        $event->results = $data;
        $saved = $events->save($event);
        if (!$saved) {
            return Response::json([], 500);
        }

        return Response::json([], 200);
    }

    public function getEventResults(Auth $auth, EventRepository $events, $slug)
    {

        $user = auth()->user();

        $event = $events->newQuery()->whereSlug($slug)->first();

        if (!$event) {
            abort(404, "Event Not Found");
        }

        if ((!$event->public) && !$user->hasAnyRole(['admin', 'user'])) {
            abort(404, "Private Event");
        }

        $results = json_decode($event->results, true);
        ksort($results);
        $event->results = json_encode($results);

        $overallTeams = [];
        $maleTeams = [];
        $femaleTeams = [];
        $mixedTeams = [];

        $results = json_decode($event->results);

        foreach ($results as $team => $data) {
            $overallTeams[$team] = array_sum($data->results);
            if ($data->category == "M") {
                $maleTeams[$team] = array_sum($data->results);
            } elseif ($data->category == "F") {
                $femaleTeams[$team] = array_sum($data->results);
            } elseif ($data->category == "Mix") {
                $mixedTeams[$team] = array_sum($data->results);
            }
        }

        array_multisort($overallTeams, SORT_DESC, array_keys($overallTeams), SORT_ASC, array_values($overallTeams));
        array_multisort($maleTeams, SORT_DESC, array_keys($maleTeams), SORT_ASC, array_values($maleTeams));
        array_multisort($femaleTeams, SORT_DESC, array_keys($femaleTeams), SORT_ASC, array_values($femaleTeams));
        array_multisort($mixedTeams, SORT_DESC, array_keys($mixedTeams), SORT_ASC, array_values($mixedTeams));

        $out = [
            "overall" => $overallTeams,
            "male" => $maleTeams,
            "female" => $femaleTeams,
            "mixed" => $mixedTeams,
        ];

        return Response::json($out, 200);
    }
}
