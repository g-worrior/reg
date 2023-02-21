<?php

use App\Http\Controllers\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/post/{post_id}/comments/create', [CommentController::class, 'create']);
Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

/*-----------------------------Start Admin Routes--------------------------*/
Route::prefix('admin')->middleware(['auth', 'isAdmin', 'verified'])->group(function () {
    Route::get('/customer', [App\Http\Controllers\Admin\UserController::class, 'index']); //route for getting customer list
    Route::get('/dashboard', [App\Http\Controllers\Admin\UserController::class, 'dashboard']); //route for admin dashboard
    Route::get('/myprofile', [App\Http\Controllers\Admin\UserController::class, 'myprofile']); //route for user profile
    Route::get('/myposts', [App\Http\Controllers\Admin\UserController::class, 'myposts']); //route for user profile

    /**-----Districts------ */
    Route::get('/district', [App\Http\Controllers\Admin\DistrictController::class, 'getdistrict']); //route for getting districts
    Route::post('/districtsave', [App\Http\Controllers\Admin\DistrictController::class, 'insertdistrict']); //route for saving district
    Route::post('/districtupdate', [App\Http\Controllers\Admin\DistrictController::class, 'updatedistrict']); //route for updating district
    Route::post('/districtdelete', [App\Http\Controllers\Admin\DistrictController::class, 'deletedistrict']); //route for deleting district

    /**------business categories */
    Route::get('/business_categories', [App\Http\Controllers\Admin\CategoryController::class, 'getcategory']); //route for getting districts
    Route::post('/categorysave', [App\Http\Controllers\Admin\CategoryController::class, 'insertcategory']); //route for saving district
    Route::post('/categoryupdate', [App\Http\Controllers\Admin\CategoryController::class, 'updatecategory']); //route for updating district
    Route::post('/categorydelete', [App\Http\Controllers\Admin\CategoryController::class, 'deletecategory']); //route for deleting district


    /**------business types------------*/
    Route::get('/business_types', [App\Http\Controllers\Admin\BussinessTypeController::class, 'gettype']); //route for getting business types
    Route::post('/typesave', [App\Http\Controllers\Admin\BussinessTypeController::class, 'inserttype']); //route for saving business types
    Route::post('/typeupdate', [App\Http\Controllers\Admin\BussinessTypeController::class, 'updatetype']); //route for updating business types
    Route::post('/typedelete', [App\Http\Controllers\Admin\BussinessTypeController::class, 'deletetype']); //route for deleting business types

    /**------update password -------- */
    Route::get('/change_password', [App\Http\Controllers\Admin\UserController::class, 'change_password']);
    Route::post('/update_password', [App\Http\Controllers\Admin\UserController::class, 'update_password'])->name('update_password');

    /** -------member details--------- */
    Route::get('/member_details/{user}', [App\Http\Controllers\Admin\UserController::class, 'viewUser']);
    Route::post('/update-user/{user}', [App\Http\Controllers\Admin\UserController::class, 'updateUser']);
    Route::get('/delete-user/{user}', [App\Http\Controllers\Admin\UserController::class, 'deleteUser']);

    /**-------adding user----------- */
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'Users']);
    Route::get('/add-user', [App\Http\Controllers\Admin\UserController::class, 'addUser']);
    Route::post('/add-user-db', [App\Http\Controllers\Admin\UserController::class, 'addUsertoDB']);
    Route::get('/delete-user-db/{user}', [App\Http\Controllers\Admin\UserController::class, 'deleteadminorexecutive']);
});
/*-----------------------------End Admin Routes----------------------------*/


/*-----------------------------Start Executive Routes--------------------------*/
Route::prefix('executive')->middleware(['auth', 'isExecutive', 'verified'])->group(function () {
    Route::get('/customer', [App\Http\Controllers\Executive\UserController::class, 'index']); //route for getting customer list
    Route::get('/dashboard', [App\Http\Controllers\Executive\UserController::class, 'dashboard']); //route for executive dashboard
    Route::get('/myprofile', [App\Http\Controllers\Executive\UserController::class, 'myprofile']); //route for executive profile

    /**-----Districts------ */
    Route::get('/district', [App\Http\Controllers\Executive\DistrictController::class, 'getdistrict']); //route for getting districts

    /**------business categories */
    Route::get('/business_categories', [App\Http\Controllers\Executive\CategoryController::class, 'getcategory']); //route for getting categories

    /**------business types---------*/
    Route::get('/business_types', [App\Http\Controllers\Executive\BussinessTypeController::class, 'gettype']); //route for getting business types

    /**------ update password--------- */
    Route::get('/change_password', [App\Http\Controllers\Executive\UserController::class, 'change_password']);
    Route::post('/update_password', [App\Http\Controllers\Executive\UserController::class, 'update_password'])->name('update_password');

    /** -------member details--------- */
    Route::get('/member_details/{user}', [App\Http\Controllers\Executive\UserController::class, 'viewUser']);
    
    /**----------blog post routes for executive */
    Route::get('/blog', [\App\Http\Controllers\Executive\BlogPostController::class, 'index']);
    Route::get('/blog/{blogPost}', [\App\Http\Controllers\Executive\BlogPostController::class, 'show']);
    
    Route::get('/view/{post}', [App\Http\Controllers\FrontEnd\BlogPostController::class,'viewpost']);

    Route::get('/blog/create/post', [\App\Http\Controllers\Executive\BlogPostController::class, 'create']); //shows create post form
    Route::post('/blog/create/post', [\App\Http\Controllers\Executive\BlogPostController::class, 'store']); //saves the created post to the databse
    Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\Executive\BlogPostController::class, 'edit']); //shows edit post form
    Route::post('/blog/{blogPost}/edit', [\App\Http\Controllers\Executive\BlogPostController::class, 'update']); //commits edited post to the database 
    Route::get('/blog/delete/{blogPost}', [\App\Http\Controllers\Executive\BlogPostController::class, 'destroy']); //deletes post from the database
});
/*-----------------------------End Executive Routes----------------------------*/


/*-----------------------------Start Frontend Routes--------------------------*/
Route::prefix('frontend')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'dashboard']); //route for fronn user dashboard
    Route::get('/myinfo', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'myinfo']); //route for fronn user dashboard
    Route::get('/subscription', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'subscription']); //route for fronn user dashboard
    Route::get('/updateprofile', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'updateprofile']); //route for fronn user dashboard
    Route::get('/change_password', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'change_password']);
    Route::post('/update_password', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'update_password'])->name('update_password');
    Route::post('/my-profile-update', [App\Http\Controllers\FrontEnd\FrontEndController::class, "profileupdate"]);

    /**-------blog routes for frontend users */
    Route::get('/blog', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'index']);
    Route::get('/blog/myposts', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'show']);

    Route::get('/view/{post}', [App\Http\Controllers\FrontEnd\BlogPostController::class,'viewpost']);
    Route::get('/blog/create/post', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'create']); //shows create post form
    Route::post('/blog/create/post', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'store']); //saves the created post to the databse
    Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'edit']); //shows edit post form
    Route::post('/blog/{blogPost}/edit', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'update']); //commits edited post to the database 
    Route::get('/blog/delete/{blogPost}', [\App\Http\Controllers\FrontEnd\BlogPostController::class, 'destroy']); //deletes post from the database
});
/*-----------------------------End Frontend Admin Routes--------------------------*/

/** --------Blog Post Routes----- */
Route::middleware(['auth'])->group(function () {
    Route::get('/blog', [\App\Http\Controllers\Admin\BlogPostController::class, 'index']);
    Route::get('/blog/{blogPost}', [\App\Http\Controllers\Admin\BlogPostController::class, 'show']);

    Route::get('/view/{post}', [App\Http\Controllers\Admin\BlogPostController::class,'viewpost']);
    Route::get('/blog/create/post', [\App\Http\Controllers\Admin\BlogPostController::class, 'create']); //shows create post form
    Route::post('/blog/create/post', [\App\Http\Controllers\Admin\BlogPostController::class, 'store']); //saves the created post to the databse
    Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\Admin\BlogPostController::class, 'edit']); //shows edit post form
    Route::post('/blog/{blogPost}/edit', [\App\Http\Controllers\Admin\BlogPostController::class, 'update']); //commits edited post to the database 
    Route::get('/blog/delete/{blogPost}', [\App\Http\Controllers\Admin\BlogPostController::class, 'destroy']); //deletes post from the database
});


require __DIR__ . '/auth.php';
