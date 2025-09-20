<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = $this->commentService->createComment([
            'user_id'     => Auth::id(),
            'product_id'  => $request->product_id,   // null for donation comments
            'donation_id' => $request->donation_id,  // null for product comments
            'content'     => $request->content,
            'parent_id'   => $request->parent_id,
        ]);

        // Clear cache for this product's comments
        if ($request->product_id) {
            Cache::forget("product_{$request->product_id}_comments");
            Cache::forget("product_{$request->product_id}_with_comments");
        }

        if ($request->expectsJson()) {
            $comment->load('user');
            return response()->json([
                'success' => true,
                'comment' => [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user' => [
                        'id' => $comment->user->id,
                        'fname' => $comment->user->fname,
                        'lname' => $comment->user->lname,
                    ],
                ],
            ], 201);
        }

        return redirect()->back();
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = $this->commentService->getCommentById($id);
    
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $comment = $this->commentService->getCommentById($id);

    if ($comment->user_id !== Auth::id()) {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    // Update comment
    $this->commentService->updateComment($id, [
        'content' => $request->input('content'),
    ]);

    // Clear cache for this product's comments
    Cache::forget("product_{$comment->product_id}_comments");
    Cache::forget("product_{$comment->product_id}_with_comments");
    
    // Clear all comment-related cache
    Cache::flush();

    // Reload the updated comment so we send fresh data
    $comment->refresh();

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'comment' => [
                'id'      => $comment->id,
                'content' => $comment->content,
            ],
        ]);
    }

    // Fallback for non-AJAX with cache control headers
    return redirect()->back()
        ->with('success', 'Comment updated successfully!')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id === Auth::id()) {
            $this->commentService->deleteComment($comment->id);
            return redirect()->back()->with('success', 'Comment deleted.');
        }
        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}
