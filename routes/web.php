<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/root', function () {
    return view('adminlogin');
})->name('admin');


Route::resource('musics' ,'MusicController');
Route::resource('playlist' ,'PlaylistController');
Route::resource('playlistsong' ,'PlaylistSongController');
Route::resource('mornings' ,'MorningController');
Route::resource('evenings' ,'EveningController');
Route::resource('noons' ,'NoonController');
Route::resource('nights' ,'NightController');
Route::resource('latenights' ,'LateNightController');
Route::resource('albums','AlbumController');
Route::resource('artists' ,'ArtistController');
Route::get('/newsearch','MusicController@search')->name('musics.newsearch');
Route::get('musics/{music}/{uid}/{gen}/newshow','MusicController@newshow')->name('musics.newshow');
Route::get('musics/{music}/mood','MusicController@mood')->name('musics.mood');
Route::get('music/toplist','MusicController@toplist')->name('musics.toplist');
Route::get('music/{music}/recommended','MusicController@recommended')->name('musics.recommended');

Route::get('musics/{music}/ViewByArtist','MusicController@ViewByArtist')->name('musics.ViewByArtist');
Route::get('musics/{music}/ViewByLanguage','MusicController@ViewByLanguage')->name('musics.ViewByLanguage');
Route::get('musics/{music}/ViewSong','MusicController@ViewSong')->name('musics.ViewSong');
Route::get('musics/{music}/ViewByAlbum','MusicController@ViewByAlbum')->name('musics.ViewByAlbum');

Route::get('musics/{music}/ViewByGenre','MusicController@ViewByGenre')->name('musics.ViewByGenre');	
Auth::routes();
Route::get('musics/{music}/playlist','MusicController@playlist')->name('musics.playlist');



Route::get('music/playlistIndex/{uid}','MusicController@playlistIndex')->name('musics.playlistIndex');
Route::get('music/playlistViewByArtist/{uid}','MusicController@playlistViewByArtist')->name('musics.playlistViewByArtist');
Route::get('music/playlistViewByLanguage/{uid}','MusicController@playlistViewByLanguage')->name('musics.playlistViewByLanguage');
Route::get('music/playlistmood/{uid}','MusicController@playlistmood')->name('musics.playlistmood');
Route::get('music/playlisttoplist/{uid}','MusicController@playlisttoplist')->name('musics.playlisttoplist');
Route::get('music/autoplaylist/{uid}','MusicController@autoplaylist')->name('musics.autoplaylist');
Route::get('music/playlistViewByAlbum/{uid}','MusicController@playlistViewByAlbum')->name('musics.playlistViewByAlbum');
Route::get('music/playlistViewByGenre/{uid}','MusicController@playlistViewByGenre')->name('musics.playlistViewByGenre');

Route::get('music/playlistViewSong/{uid}','MusicController@playlistViewSong')->name('musics.playlistViewSong');
Route::get('music/playlistplaylist','MusicController@playlistplaylist')->name('musics.playlistplaylist');

