<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\postCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
    function postCategory()
    {
        return view('posts.post-category');
    }

    function postCategoryStore(Request $request)
    {
        $data = $request->all();
        postCategory::create($data);
        return back()->with('status', "category has been added successfully");
    }

    //////////////// post
    function post()
    {
        $show = postCategory::all();
        return view('posts.post', compact('show'));
    }

    function postStore(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;


        $fileFields = ['post_image'];
        foreach($fileFields as $field){
        $file = $request->file('post_image');
        if ($file) {
            $postImages = []; 

            foreach ($file as $files) {
                // $originalName = $files->getClientOriginalName();
                // $files->move('postimages/', $originalName);
                // $postImages[] = $originalName;
                // $data['post_image']=$request->file('post_image')->store('images', 'public');

                // storage
                
                $postImages[] = $files->store('images','public');

                
                // // for oriinal Name
                // $originalName=$files->getClientOriginalName();
                // $postImages[] = $files->storeAs('images',$originalName,'public');
                // $imageNameOnly = basename($originalName);
                // $data['post_image']=$imageNameOnly;


            }
            $data['post_image'] = implode(',', $postImages);
            // $data[$field] = implode(',', $postImages);
        
        }



        }

        post::create($data);
        return back()->with('status', 'post Added success fully');
    }

    //////////////////////////////////// post view

    function postView()
    {
        // $show=post::all();
        // $show = post::with('categoryHas')->latest()->limit(2)->get();
        $show = post::with('categoryHas')->paginate(4);
        $postCategory = postCategory::all();
        return view('posts.post-view', compact('show', 'postCategory'));
    }



    ///////////////////// post slug

    function postSlug($slug, $id)
    {
        $findSlugId = post::find($id);
        return view('posts.post-slug', compact('findSlugId'));
    }

    // post by category

    function postByCategorView($id)
    {
        $postByCategorView = postCategory::with('postBelongs')->find($id);
        return view('posts.post-by-category', compact('postByCategorView'));
    }

    function seePost($id)
    {
        $findSlugId = post::with("categoryHas")->find($id);
        return view('posts.post-slug', compact('findSlugId'));
    }

    ////////////////////// update
    function postUpdate($id)
    {
        $findId = post::find($id);
        $show = postCategory::all();
        return view('posts.post-update', compact('findId', 'show'));
    }

    function postUpdateStore(Request $request, $id)
    {
        $findId = post::find($id);
        $findId->fill($request->only(['post_category_id', 'post_name', 'post_desc']));

        $explodImages=explode(',',$findId->post_image);
foreach($explodImages as $old){
$fullImagePath=public_path('postImages/'.$old);
if(file_exists($fullImagePath)){
    unlink($fullImagePath);
}
}

        $postImages = [];
        $file = $request->file('post_image');
        foreach ($file as $files) {
            $originalName = $files->getClientOriginalName();
            $files->move("postimages/", $originalName);
            $postImages[] = $originalName;
        }

        $findId['post_image'] = implode(',', $postImages);
        $findId->save();

        return back()->with('status', "post Updated successfully...");
    }

    // delete

    function postDelete($id)
    {
        $deleteId = post::find($id);
        if (!$deleteId) {
            return back()->with('status', 'Post not found.');
        }
        // $explodImages = explode(',', $deleteId->post_image);

        // foreach ($explodImages as $old) {
        //     $fullImagePath = public_path('postImages/' . $old);

        //     if (file_exists($fullImagePath)) {
        //         unlink($fullImagePath);
        //     }
        // }

        $explodImages = explode(',', $deleteId->post_image);
foreach ($explodImages as $old) {
Storage::disk('public')->delete($old);

}


        $deleteId->delete();

        return back()->with('status', 'post deleted successfully');
    }
}





// $file=$request->file('post_image');
// $originalName=$file->getClientOriginalName();
// $file->move('postimages/',$originalName);
// $data['post_image']=$originalName;
// $data['user_id']=$user->id;


// $fields=['post_image','post_desc'];
// foreach($fields as $field)
// {
//     $file=$request->file($field);
//     if($file){
//         $originalName=$file->getClientOriginalName();
//         $file->move('postimages/',$originalName);
//         $data[$field]=$originalName;
//     }



// $fileFields=['post_desc','post_image'];

// foreach($fileFields as $field){
//     $fields = $request->file($field);
//     if($fields){
//         $postImages = [];
//         foreach ($fields as $file) {
//             $originalName = $file->getClientOriginalName();
//             $hashedName=md5(time().$originalName). '.'.$file->getClientOriginalExtension();
//             $file->move('postimages/', $originalName);
//             $postImages[] = $hashedName;
//         }
// $data[$field]=implode(',',$postImages);

//     }
// }
