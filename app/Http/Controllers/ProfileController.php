<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    // Método para mostrar el perfil y los artículos del autor
    public function show(Profile $profile)
    {
        // Consulta para obtener los artículos del autor que son públicos
        $articles = Article::where([
            ['user_id', $profile->user_id],
            ['status', '1'] // Solo artículos públicos
        ])->simplePaginate(8); // Paginación de 8 artículos por página

        // Retorna la vista del perfil con los artículos
        return view('subscriber.profiles.show', compact('profile', 'articles'));
    }

    // Método para redirigir al formulario de edición
    public function edit(Profile $profile)
    {
        return view('subscriber.profiles.edit', compact('profile'));
    }

    // Método para actualizar el perfil
    public function update(ProfileRequest $request, Profile $profile)
    {
        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Verifica si existe la foto actual y la elimina
            if ($profile->photo && File::exists(public_path('storage/'.$profile->photo))) {
                File::delete(public_path('storage/'.$profile->photo));
            }
            // Almacenar nueva foto
            $photo = $request->file('photo')->store('profiles', 'public');
        } else {
            // Si no se cambia la foto, mantiene la actual
            $photo = $profile->photo;
        }

        // Actualiza nombre y correo del usuario
        $user->full_name = $request->full_name;
        $user->email = $request->email;

        // Asignar los campos adicionales del perfil
        $profile->profession = $request->profession;
        $profile->about = $request->about;
        $profile->photo = $photo;
        $profile->twitter = $request->twitter;
        $profile->linkedin = $request->linkedin;
        $profile->facebook = $request->facebook;

        // Guardar cambios del usuario y perfil
        $user->save();
        $profile->save();

        // Redirigir a la página de edición del perfil con un mensaje de éxito
        return redirect()->route('profiles.edit', $profile->id)->with('status', 'Perfil actualizado correctamente.');
    }
}
