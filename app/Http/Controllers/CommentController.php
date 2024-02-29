<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Comment::latest()->paginate(10);
        return view('welcome', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $comment = new Comment;
        $comment->title = $request->title;
        $comment->desc = $request->desc;

        if ($comment->save()) {
            return response()->json(['status' => 'successfully Added']);
        } else {
            return response()->json(['status' => 'Some Error']);
        }
        // return $request->post('ok');
        // dd($request->all());
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        // dd($comment);
        return response()->json([
            'status' => 500,
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->title = $request->title;
        $comment->desc = $request->desc;

        if ($comment->update()) {
            return response()->json(['status' => 'successfully Added', 'tr' => 'tr_' . $request->id]);
        } else {
            return response()->json(['status' => 'Some Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Comment::find($id);
        $data->delete();
        return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
    }
}
