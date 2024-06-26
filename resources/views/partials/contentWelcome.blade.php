<style>
  /* Estilo para el carrusel */
  #carouselExampleSlidesOnly {
      margin: auto; /* Centra horizontalmente */
      width: 1800px; /* Establece un ancho fijo */
    }
    /* Estilo para las imágenes */
    .carousel-item img {
      width: 100%; /* Ajusta el ancho al 100% del contenedor */
      height: 600px; /* Para mantener la proporción original */
      margin-top: 120px;
    }
</style>
<body>
  <!-- Carousel -->
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('img/Empresas/E-postobon.png') }}" class="d-block img-fluid" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/Fanta.jpg') }}" class="d-block img-fluid" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/Coca-Cola-1.png') }}" class="d-block img-fluid" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/Empresas/E-redbull.png') }}" class="d-block img-fluid" alt="...">
      </div>
    </div>
    <!-- Controles de navegación -->
    <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- Card -->
  <div class="teaser content-card">
    <div class="container-fluid">
      <div class="row justify-content-center">
          <div class="col-md-4 mb-3 mt-3">
              <div class="card text-center">
                  <a href="/co/es/offerings/coke-studio" class="card-link" data-cmp-data-layer="...">
                      <img src="{{ asset('img/Empresas/E-postobon.png') }}" class="card-img-top img-fluid d-block" alt="...">
                      <div class="card-body text-black">
                          <h3 class="card-title">Postobón</h3>
                          <div class="card-text">
                              <p>{{ __('Spark your creativity. Discover our products in the store.') }}</p>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-md-4 mb-3 mt-3">
              <div class="card text-center">
                  <a href="/co/es/offerings/coke-studio" class="card-link" data-cmp-data-layer="...">
                      <img src="{{ asset('img/Empresas/E-redbull.png') }}" class="card-img-top img-fluid d-block" alt="...">
                      <div class="card-body text-black">
                          <h3 class="card-title">Red Bull</h3>
                          <div class="card-text">
                              <p>{{ __('Experience the magic of Red Bull energy.') }}</p>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
    </div>
  </div>
</body>
