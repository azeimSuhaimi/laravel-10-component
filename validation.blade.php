<?php 

        $validated = $request->validate([
            'name' => 'required|uppercase|string',
            'email' => 'required|email|unique:user,email|ends_with:gmail.com,yahoo.com,...',
            'phone' => 'required|numeric',
            'ic' => 'required|max:10|starts_with:foo,bar,...|integer',
            'password1' => 'required',
            'password2' => 'required|min:4|same:password1',
            'messege' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////

        use Illuminate\Validation\Rule;

        $validated = $request->validate([
            'name' => 'required',
            'email' => [
                'required',Rule::unique('user')->ignore( auth()->user()->email,'email')],
            'phone' => 'required|numeric',
        ]);


        /////////////////////////////////////////////////////////////////////////////////////////

        $validated = $request->validate([
            'email' => 'required|email|unique:subscribe,email',
            ],[
            'email.unique' => 'This email address has already been used.',
            ]);


?>


<input type="text" class=" @error('name') is-invalid @enderror "  value="{{ old('name') }}" name="name">
@error('name')
    {{ $message }}
@enderror