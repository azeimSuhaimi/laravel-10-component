<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">

        <h1>checkout</h1>
        @include('partials.popup')
        <a href="{{route('shoppingCart.index')}}">back to index</a>
        <div class="row">
            <div class="col-6">
                <form action="{{route('shoppingCart.checkout_post')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">phone</label>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3">{{ old('address') }}</textarea>
                        @error('address')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="total" value="{{Cart::total()}}">
                    
                    <button class="btn btn-primary" type="submit">submit</button>
                </form>
            </div>
            <div class="col-6">
                <table class="table table-bordered border-primary table-responsive">
                    <tr>
                        <th>#</th>
                        <th>id</th>
                        <th>items</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>total</th>
                        <th>#</th>
                    </tr>
        
                    @foreach (Cart::content() as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->qty}}</td>
                            <td>{{$row->total}}</td>
                            <td>
                                <form action="{{route('shoppingCart.remove')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="rowid" value="{{$row->rowId}}">
                                    <button type="submit" class="btn btn-danger">remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
        
        
        
                    <tfoot>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <td>Subtotal</td>
                            <td><?php echo Cart::subtotal(); ?></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <td>Tax</td>
                            <td><?php echo Cart::tax(); ?></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <td>Total</td>
                            <td><?php echo Cart::total(); ?></td>
                        </tr>
        
                        
                    </tfoot>
        
                </table>
            </div>
        </div>
    </div>
</body>
</html>