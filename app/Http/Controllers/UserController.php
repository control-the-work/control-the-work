<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
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
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $timezones = array_combine($timezones, $timezones);
        $roles = Role::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $roleSelected = [];
        $company = Auth::user()->company;
        return view('users.create', compact('roles', 'roleSelected', 'company', 'timezones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request['password']);
        $user = new User($input);
        $user->setRememberToken(Str::random(100));
        $user->company_id = Auth::user()->company_id;
        $user->save();
        // Assign the role
        $role = Role::findById($input['role']);
        $user->assignRole($role->name);
        // Send the validation email
        $user->sendEmailVerificationNotification();
        return redirect(action('UserController@index'))
            ->with('success', __('User created successfully! Check the user email to verify it.'));
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
    public function edit(User $user)
    {
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $timezones = array_combine($timezones, $timezones);
        $roles = Role::orderBy('name', 'ASC')->get()->pluck('name', 'id');
        $roleSelected = Role::findByName($user->getRoleNames()->first())->id;
        $company = $user->company;
        return view('users.edit', compact('roles', 'roleSelected', 'company', 'timezones', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $oldRoles = $user->getRoleNames();
        $oldEmail = $user->email;
        $input = $request->all();
        if ("" != trim($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }
        if ($oldEmail !== $input['email']) {
            $input['email_verified_at'] = null;
        }
        $user->update($input);
        // Reemove and assign the role
        foreach ($oldRoles as $oldRole) {
            $user->removeRole($oldRole);
        }
        $role = Role::findById($input['role']);
        $user->assignRole($role->name);
        // Send the validation email if the email has changed
        $message= 'User updated successfully!';
        if ($oldEmail !== $input['email']) {
            $user->sendEmailVerificationNotification();
            $message .= ' Check the user email to verify it.';
        }
        return redirect(action('UserController@index'))
            ->with('success', __($message));
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
                        return '<a href="' . action('UserController@edit', $users->id) . '">' . $users->name . ' ' . $users->surname . '</a>';
                    })
                    ->editColumn('email_verified_at', function ($users) use ($userDateTimeZone) {
                        return $users->email_verified_at ? Carbon::createFromFormat('Y-m-d H:i:s', $users->email_verified_at)->setTimezone($userDateTimeZone)->format('d/m/Y') : __('Not verified');
                    })
                    ->editColumn('actions', function ($users) {
                        return '<a href="' . action('UserController@edit', $users->id) . '" class="btn" role="button"><i class="fa fa-pencil-square-o"></i></a>' .
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
