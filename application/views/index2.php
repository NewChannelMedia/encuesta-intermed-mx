<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top Flama">
  <div class="row upper-row">
    <div class="container">
      <p class="pull-right">
        Atención y contacto: 52 (33) 3125-2200
      </p>
    </div>
  </div>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand navbar-brand-intermed" >
        <a class="page-scroll" href="#page-top"><img src="<?=base_url()?>img/logos/intermed.png"></a>
      </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<form role="form" method="POST" action="<?php echo base_url(); ?>about">
      <ul class="nav navbar-nav navbar-right">
        <li class="hidden">
          <a href="#page-top"></a>
        </li>
        <li>
          <input type="text" class="form-control"
           placeholder="Introduce el código de tu encuesta" name="codigo">
        </li>
        <li>
          <button type="submit" class="btn btn-default">Enviar</button>
        </li>
      </ul>
</form>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
  <div class="container">
    <div class="intro-text">
      <div class="intro-lead-in Flama">Bienvenido a <strong>Intermed<sup>&reg;</sup></strong></div>
      <div class="intro-heading">.</div>
      <a href="#services" class="page-scroll btn btn-xl">.</a>
    </div>
  </div>
</header>

<!-- Services Section -->
<section id="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">encabezado</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
      </div>
    </div>
  </div>
</section>

<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">encabezado 2</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">otro</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section id="team" class="bg-light-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">Ultimo</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 text-center">
        <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
      </div>
    </div>
  </div>
</section>

<!-- Clients Aside -->
<aside class="clients">
  <div class="container">
    <div class="row">
    </div>
  </div>
</aside>

<!-- Contact Section -->
<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">Contact Us</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form name="sentMessage" id="contactForm" novalidate>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 text-center">
              <div id="success"></div>
              <button type="submit" class="btn btn-xl">Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <span class="copyright">Copyright &copy; Your Website 2014</span>
      </div>
      <div class="col-md-4">
        <ul class="list-inline social-buttons">
          <li><a href="#"><i class="fa fa-twitter"></i></a>
          </li>
          <li><a href="#"><i class="fa fa-facebook"></i></a>
          </li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul class="list-inline quicklinks">
          <li><a href="#">Privacy Policy</a>
          </li>
          <li><a href="#">Terms of Use</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->

<!-- Portfolio Modal 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body">
            <!-- Project Details Go Here -->
            <h2>Project Name</h2>
            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            <img class="img-responsive img-centered" src="img/portfolio/roundicons-free.png" alt="">
            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae,
              nostrum, reiciendis facere nemo!</p>
            <p>
              <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set
              <a
              href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
            <ul class="list-inline">
              <li>Date: July 2014</li>
              <li>Client: Round Icons</li>
              <li>Category: Graphic Design</li>
            </ul>
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio Modal 2 -->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body">
            <h2>Project Heading</h2>
            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            <img class="img-responsive img-centered" src="img/portfolio/startup-framework-preview.png" alt="">
            <p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated
              into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
            <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio Modal 3 -->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body">
            <!-- Project Details Go Here -->
            <h2>Project Name</h2>
            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            <img class="img-responsive img-centered" src="img/portfolio/treehouse-preview.png" alt="">
            <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio Modal 4 -->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body">
            <!-- Project Details Go Here -->
            <h2>Project Name</h2>
            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            <img class="img-responsive img-centered" src="img/portfolio/golden-preview.png" alt="">
            <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best
              PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio Modal 5 -->
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body">
            <!-- Project Details Go Here -->
            <h2>Project Name</h2>
            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            <img class="img-responsive img-centered" src="img/portfolio/escape-preview.png" alt="">
            <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one
              page solution to describe your business and offer your services.</p>
            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio Modal 6 -->
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body">
            <!-- Project Details Go Here -->
            <h2>Project Name</h2>
            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
            <img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">
            <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap
              framework in mind.</p>
            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
