/*
 * Change Navbar color while scrolling
*/

$(window).scroll(function () {
    handleTopNavAnimation();
});

$(window).load(async function () {
    handleTopNavAnimation();

    /*
    const els = {
        'fecha': document.getElementById('intro-fecha'),
        'titulo': document.getElementById('intro-titulo'),
        'descripcion': document.getElementById('intro-descripcion'),
        'link': document.getElementById('intro-link')
    };

    const data = await fetch('./backEnd/api/api.php?url=eventoRandom',
        {
            method: 'GET'
        }
    );
    const res = await data.json();

    els.fecha.innerHTML = res.response.fecha;
    els.titulo.innerHTML = res.response.nombre;
    els.descripcion.innerHTML = res.response.descripcion;
    els.link.href = res.response.linkDeCompra; */
});

function handleTopNavAnimation() {
    var top = $(window).scrollTop();

    if (top > 10) {
        $('#site-nav').addClass('navbar-solid');
    }
    else {
        $('#site-nav').removeClass('navbar-solid');
    }
}

/*
 * Registration Form
*/

$('#registration-form').submit(function (e) {
    e.preventDefault();

    var postForm = { //Fetch form data
        'fname': $('#registration-form #fname').val(),
        'lname': $('#registration-form #lname').val(),
        'email': $('#registration-form #email').val(),
        'cell': $('#registration-form #cell').val(),
        'address': $('#registration-form #address').val(),
        'zip': $('#registration-form #zip').val(),
        'city': $('#registration-form #city').val(),
        'program': $('#registration-form #program').val()
    };

    $.ajax({
        type: 'POST',
        url: './assets/php/contact.php',
        data: postForm,
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('#registration-msg .alert').html("Registration Successful");
                $('#registration-msg .alert').removeClass("alert-danger");
                $('#registration-msg .alert').addClass("alert-success");
                $('#registration-msg').show();
            }
            else {
                $('#registration-msg .alert').html("Registration Failed");
                $('#registration-msg .alert').removeClass("alert-success");
                $('#registration-msg .alert').addClass("alert-danger");
                $('#registration-msg').show();
            }
        }
    });
});

/*
 * SmoothScroll
*/

smoothScroll.init();

// Defensive: ensure FAQ accordion toggles correctly even if scripts load in odd order
; (function ($) {
    $(function () {
        // Only bind once
        if ($.fn.collapse && !window.__faqAccordionInitialized) {
            window.__faqAccordionInitialized = true;
            // Make sure clicking the panel title toggles via Bootstrap collapse
            $('.faq .panel-heading a[data-toggle="collapse"]').on('click', function (e) {
                var $this = $(this);
                var target = $this.attr('href');
                // let bootstrap handle the toggle; but ensure others close (accordion behavior)
                if ($(target).hasClass('in')) {
                    // it's open, let bootstrap close it
                } else {
                    // open this and close siblings (data-parent should handle it, but be explicit)
                    $('.panel-collapse.in').collapse('hide');
                }
            });
        }
    });
})(jQuery);