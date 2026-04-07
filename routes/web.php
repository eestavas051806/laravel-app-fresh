<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ideas;
use App\Models\Post;
use App\Models\User;

Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/formtest', function(){
    $posts = Post::all();

    return view('formtest',[
        'posts' => $posts,
    ]);
});

Route::post('/formtest', function(){
    Post::create([
        'description' => request('description'),
    ]);

    return redirect('/formtest');
});

Route::delete('/formtest/{id}', function ($id) {
    Post::findOrFail($id)->delete();

    return redirect('/formtest');
});

Route::get('/delete', function(){
    Post::truncate();  

    return redirect('/formtest');
});


//index
Route::get('/posts', function(){
    $posts = Post::all();

    return view('posts.index', [
        'posts' => $posts,
    ]);
});

//show
Route::get('/posts/{post}', function (Post $post) {
    return view('posts.show', [
        'post' => $post,
    ]);
});

//edit
Route::get('/posts/{post}/edit', function (Post $post) {
    return view('posts.edit', [
        'post' => $post,
    ]);
}
);

//update
Route::patch('/posts/{post}', function (Post $post) {
    $post->update([
        'description' => request('description'),
        'updated_at' => now(),
    ]);

    return redirect('/posts' . '/' . $post->id);
});

// ===== USER CRUD ROUTES (Activity 3) =====
// Users index - display all
Route::get('/users', function () {
    $users = User::all();
    return view('users.index', ['users' => $users]);
});

// Create form
Route::view('/users/create', 'user_registration');

// Store new user
Route::post('/users', function () {
    $validated = request()->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'nickname' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email|max:255',
        'age' => 'nullable|integer|min:0',
        'address' => 'nullable|string',
        'contact_number' => 'nullable|string|max:20',
    ]);

    User::create($validated);

    return redirect('/users')->with('success', 'User created successfully!');
})->name('users.store');

// Show single user
Route::get('/users/{user}', function (User $user) {
    return view('users.show', ['user' => $user]);
});

// Edit form
Route::get('/users/{user}/edit', function (User $user) {
    return view('users.edit', ['user' => $user]);
});

// Update
Route::patch('/users/{user}', function (User $user) {
    $validated = request()->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'nickname' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'age' => 'nullable|integer|min:0',
        'address' => 'nullable|string',
        'contact_number' => 'nullable|string|max:20',
    ]);

    $user->update($validated);

    return redirect('/users/' . $user->id)->with('success', 'User updated successfully!');
});

// Delete
Route::delete('/users/{user}', function (User $user) {
    $user->delete();
    return redirect('/users');
});
