<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // todo: check if it is the unique administrator in the company
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json();
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }
    }

    public function listDatatables(Request $request)
    {
        try {
            if ($request->ajax()) {
                $user = Auth::user();
                $userDateTimeZone = new \DateTimeZone($user->company->timezone);
                $users = DB::table('users')
                    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->whereNull('deleted_at')
                    ->select('users.id', 'users.name', 'users.surname', 'users.email', 'users.email_verified_at', 'roles.name as role_name')
                    ->orderBy('users.name', 'ASC');
                return DataTables::of($users)
                    ->editColumn('name_surname', function ($users) {
                        return ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/user/' . $users->id . '" class="">' . $users->name . ' ' . $users->surname . '</a>';
                    })
                    ->editColumn('email_verified_at', function ($users) use ($userDateTimeZone) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $users->email_verified_at)->setTimezone($userDateTimeZone)->format('d/m/Y');
                    })
                    ->editColumn('actions', function ($users) {
                        return  '<a href="' . action('UserController@edit', $users->id) . '" class="btn" role="button"><i class="fa fa-pencil-square-o"></i></a>' .
                                '<button class="btn delete" data-remote="' . action('UserController@show', $users->id) . '"><i class="fa fa-trash-o"></i></button>';
                    })
                    ->rawColumns(['name_surname', 'actions'])
                    ->make(true);
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
