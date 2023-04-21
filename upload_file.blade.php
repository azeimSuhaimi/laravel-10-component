<?php 


//upload image
        $validated = $request->validate([

            'file' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
   
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('assets/posts_images/'), $fileName);

            // you can store fileName to database here

            return redirect(route('createPost'))->with('success',$validated['title']);
            
        }


        /////////////////////////////////////////////////////////////////////////////


        //update image

        use Illuminate\Support\Facades\File;

        $validated = $request->validate([

            'file' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
   
        ]);
        
        $id = $request->input('id');

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $post = posts::find($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('assets/posts_images/'), $fileName);

                $filePath = public_path('assets/posts_images/'.$post->image);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            return redirect(route('editPost').'?id='.$id)->with('success',$fileName);
            
        }

        ///////////////////////////////////////////////////////////////////////////////

        // update image profile 

        use Illuminate\Support\Facades\File;

        $validated = $request->validate([

            'file' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
   
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('assets/profiles/'), $fileName);

            if(auth()->user()->picture != 'empty.png')
            {
                
                $filePath = public_path('assets/profiles/'.auth()->user()->picture);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
    
            // you can store fileName to database here

            //Get the authenticated user
             auth()->user()->picture = $fileName;

             $users = user::find(auth()->user()->username);
             $users->picture = $fileName;
             $users->save();

            return redirect('/profile')->with('success',$fileName);
            
        }


?>


<img src="assets/profiles/{{ auth()->user()->picture }}" alt="..." class="img-thumbnail img-fluid rounded-circl">

<div class="custom-file">
    <input type="file" class="custom-file-input" name="file" id="file-input">
    <label class="custom-file-label"  for="file-input">Choose file</label>
  </div>


<script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');
    
    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function () {
          imagePreview.src = reader.result;
          imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.style.display = 'none';
      }
    });
    
    
    
    </script>