<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class GalleryService {

  public function showGalleries() {
    return Gallery::with('user')->orderByDesc('created_at')->paginate(10);
  }

  public function showGallery($id) {
    return Gallery::with('user')->find($id);
  } 

  public function postGallery(Request $request) {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'urls' => 'required',
      
    ]);

    $gallery = new Gallery;
    $gallery->name = $request->name;
    $gallery->description = $request->description;
    $gallery->urls = $request->urls;
    if($request->user_id) {
      $gallery->user_id = $request->user_id;
    }
    $gallery->save();

    return $gallery;
  }

  public function editGallery(Request $request, string $id)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'urls' => 'required',
      
    ]);

      $gallery = Gallery::find($id);
      $gallery->name = $request->name;
      $gallery->description = $request->description;
      $gallery->urls = $request->urls;
      if($request->user_id) {
        $gallery->user_id = $request->user_id;
      }
      $gallery->save();

      return $gallery;
  }

  public function deleteGallery($id)
  {
      Gallery::destroy($id);
  }
  public function showComments() {
    return Comment::all();
  }

  public function createComment(Request $request) {
    $request->validate([
      'description' => 'required|min:1|max:1000'
    ]);

    $comment = new Comment();
    $comment->description = $request->description;
    $comment->user_id = $request->user_id;
    $comment->gallery_id = $request->gallery_id;
    $comment->save();

    return $comment;
  }

  public function showCommentsByGalleryId($galleryId)
{
    return Comment::where('gallery_id', $galleryId)->get();
}

  public function deleteComment($id)
  {
      Comment::destroy($id);
  }

  public function showUsers() {
    return User::all();
  }

  public function showUser($id) {
    return User::find($id);
  } 

  public function showAuthorGalleries($authorId) {
    return Gallery::where('user_id', $authorId)->orderByDesc('created_at')->paginate(10);
}
}