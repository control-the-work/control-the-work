<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // todo: check if the event_type_id corresponds with the is_start field
        try {
            if ($request->ajax()) {
                Event::create([
                    'event_type_id' => $request['eventId'],
                    'user_id' => Auth::user()->id,
                    'creator_user_id' => Auth::user()->id,
                    'is_start' => (int)($request['isStart'] === 'true'),
                ]);
                return response()->json([], 200);
            } else {
                return response()->json([], 400);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function listDatatables(Request $request)
    {
        try {
            if ($request->ajax()) {
                $user = Auth::user();
                $userDateTimeZone = new \DateTimeZone($user->company->timezone);
                // todo: make the query with the model
                $events = DB::table('events')
                    ->leftJoin('event_types', 'events.event_type_id', '=', 'event_types.id')
                    ->where('events.user_id', '=', $user->id)
                    ->whereNull('events.deleted_at')
                    ->select('event_types.name as event_type_id',
                        'events.is_start as is_start',
                        'events.created_at as created_at')
                    ->orderBy('events.created_at', 'DESC');
                return DataTables::of($events)
                    ->editColumn('event_type_id', function ($events) {
                        return ($events->is_start ? __('Start') : __('End')) . ' ' . __($events->event_type_id);
                    })
                    ->editColumn('date', function ($events) use ($userDateTimeZone) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $events->created_at)->setTimezone($userDateTimeZone)->format('d/m/Y');
                    })
                    ->editColumn('time', function ($events) use ($userDateTimeZone) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $events->created_at)->setTimezone($userDateTimeZone)->format('H:i:s');
                    })
                    ->make();
            } else {
                return response()->json([
                    'error' => ''
                ], 400);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }
    }
}
