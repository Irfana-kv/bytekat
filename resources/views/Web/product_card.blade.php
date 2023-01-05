<div class="row appendHere">
       @foreach(@$products as $product)
       <div class="col-lg-4 col-md-12 mb-4">
              <div class="card">
                     <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                            <img src="{{asset($product->image)}}" class="w-100" />
                            <a href="#!">
                                   <div class="hover-overlay">
                                          <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                   </div>
                            </a>
                     </div>
                     <div class="card-body">
                            <a href="" class="text-reset">
                                   <h5 class="card-title mb-3">{{@$product->title}}</h5>
                            </a>
                            <a href="" class="text-reset">
                                   <p>{{@$product->category->title}}</p>
                            </a>
                            @if($product->price)
                            <h6 class="mb-3">₹{{@$product->price}}</h6>
                            @endif
                            @if(@$product->description)
                            <p>{{@$product->description}}</p>
                            @endif
                     </div>
              </div>
       </div>
       @endforeach
</div>