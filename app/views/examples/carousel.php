<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Simple Carousel</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="1500">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

              <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/images/slide1.png" alt="Slide 1" class="img-responsive"">
                    <div class="carousel-caption">
                    <h3>Slide 1</h3>
                    <p>The description of slide 1</p>
                    </div>
                </div>
                <div class="item">
                    <img src="/images/slide2.png" alt="Slide 2">
                    <div class="carousel-caption">
                    <h3>Slide 2</h3>
                    <p>The description of slide 2</p>
                </div>
                </div>
                <div class="item">
                    <img src="/images/slide3.png" alt="Slide 3">
                    <div class="carousel-caption">
                    <h3>Slide 3</h3>
                    <p>The description of slide 3</p>
                    </div>
                </div>
            </div>

              <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Example borrowed from bootstrap docs, <a href="http://getbootstrap.com/javascript/#carousel">http://getbootstrap.com/javascript/#carousel</a></p>
      </div>
    </div>
</div>
