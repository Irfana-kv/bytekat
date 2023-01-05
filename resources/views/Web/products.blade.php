<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap 5 Login Form Example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
  <div class="container-fluid vh-100" style="margin-top:50px">
    <div class="" style="margin-top:50px">
      <section style="background-color: #eee;">
        <div class="text-center container py-5">
          <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item {{Request::segment(1)==''?'active':''}}">
                  <a class="nav-link productCategory" href="#" data-id="0">All</a>
                </li>
                @foreach(@$categories as $category)
                <li class="nav-item {{Request::segment(1)==''?'active':''}}">
                  <a class="nav-link productCategory" data-id="{{$category->id}}" href="#">{{$category->title}}</a>
                </li>
                @endforeach

                <li class="nav-item">
                  <a class="nav-link" href="{{url('customer/logout')}}">Logout</a>
                </li>
              </ul>

            </div>
          </nav>
          <!-- <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4> -->

          <div class="row">
            @include('Web.product_card')
          </div>
      </section>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      $(document).on('click', '.productCategory', function(e) {
        var id = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: 'product-category',
          data: {
            id: id,
            "_token": "{{ csrf_token() }}"
          },
          success: function(data) {
            $('.appendHere').after(data).remove();
          }
        })
      });
    });
  </script>


</body>

</html>