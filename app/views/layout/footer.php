<head>
    <style>
        footer {
            background-color: #fff;
            color: #333;
            padding: 20px 0;
        }

        footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        footer .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        footer .col-md-4 {
            flex-basis: 33.33%;
            padding: 20px;
        }

        footer h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        footer p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        footer form {
            margin-bottom: 20px;
        }

        footer .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        footer .form-control {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
        }

        footer .input-group-btn {
            margin-left: 10px;
            padding: 10px;
        }

        footer .btn {
            padding: 5px 12px;
            border: none;
            border-radius: 5px;
            background-color: #666;
            color: #fff;
            cursor: pointer;
        }

        footer .btn:hover {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        footer .list-unstyled {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        footer .list-unstyled li {
            margin-bottom: 10px;
        }

        footer .list-unstyled a {
            color: #333;
            text-decoration: none;
        }

        footer .list-unstyled a:hover {
            color: #007bff;
        }

        footer .social-buttons {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        footer .social-buttons li {
            display: inline-block;
            margin-right: 10px;
            padding: 5px;
        }

        footer .social-buttons li a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border: 1px solid #515151;
            background-color: transparent;
            color: #515151;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
            text-decoration: none;
        }

        footer .social-buttons li a:hover {
            color: #fff;
            border: 1px solid transparent;
        }

        footer .social-buttons li a.social-instagram:hover {
            background-color: #e1306c;
        }

        footer .social-buttons li a.social-facebook:hover {
            background-color: #1877f2;
        }

        footer .social-buttons li a.social-twitter:hover {
            background-color: #1da1f2;
        }

        footer .social-buttons li a.social-whatsapp:hover {
            background-color: #25d366;
        }

        footer .social-buttons a {
            color: #333;
            text-decoration: none;
        }

        footer .social-buttons a:hover {
            color: #ccc;
        }

        footer .fa {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
</body>
<?php if (isset($footer) && $footer) : ?>
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h3 style="font-size: 32px; font-weight: bold; margin-bottom: 14px;">Re-Kost</h3>
                    <p style="margin-bottom: 52px;">Enter your email below to be the first to know about new collection and product launches</p>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="example@gmail.com">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 18px; font-weight: semibold;">Service</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 18px; font-weight: semibold;">Social Media</h3>
                    <ul class="list-inline social-buttons">
                        <li><a href="#" class="social-instagram"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" class="social-facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="social-twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="social-whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= asset('js/profile.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>