<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->get();
        return view('admin.akun_user.index', compact('users'));
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:users,username', 'string', 'max:255'],
            'nama_depan' => ['nullable', 'string', 'max:255'],
            'nama_belakang' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'unique:users,email', 'string', 'lowercase', 'email', 'max:255'],
            'roles' => ['required', 'string', 'in:user,admin'],
            'date_of_birth' => ['nullable', 'date'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $data = $validatedData;
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('akun_user.index')->with('success', 'Akun pengguna baru berhasil ditambahkan.');
    }

    public function edit() {
        //
    }

    public function update(Request $request, User $akun_user) {

        $validatedData = $request->validate(
            $rules = [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('users', 'name')->ignore($akun_user->id)],
            'nama_depan' => ['string', 'max:255'],
            'nama_belakang' => ['string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($akun_user->id)],
            'roles' => ['required', 'string', 'in:user,admin'],
            'date_of_birth' => ['required', 'date'],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $validatedData = $request->validate($rules);
        $dataToUpdate = $validatedData;

        if($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $akun_user->update($validatedData);
        return redirect()->route('akun_user.index')->with('success', 'Akun pengguna berhasil diperbarui.');
    }

    public function destroy(User $akun_user) {
        $akun_user->delete();
        return redirect()->route('akun_user.index')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
