<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TagRequest;
use App\TagCreator;


class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only([
            'update', 
            'destroy',
            ]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        
        $this->authorize('update', $tag);

        $tag->update(['title' => TagCreator::validateTag($request['title'])]);

        return response()->json($tag, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('update', $tag);

        $tag->delete();

        return response()->json(['message' => "Succesfully deleted"], 200);
    }
}
