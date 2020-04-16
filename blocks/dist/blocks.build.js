jQuery(document).ready(function ($) {
  var image = document.getElementsByClassName('thumbnail');
  new simpleParallax(image);
  var amount = document.getElementById("amount");

  if (amount != null) {
    amount.addEventListener("click", function () {
      val = $('#amount').val();
      total = $('#albumPrice span').html();
      courier = $('#courier span').html();
      courier = parseInt(courier, 10);
      sum = total * val;
      res = sum + courier;
      $("#price b").html(res);
      $("#cost").val(res);
    });
  }

  $('img').unveil(100);
  $(".lb-outerContainer").on("contextmenu", function () {
    return false;
  });
  $("img").on("contextmenu", function () {
    return false;
  });
  $('.box-social li a').hover(function () {
    $(this).find("i").toggleClass('animated heartBeat');
  });
  $('.nav-social li a').hover(function () {
    $(this).find("i").toggleClass('animated heartBeat');
  });
  $('.nav-toggle').click(function () {
    $('.nav-menu').toggleClass('d-flex animated fadeInRightBig');
  });
  $('.nav-menu-close').click(function () {
    $('.nav-menu').toggleClass('d-flex animated fadeInRightBig');
  });
  $('button[data-target="#langMenu"]').click(function () {
    $('.lang-menu').toggleClass('d-flex');
  });
  $('.carousel-big').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.carousel-center-slide'
  });
  $('.carousel-center-slide').slick({
    centerMode: true,
    lazyLoad: 'progressive',
    centerPadding: '60px',
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    asNavFor: '.carousel-big',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    arrows: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }]
  });
  $('.carousel-event').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    arrows: false,
    asNavFor: '.carousel-center-events'
  });
  $('.carousel-center-events').slick({
    centerMode: true,
    centerPadding: '0px',
    slidesToShow: 7,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    asNavFor: '.carousel-event',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    arrows: true,
    responsive: [{
      breakpoint: 1200,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }]
  });
  $('.carousel-category').slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }]
  });
  $('.carousel-offer').slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }]
  });
  $('.gallery-carousel').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: '60px',
    arrows: true,
    responsive: [{
      breakpoint: 1200,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 4
      }
    }, {
      breakpoint: 992,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    }, {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }]
  });
  $('#filter').submit(function () {
    event.preventDefault();
    var filter = $('#filter');
    $.ajax({
      url: filter.attr('action'),
      data: filter.serialize(),
      type: filter.attr('method'),
      dataType: "html",
      beforeSend: function (xhr) {
        filter.find('button').html('<i class="fas fa-spinner fa-pulse"></i>');
      },
      success: function (data) {
        filter.find('button').html('<i class="fas fa-search mr-2"></i> OK');
        $('#eventsList').empty();
        $('#eventsList a').removeClass('animated fadeIn');
        $('#eventsList').append(data);
        $('#eventsList a').addClass('animated fadeIn');
      },
      error: function (xhr) {
        filter.find('button').html('<i class="fas fa-search fa-pulse"></i> Błąd');
      },
      complete: function (xhr) {
        filter.find('button').html('<i class="fas fa-search mr-2"></i> Wyszukaj');
        var events = $("#eventsList");

        if (events != null) {
          $('a[data-event="active"]').detach().prependTo("#eventsList");
        }
      }
    });
    return false;
  });
  $('#form-contact').submit(function () {
    event.preventDefault();
    var form = $('#form-contact');
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
  $('#form-stage').submit(function () {
    event.preventDefault();
    var form = $('#form-stage');
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
  $('#form-info').submit(function () {
    event.preventDefault();
    var form = $('#form-info');
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
  $('#form-offer-1').submit(function () {
    event.preventDefault();
    var form = $('#form-offer-1');
    $.ajax({
      url: form.attr('action'),
      data: form.serialize(),
      type: form.attr('method'),
      dataType: "text",
      beforeSend: function (xhr) {
        form.find('button').html('<i class="fas fa-spinner fa-pulse mr-2"></i> Zamawianie');
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
  $('#form-offer-2').submit(function () {
    event.preventDefault();
    var form = $('#form-offer-2');
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
  $('#form-offer-3').submit(function () {
    event.preventDefault();
    var form = $('#form-offer-3');
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
  $('#work').submit(function () {
    event.preventDefault();
    var form = $('#work');
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
  $('#cooperation').submit(function () {
    event.preventDefault();
    var form = $('#cooperation');
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
  var events = $("#eventsList");

  if (events != null) {
    $('a[data-event="active"]').detach().prependTo("#eventsList");
  }
});
//# sourceMappingURL=blocks.build.js.map
