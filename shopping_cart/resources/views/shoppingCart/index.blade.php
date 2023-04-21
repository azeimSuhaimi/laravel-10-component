<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>


    <div class="container">

        <h1>list product</h1>

        @include('partials.popup')



        <span class="text text-danger"> total cart {{Cart::content()->count()}}</span>

        <table class="table table-bordered border-primary table-responsive">
            <tr>
                <th>#</th>
                <th>id</th>
                <th>items</th>
                <th>category</th>
                <th>price</th>
                <th>#</th>
            </tr>
            <tr>
                <td>1</td>
                <td>190</td>
                <td>roti</td>
                <td>food</td>
                <td>RM 10.00</td>
                <td>
                    <form action="{{route('shoppingCart.add_to_cart')}}" method="post">
                        @csrf
                        <input type="hidden" value="190" name="id">
                        <input type="hidden" value="roti" name="name">
                        <input type="hidden" value="5" name="stock">
                        <input type="hidden" value="10.00" name="price">
                        <button type="submit" class="btn btn-primary">add to cart</button>
                    </form>
                </td>
            </tr>
        </table>

        <a href="{{route('shoppingCart.cart')}}">cart</a>
    </div>
    
</body>
</html>