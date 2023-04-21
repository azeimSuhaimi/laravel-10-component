
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<h1 class="text-uppercase text-center text-danger">for title {{$name}}</h1>

<div class="container">

    <div class="row">
        <div class="col">
            <table class="table  text-center text-uppercase" >
                <thead>
                    <tr class="border bg-primary">
                        <th class="border ">ID</th>
                        <th class="border ">Name</th>
                        <th class="border ">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    <tr class="border ">
                        <td class="border ">{{ $row['id'] }}</td>
                        <td class="border ">{{ $row['name'] }}</td>
                        <td class="border ">{{ $row['email'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">
            <div class="card mt-5" >
                <img src='{{public_path('public/img/empty.png')}}' class='card-img-top' alt='...'>
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>





