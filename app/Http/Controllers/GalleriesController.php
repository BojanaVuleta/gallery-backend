<?php

namespace App\Http\Controllers;

use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    private GalleryService $galleryService;

    public function __construct(GalleryService $galleryService) 
    {
        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->galleryService->showGalleries();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->galleryService->postGallery($request);
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(string $id)
    {
        return $this->galleryService->showGallery($id);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, string $id)
    {
        $gallery = $this->galleryService->editGallery($request, $id);
        return $gallery;
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id)
    {
        $gallery = $this->galleryService->deleteGallery($id);
        return $gallery;
    }


    public function showComments(Request $request)
    {
        return $this->galleryService->showComments();
    }
    public function postComment(Request $request)
    {
        return $this->galleryService->createComment($request);
    }
    public function deleteComment(string $id)
    {
        $comment = $this->galleryService->deleteComment($id);
        return $comment;
    }

    public function showUsers()
    {
        return $this->galleryService->showUsers();
    }

    public function showUser(string $id)
    {
        return $this->galleryService->showUser($id);
    }

    public function showGalleryWithComments($galleryId)
    {
        $gallery = $this->galleryService->showGallery($galleryId);
        $comments = $this->galleryService->showCommentsByGalleryId($galleryId);

    
        return ['gallery' => $gallery, 'comments' => $comments];
    }

    public function authorGalleries($authorId) {
        $galleries = $this->galleryService->showAuthorGalleries($authorId);
        return $galleries;
    }

    public function showMyGalleries()
    {
        $galleries = $this->galleryService->showMyGalleries();
        return $galleries;
    }
    
}
