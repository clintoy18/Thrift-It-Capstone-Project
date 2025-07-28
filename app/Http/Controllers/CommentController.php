<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
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
    public function store(StoreCommentRequest $request, $productId)
    {
        $this->commentService->createComment([
            'user_id'=> Auth::id(),
            'product_id'=> $productId,
            'content'=> $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success','Comment added successfully!');
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
        
        if($comment->user_id !== Auth::id()){
            return redirect()->back()->with('error', 'Unauthorize action.');
        }
        $this->commentService->updateComment($id,[
            'content' => $request->input('content'),
        ]);

      return redirect()->route('products.show',$id)->with('success','Comment updated successfully!');


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
