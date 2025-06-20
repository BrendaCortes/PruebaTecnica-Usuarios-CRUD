<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
  
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::with('role:id,name') 
        ->select('id', 'name', 'lastName', 'email', 'phoneNumber', 'role_id')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('lastName', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phoneNumber', 'like', "%$search%");
            });
        })
        ->paginate(10)
        ->withQueryString();
        
        $roles = Role::select('id', 'name')->get();
        $isAdmin = auth()->user()?->role?->name === 'Admin';

        return Inertia::render('Dashboard', [
            'users' => $users,
            'search' => $search, 
            'roles' => $roles,
            'isAdmin' => $isAdmin,
        ]);
    }

    public function addUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|string|max:12',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('dashboard')->with('success', 'Usuario creado correctamente');
    }

public function updateUser(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phoneNumber' => 'required|string|max:12',
        'password' => 'nullable|string|min:6',
        'role_id' => 'required|exists:roles,id',
    ]);

    if ($validated['password']) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('dashboard')->with('success', 'Usuario actualizado');
}

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado correctamente');
    }

    public function export()
    {
        $users = User::with('role')->get();

        $csvHeader = ['ID', 'Nombre', 'Apellido', 'Correo', 'Telefono', 'Rol'];
        $csvData = $users->map(function ($user) {
            return [
                $user->id,
                $user->name,
                $user->lastname,
                $user->email,
                $user->phoneNumber,
                $user->role->name,
            ];
        });

        $filename = 'usuarios.csv';

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $contents = stream_get_contents($handle);
        fclose($handle);

        return response($contents, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
