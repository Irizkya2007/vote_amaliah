<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\School; // Import School model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    // Show the users list
    public function index()
    {
        // Fetch users with their related kelas, role, and school
        $users = User::with(['kelas', 'role', 'school'])->get();
        $kelas = Kelas::all();  // Fetch all classes for the dropdown
        $roles = Role::all();   // Fetch all roles for the dropdown
        $schools = School::all(); // Fetch all schools for the dropdown

        return view('admin.datauser.index', compact('users', 'kelas', 'roles', 'schools'));
    }

    // Update a specific user
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'nisn' => 'nullable|string|unique:users,nisn,' . $id,
            'nis' => 'nullable|string|unique:users,nis,' . $id,
            'nip' => 'nullable|string|unique:users,nip,' . $id,
            'kelas_id' => 'nullable|exists:kelas,id',
            'role_id' => 'required|exists:roles,id',
            'school_id' => 'required|exists:schools,id', // Validasi untuk school_id
        ]);

        // Find the user by id
        $user = User::findOrFail($id);

        // Update user details
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nisn = $request->nisn;
        $user->nis = $request->nis;
        $user->nip = $request->nip;
        $user->kelas_id = $request->kelas_id;
        $user->role_id = $request->role_id;
        $user->school_id = $request->school_id; // Update school_id

        // Check if password is being updated
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Save the updated user

        return redirect()->route('datauser.index')->with('success', 'User updated successfully.');
    }

    // Delete a specific user
    public function destroy($id)
    {
        // Find the user by id and delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('datauser.index')->with('success', 'User deleted successfully.');
    }

    // Store a new user
    public function store(Request $request)
    {
        // Determine the user type
        $userType = $request->input('user_type');

        // Validation based on user type
        if ($userType === 'siswa') {
            $request->validate([
                'name' => 'required|string|max:255',
                'nisn' => 'required|string|unique:users',
                'nis' => 'required|string|unique:users',
                'kelas_id' => 'required|exists:kelas,id',
                'role_id' => 'required|exists:roles,id',
                'school_id' => 'required|exists:schools,id', // Validasi untuk school_id
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'nip' => 'required|string|unique:users',
                'role_id' => 'required|exists:roles,id',
                'school_id' => 'required|exists:schools,id', // Validasi untuk school_id
            ]);
        }

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->school_id = $request->school_id; // Set school_id

        // Handle Siswa data
        if ($userType === 'siswa') {
            $user->username = $request->nisn;  // Set username as NISN
            $user->password = Hash::make($request->nis);  // Set password as hashed NIS
            $user->nisn = $request->nisn;
            $user->nis = $request->nis;
            $user->kelas_id = $request->kelas_id;
        }
        // Handle Guru/Pegawai data
        else {
            $user->username = $request->nip;  // Set username as NIP
            $user->password = Hash::make($request->nip);  // Set password as hashed NIP
            $user->nip = $request->nip;
        }

        // Save the user to the database
        $user->save();

        // Redirect back to the user list with a success message
        return redirect()->route('datauser.index')->with('success', 'User created successfully.');
    }
}
