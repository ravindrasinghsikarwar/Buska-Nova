<?php
/**
 * Template Name: home page
 *
*/
get_header();
?>


<section class="hero-banner">
    <div class="container d-flex">
        <div class="text-slider">
            <div class="hero-title">
                <h1>Watch Live Gigs to Support Your Favourite Artists!</h1>
                <div class="scroll-main"><a class="scroll-bottom" href="#next-section-scroll" id="scroll-bottom" title="">Scroll Down</a></div>
            </div>
            <div class="slider-sec clearfix">        
                <div class="banner-slider">
                    <div class="banner-details" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/uploads/2021/11/slider.png);">
                        <div class="banner-main d-flex">
                            <div class="show-date"><p>24 june</p></div>
                            <div class="show-details">
                                <figure><img src="https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/live.png" alt="live"></figure>
                                <h3>Hilltop Hoods</h3>
                                <a href="#" title="View artist profile" class="bg-gradient">View artist profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="banner-details" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/uploads/2021/11/slider.png);">
                        <div class="banner-main d-flex">
                            <div class="show-date">24 june</div>
                            <div class="show-details">
                                <figure><img src="https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/live.png" alt="live"></figure>
                                <h3>Hilltop Hoods</h3>
                                <a href="#" title="View artist profile" class="bg-gradient">View artist profile</a>
                            </div>
                        </div>
                    </div>                      
                </div>
            </div>
        </div>
        <div class="artist-block">
            <div class="artist-title"><h4>Your Artists are Here Now</h4></div>
            <nav id="site-navigation" class="top-nav main-navigation col-12 col-lg-8 my-auto">                      
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
            </nav>
        </div>
    </div>
</section>


<section class="about-artist" id="next-section-scroll">
    <div class="full-container d-flex">
        <div class="our-mission">
            <h2>Let’s band together <br> and support our artists.</h2>
            <div class="artist-image">
                <figure><img src="https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/our-mission.svg" alt="band support"></figure>
            </div>
            <div class="about-title">
                <a href="#" title="about our mission">about our mission<svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 13" width="33" height="13"><style>tspan { white-space:pre }.shp0 { fill: #ffffff }</style><path id="Layer" fill-rule="evenodd" class="shp0" d="M26.04 0.64C26.24 0.45 26.56 0.45 26.76 0.64L32.85 6.41C32.95 6.5 33 6.62 33 6.75C33 6.88 32.95 7 32.85 7.09L26.76 12.86C26.56 13.05 26.24 13.05 26.04 12.86C25.84 12.67 25.84 12.37 26.04 12.18L30.4 8.05C30.54 7.91 30.59 7.71 30.51 7.53C30.43 7.35 30.25 7.23 30.04 7.23L1.01 7.23C0.73 7.23 0.5 7.02 0.5 6.75C0.5 6.48 0.73 6.27 1.01 6.27L30.04 6.27C30.25 6.27 30.43 6.15 30.51 5.97C30.59 5.79 30.54 5.59 30.4 5.45L26.04 1.32C25.84 1.13 25.84 0.83 26.04 0.64Z" />
                </svg></a>
            </div>
        </div>
        <div class="subscribe-mail">
            <div class="subscribe-inner">
                <h2>Stay in the loop, subscribe to our mailing list.</h2>
                <form action="">
                    <label>your email</label>
                    <input type="email" name="email" class="formStyle" required="">
                    <a href="#" class="formButton bg-gradient" title="Subscribe">Subscribe</a>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="our-artist">
    <div class="full-container">
        <div class="artist-inner">
            <h2>Our Artists</h2>
            <ul class="artist-details">
                <li><a href="#" title="The Veronicas"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists1.png);"></figure><h6>The Veronicas</h6><p>pop, rock, punk</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists2.png);"></figure><h6>Tame Impala</h6><p>indie</p></a></li>
                <li><a href="#" title="The Veronicas"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists3.png);"></figure><h6>The Veronicas</h6><p>pop, rock, punk</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists4.png);"></figure><h6>Tame Impala</h6><p>indie</p></a></li>
                <li><a href="#" title="The Veronicas"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists5.png);"></figure><h6>The Veronicas</h6><p>pop, rock, punk</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists6.png);"></figure><h6>Tame Impala</h6><p>indie</p></a></li>
                <li><a href="#" title="The Veronicas"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists7.png);"></figure><h6>The Veronicas</h6><p>pop, rock, punk</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists8.png);"></figure><h6>Tame Impala</h6><p>indie</p></a></li>
            </ul>
            <div class="view-all"><a href="#" title="View all" class="bg-gradient">View all</a></div>
        </div>
    </div>
</section>

<section class="merch-section">
    <div class="full-container d-flex">
        <div class="merch-innner">
            <figure><img src="https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/home-merch.svg" alt=""></figure>
            <h2>Support the cause, wear the merch.</h2>
            <div class="view-all"><a href="#" title="View all" class="bg-gradient">View all</a></div>
        </div>
        <div class="merch-detail">
            <ul class="artist-details">
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists9.png);"></figure><h6>Buska Hoodie</h6><p>$ 29.99</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists10.png);"></figure><h6>Buska Shirt</h6><p>$ 29.99</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists11.png);"></figure><h6>Buska</h6><p>pop, rock, punk</p></a></li>
                <li><a href="#" title="Tame Impala"><figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/artists12.png);"></figure><h6>Tame Impala</h6><p>indie</p></a></li>
            </ul>
        </div>              
    </div>
</section>

<section class="blog-home">
    <div class="full-container d-flex">
        <div class="blog-home-inner">
            <ul>
                <li>
                    <a href="#" class="d-flex" title="The current state of the music industry">
                        <figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/blog1.png);"></figure>
                        <div class="blog-title"><h6>The current state of the music industry</h6><p>by Mickle Lloyd, 21st of may</p></div>
                    </a>
                </li>
                <li>
                    <a href="#" class="d-flex" title="The current state of the music industry">
                        <figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/blog2.png);"></figure>
                        <div class="blog-title"><h6>The current state of the music industry</h6><p>by Mickle Lloyd, 21st of may</p></div>
                    </a>
                </li>
                <li>
                    <a href="#" class="d-flex" title="The current state of the music industry">
                        <figure class="bg-set" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/blog3.png);"></figure>
                        <div class="blog-title"><h6>The current state of the music industry</h6><p>by Mickle Lloyd, 21st of may</p></div>
                    </a>
                </li>
            </ul>
            <div class="view-all"><a href="#" title="View all" class="bg-gradient">View all</a></div>
        </div>
        <div class="home-recent-blog">
            <div class="blog-inner">
                <h2>Recent Blog.</h2>
                <div class="Blog-image">
                    <figure><img src="https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/recent-blog.svg" alt="recent blog"></figure>
                </div>        
            </div>          
        </div>              
    </div>
</section>

<section class="join-our-mission">
    <div class="full-container d-flex">
        <div class="about-mission">
            <figure><img src="https://staging.project-progress.net/projects/buska-nova/wp-content/themes/buska-nova/assets/images/frame.svg" alt="frame"></figure>
            <div class="about-title">
                <h2>Reach out to Join us on our Mission.</h2>
                <a href="#" title="about our mission">about our mission<svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 13" width="33" height="13"><style>tspan { white-space:pre }.shp0 { fill: #ffffff }</style><path id="Layer" fill-rule="evenodd" class="shp0" d="M26.04 0.64C26.24 0.45 26.56 0.45 26.76 0.64L32.85 6.41C32.95 6.5 33 6.62 33 6.75C33 6.88 32.95 7 32.85 7.09L26.76 12.86C26.56 13.05 26.24 13.05 26.04 12.86C25.84 12.67 25.84 12.37 26.04 12.18L30.4 8.05C30.54 7.91 30.59 7.71 30.51 7.53C30.43 7.35 30.25 7.23 30.04 7.23L1.01 7.23C0.73 7.23 0.5 7.02 0.5 6.75C0.5 6.48 0.73 6.27 1.01 6.27L30.04 6.27C30.25 6.27 30.43 6.15 30.51 5.97C30.59 5.79 30.54 5.59 30.4 5.45L26.04 1.32C25.84 1.13 25.84 0.83 26.04 0.64Z"></path>
                </svg></a>
            </div>
        </div>
        <div class="artist-fan">
            <div id="tabs">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">I am an artist</li>
                    <li class="tab-link" data-tab="tab-2">I am a fan</li>
                </ul>
                <div  id="tab-1" class="tab-content current"><?php echo do_shortcode('[contact-form-7 id="5" title="Artist form"]'); ?></div>
                <div  id="tab-2" class="tab-content"><?php echo do_shortcode('[contact-form-7 id="140" title="Fan Form"]'); ?></div>
            </div>
        </div>
    </div>
</section>


<div id="test-popup" class="white-popup mfp-hide">
  <h2>Popup content</h2>
  <p>Some text here..</p>
</div>

<?php
get_footer();
?>