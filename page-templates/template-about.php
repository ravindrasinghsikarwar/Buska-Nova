<?php
/**
 * Template Name: about
 *
*/
get_header();
?>



<div id="main" class="wrapper">
    <section class="about-main artist-banner">
        <div class="container d-flex">
            <div class="artist-banner-img column-6">
                <figure class="bg-set filter" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/uploads/2021/11/about2.png);"></figure>
            </div>
            <div class="counter-sec column-6">
                <div class="mobile-title">
                    <h2>Our Mission.</h2>
                    <p>by Mickle Lloyd, 21st of May</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-band about-details">
        <div class="container d-flex">
            <div class="band-title column-5">
                <h5>intro</h5>
            </div>
            <div class="band-details column-7">
                <h4>How it all started</h4>
                <p>Hilltop Hoods are an Australian hip hop group that formed in 1991 in Blackwood, Adelaide, South Australia. They are regarded as pioneers of the "larrikin-like" style of Australian hip hop. The group was founded by Suffa (Matthew David Lambert) and Pressure (Daniel Howe Smith), who were joined by DJ Debris (Barry John M. Francis) after fellow founder, DJ Next (Ben John Hare), left in 1999. The group released its first extended play, Back Once Again, in 1997 and have subsequently released eight studio albums, two "restrung" albums and three DVDs.</p>
                <p>Hilltop Hoods are an Australian hip hop group that formed in 1991 in Blackwood, Adelaide, South Australia. They are regarded as pioneers of the "larrikin-like" style of Australian hip hop. The group was founded by Suffa (Matthew David Lambert) and Pressure (Daniel Howe Smith), who were joined by DJ Debris (Barry John M. Francis) after fellow founder, DJ Next (Ben John Hare), left in 1999. The group released its first extended play, Back Once Again, in 1997 and have subsequently released eight studio albums, two "restrung" albums and three DVDs.</p>
            </div>
        </div>
    </section>


    <section class="get-ticket-section about-ticket">
        <div class="container d-flex">
            <div class="concert-details column-5">
                <h4>Future Plans</h4>
                <div class="concert-inner">
                    <p>Hilltop Hoods are an Australian hip hop group that formed in 1991 in Blackwood, Adelaide, South Australia. They are regarded as pioneers of the "larrikin-like" style of Australian hip hop. The group was founded by Suffa (Matthew David Lambert) and Pressure (Daniel Howe Smith), who were joined by DJ Debris (Barry John M. Francis) after fellow founder, DJ Next (Ben John Hare), left in 1999. The group released its first extended play, Back Once Again, in 1997 and have subsequently released eight studio albums, two "restrung" albums and three DVDs.</p>
                </div>
            </div>
            <div class="concert-img column-7">
                <figure class="bg-set filter" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/uploads/2021/11/about1.png);"></figure>
            </div>
        </div>
    </section>


    <section class="subscribe-follow about-subscibe">
        <div class="container d-flex">
            <div class="subscribe-image column-6">
                <figure class="bg-set filter" style="background-image: url(https://staging.project-progress.net/projects/buska-nova/wp-content/uploads/2021/11/about-3.png);"></figure>
            </div>        
            
            <div class="subscribe-mail column-6">
                <div class="subscribe-inner">
                    <?php echo (!empty($right_section_heading) ? '<h2>'.$right_section_heading.'</h2>' : ''); ?>
                    <?php if($subscription_form_id): ?>
                    <?php echo do_shortcode('[mailpoet_form id="'.$subscription_form_id.'"]'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

     <!-- add home page last section  -->

</div>




<!-- <div id="test-popup" class="white-popup mfp-hide">
  <h2>Popup content</h2>
  <p>Some text here..</p>
</div> -->

<?php
get_footer();
?>