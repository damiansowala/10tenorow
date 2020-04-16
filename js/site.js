   AOS.init();

   AOS.init({
       // Global settings:
       disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
       startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
       initClassName: 'aos-init', // class applied after initialization
       animatedClassName: 'aos-animate', // class applied on animation
       useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
       disableMutationObserver: false, // disables automatic mutations' detections (advanced)
       debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
       throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


       // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
       offset: 120, // offset (in px) from the original trigger point
       delay: 0, // values from 0 to 3000, with step 50ms
       duration: 400, // values from 0 to 3000, with step 50ms
       easing: 'ease', // default easing for AOS animations
       once: false, // whether animation should happen only once - while scrolling down
       mirror: false, // whether elements should animate out while scrolling past them
       anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

   });

   document.addEventListener('aos:in', ({
       detail
   }) => {
       console.log('animated in', detail);
   });

   document.addEventListener('aos:out', ({
       detail
   }) => {
       console.log('animated out', detail);
   });

   jQuery(document).ready(function ($) {


       var amount = document.getElementById("amount")
       if (amount != null) {
           amount.addEventListener("click", function () {
               val = $('#amount').val()
               total = $('#albumPrice span').html()
               courier = $('#courier span').html()
               courier = parseInt(courier, 10)
               sum = total * val
               res = sum + courier
               $("#price b").html(res)
               $("#cost").val(res)

           });
       }



       $('#list-tab a:first-child').tab('show') // Select first tab

       $('#carouselTenors').carousel()

       $('.acf-map').each(function () {
           var map = initMap($(this));
       });

       $(function () {
           $('[data-toggle="tooltip"]').tooltip();
       });
       $('img').unveil(-10, function () {
           $(this).load(function () {
               this.style.opacity = 1;
           });
       });
       $('.img-background').unveil(-10, function () {
           $(this).load(function () {
               this.style.opacity = 0.3;
           });
       });
       $(window).trigger("lookup");
       $("img").trigger("unveil");


       $("#carouselTenors li:first-child").addClass("active");
       $("#carouselTenors .carousel-item:first-child").addClass("active");
       $("#carouselExampleFade li:first-child").addClass("active");
       $("#carouselExampleFade .carousel-item:first-child").addClass("active");
       $('#road-tab li:first-child a').tab('show')
       $('#road-tabContent .tab-pane a:first-child').tab('show')

       $(".slider-comments").slick({
           slidesToShow: 1,
           slidesToScroll: 1,
           autoplay: true,
           autoplaySpeed: 5000,
       });

       $(".orhestra-instrumentalist").slick({
           slidesToShow: 6,
           arrows: false,
           slidesToScroll: 1,
           autoplay: true,
           autoplaySpeed: 1000,
           responsive: [{
                   breakpoint: 960,
                   settings: {
                       slidesToShow: 3,
                       slidesToScroll: 1,
                       infinite: true,
                       dots: true
                   }
               },
               {
                   breakpoint: 720,
                   settings: {
                       slidesToShow: 2,
                       slidesToScroll: 1
                   }
               },
               {
                   breakpoint: 576,
                   settings: {
                       slidesToShow: 3,
                       slidesToScroll: 1
                   }
               }
           ]
       });

       lightbox.option({
           resizeDuration: 100,
           wrapAround: true
       });


       $('#form-album').submit(function () {
           event.preventDefault();
           var form = $('#form-album');
           $.ajax({
               url: form.attr('action'),
               data: form.serialize(),
               type: form.attr('method'),
               dataType: "text",
               beforeSend: function (xhr) {

                   form.find('button').html('<i class="fas fa-spinner fa-pulse mr-2"></i> Wysyłanie');
               },
               success: function (data) {

                   form.find('button').html('<i class="fas fa-paper-plane mr-2" ></i> ' + data + '');

               },
               error: function (xhr) {
                   form.find('button').html('<i class="fas fa-search fa-pulse mr-2"></i> Błąd');
               }
           });
           return false;
       });


   })