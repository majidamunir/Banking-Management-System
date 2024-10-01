@include('header')
<!-- slider section -->
<section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="detail-box">
                                <h1>
                                    Banking System <br>
                                    Management
                                </h1>
                                <p>
                                    Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic?
                                    Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel
                                    architecto veritatis delectus repellat modi impedit sequi.
                                </p>
                                <div class="btn-box">
                                    <li>
                                        <div style="display: flex; gap: 5px;">
                                            @guest
                                                <!-- Show Register and Login buttons if not authenticated -->
                                                <a class="dropdown-item" href="{{ route('register') }}"
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Register
                                                </a>
                                                <a class="dropdown-item" href="{{ route('login') }}"
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Login
                                                </a>
                                            @endguest

                                            @auth
                                                <!-- Show Dashboard button if authenticated -->
                                                <a class="dropdown-item" href=""
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Dashboard
                                                </a>
                                            @endauth
                                        </div>

                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="images/slider-img.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="detail-box">
                                <h1>
                                    Banking System <br>
                                    Management
                                </h1>
                                <p>
                                    Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic?
                                    Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel
                                    architecto veritatis delectus repellat modi impedit sequi.
                                </p>
                                <div class="btn-box">
                                    <li>
                                        <div style="display: flex; gap: 10px;">
                                            @guest
                                                <!-- Show Register and Login buttons if not authenticated -->
                                                <a class="dropdown-item" href="{{ route('register') }}"
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Register
                                                </a>
                                                <a class="dropdown-item" href="{{ route('login') }}"
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Login
                                                </a>
                                            @endguest

                                            @auth
                                                <!-- Show Dashboard button if authenticated -->
                                                <a class="dropdown-item" href=""
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Dashboard
                                                </a>
                                            @endauth
                                        </div>

                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="images/slider-img.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="detail-box">
                                <h1>
                                    Banking System <br>
                                    Management
                                </h1>
                                <p>
                                    Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic?
                                    Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel
                                    architecto veritatis delectus repellat modi impedit sequi.
                                </p>
                                <div class="btn-box">
                                    <li>
                                        {{--                              <div style="display: flex; gap: 10px;">--}}
                                        {{--                                  <a class="dropdown-item" href="{{ route('register') }}" style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">--}}
                                        {{--                                      <i aria-hidden="true"></i> Register--}}
                                        {{--                                  </a>--}}
                                        {{--                                  <a class="dropdown-item" href="{{ route('login') }}" style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">--}}
                                        {{--                                      <i aria-hidden="true"></i> Login--}}
                                        {{--                                  </a>--}}
                                        {{--                              </div>--}}
                                        <div style="display: flex; gap: 10px;">
                                            @guest
                                                <!-- Show Register and Login buttons if not authenticated -->
                                                <a class="dropdown-item" href="{{ route('register') }}"
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Register
                                                </a>
                                                <a class="dropdown-item" href="{{ route('login') }}"
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Login
                                                </a>
                                            @endguest

                                            @auth
                                                <!-- Show Dashboard button if authenticated -->
                                                <a class="dropdown-item" href=""
                                                   style="background-color: lightseagreen; color: white; padding: 10px 15px; border-radius: 2px; text-decoration: none;">
                                                    <i aria-hidden="true"></i> Dashboard
                                                </a>
                                            @endauth
                                        </div>

                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="images/slider-img.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
    </div>

</section>
<!-- end slider section -->
</div>


<!-- about section -->

<section class="why_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                About <span>Us</span>
            </h2>
        </div>
        <div class="why_container">
            <div class="box">
                <div class="img-box">
                    <img src="images/w1.png" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        Expert Management
                    </h5>
                    <p>
                        Incidunt odit rerum tenetur alias architecto asperiores omnis cumque doloribus aperiam numquam!
                        Eligendi corrupti, molestias laborum dolores quod nisi vitae voluptate ipsa? In tempore
                        voluptate ducimus officia id, aspernatur nihil.
                        Tempore laborum nesciunt ut veniam, nemo officia ullam repudiandae repellat veritatis unde
                        reiciendis possimus animi autem natus
                    </p>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="images/w2.png" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        Secure Investment
                    </h5>
                    <p>
                        Incidunt odit rerum tenetur alias architecto asperiores omnis cumque doloribus aperiam numquam!
                        Eligendi corrupti, molestias laborum dolores quod nisi vitae voluptate ipsa? In tempore
                        voluptate ducimus officia id, aspernatur nihil.
                        Tempore laborum nesciunt ut veniam, nemo officia ullam repudiandae repellat veritatis unde
                        reiciendis possimus animi autem natus
                    </p>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="images/w3.png" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        Instant Trading
                    </h5>
                    <p>
                        Incidunt odit rerum tenetur alias architecto asperiores omnis cumque doloribus aperiam numquam!
                        Eligendi corrupti, molestias laborum dolores quod nisi vitae voluptate ipsa? In tempore
                        voluptate ducimus officia id, aspernatur nihil.
                        Tempore laborum nesciunt ut veniam, nemo officia ullam repudiandae repellat veritatis unde
                        reiciendis possimus animi autem natus
                    </p>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="images/w4.png" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        Happy Customers
                    </h5>
                    <p>
                        Incidunt odit rerum tenetur alias architecto asperiores omnis cumque doloribus aperiam numquam!
                        Eligendi corrupti, molestias laborum dolores quod nisi vitae voluptate ipsa? In tempore
                        voluptate ducimus officia id, aspernatur nihil.
                        Tempore laborum nesciunt ut veniam, nemo officia ullam repudiandae repellat veritatis unde
                        reiciendis possimus animi autem natus
                    </p>
                </div>
            </div>
        </div>
        <div class="btn-box">
            <a href="{{ route('About') }}">
                Read More
            </a>
        </div>
    </div>
</section>

<!-- end about section -->


<!-- resource section -->

<section class="service_section layout_padding">
    <div class="service_container">
        <div class="container ">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>Resources</span>
                </h2><br>
                <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Currency Wallet
                            </h5>
                            <p>
                                fact that a reader will be distracted by the readable content of a page when looking at
                                its layout.
                                The
                                point of using
                            </p>
                            <a href="{{ route('Resource') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Security Storage
                            </h5>
                            <p>
                                fact that a reader will be distracted by the readable content of a page when looking at
                                its layout.
                                The
                                point of using
                            </p>
                            <a href="{{ route('Resource') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Expert Support
                            </h5>
                            <p>
                                fact that a reader will be distracted by the readable content of a page when looking at
                                its layout.
                                The
                                point of using
                            </p>
                            <a href="{{ route('Resource') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="{{ route('Resource') }}">
                    View All
                </a>
            </div>
        </div>
    </div>
</section>

@if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724;">
        {{ session('success') }}
    </div>
@endif

<!-- end resource section -->

@include('footer')
