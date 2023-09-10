<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users',
                'password' => 'required',
            ]
        );

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    public function show(int $id): View
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function edit(int $id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users,email,' . $id,
            ]
        );

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    public function destroy(int $id): RedirectResponse
    {
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
