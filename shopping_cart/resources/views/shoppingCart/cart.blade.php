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

        <h1>list cart</h1>

        @include('partials.popup')


        <?php $i = 0?>
        @foreach (Cart::content() as $row)
            <?php $i = $loop->iteration; ?>
        @endforeach

        <form action="{{route('shoppingCart.remove_all')}}" id="myForm" method="post">
            @csrf
            <button class="{{$i >= 1 ? '':'disabled'}} btn btn-danger" type="submit">delete all cart</button>
        </form>

        <a class=" {{$i >= 1 ? '':'disabled'}} btn btn-warning" href="{{route('shoppingCart.checkout')}}">checkout</a>

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
                    <td>
                        <form action="{{route('shoppingCart.edit')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$row->id}}">
                            <input type="hidden" name="rowid" value="{{$row->rowId}}">
                            <input type="number" name="qty" value="{{$row->qty}}">
                            <button type="submit" class="btn btn-success">edit</button>
                        </form>
                    </td>
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

        

        <a href="{{route('shoppingCart.index')}}">back to index</a>
    </div>
    
</body>
</html>


<script>
    // Get the form element
    const form = document.getElementById('myForm');
  
    // Attach a submit event listener to the form
    form.addEventListener('submit', function(event) {
      // Prevent the form from submitting through its default action
      event.preventDefault();
  
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, submit it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      })
  
    });
  </script>