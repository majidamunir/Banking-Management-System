<!-- info section -->

<section class="info_section layout_padding2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 info_col">
                <div class="info_contact">
                    <h4>
                        Address
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Location
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                Call +01 1234567890
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                demo@gmail.com
                            </span>
                        </a>
                    </div>
                </div>
                <div class="info_social">
                    <a href="">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 info_col">
                <div class="info_detail">
                    <h4>About Us</h4>
                    <p>We are the first true generator on the Internet, using a dictionary of over 200 Latin words combined with a handful of model sentence structures to provide comprehensive and reliable information.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-2 mx-auto info_col">
                <div class="info_link_box">
                    <h4>
                        Quick Links
                    </h4>
                    <div class="info_links">
                        <a class="active" href="{{ route('Home') }}">
                            Home
                        </a>
                        <a href="{{ route('About') }}">
                            About
                        </a>
                        <a href="{{ route('Resource') }}">
                            Resources
                        </a>
                        @auth
                            <a href="{{ route('accounts.index') }}">
                                Accounts
                            </a>
                            <a href="{{ route('transactions.index') }}">
                                Transactions
                            </a>
                            <a href="{{ route('loans.index') }}">
                                Loans
                            </a>
                            <a href="{{ route('Rate') }}">
                                Exchange Rates
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 info_col">
                <h4>
                    Subscribe
                </h4>
                <form action="#">
                    <input type="text" placeholder="Enter email" />
                    <button type="submit">
                        Subscribe
                    </button>
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- end info section -->

<!-- footer section -->
<section class="footer_section">
    <div class="container">
        <p>
            &copy; <span id="displayYear"></span> All Rights Reserved By
            Banking System Management
        </p>
    </div>
</section>
<!-- footer section -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- jQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- Owl Slider -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Custom JS -->
<script type="text/javascript" src="js/custom.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
<!-- End Google Map -->

</body>
</html>
