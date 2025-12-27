<footer class="site-footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h2 class="footer-heading mb-3">Instagram</h2>
                <div class="row">
                    @foreach (['insta_1.jpg', 'insta_2.jpg', 'insta_3.jpg', 'insta_4.jpg', 'insta_5.jpg', 'insta_6.jpg'] as $img)
                        <div class="col-4 gal_col">
                            <a href="#"><img src="{{ asset('images/' . $img) }}" alt="Image"
                                    class="img-fluid"></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-8 ml-auto">
                <div class="row">
                    <div class="col-lg-6 ml-auto">
                        <h2 class="footer-heading mb-4">Quick Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about_page') }}">About Us</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="{{ route('contact_page') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="footer-heading mb-4">Newsletter</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt odio iure animi
                            ullam quam, deleniti rem!</p>
                        <form action="#" class="d-flex" class="subscribe">
                            <input type="text" class="form-control mr-3" placeholder="Email">
                            <input type="submit" value="Send" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <div class="border-top pt-5">
                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i
                            class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
