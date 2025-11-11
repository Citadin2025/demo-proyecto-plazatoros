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

document.getElementById('contact-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    try {
        const formData = new FormData(e.target);
        const response = await fetch('./backEnd/api/api.php?url=contacto', {
            method: 'POST',
            body: formData,
            credentials: 'include'
        });

        const text = await response.text(); // read raw text first
        console.log('Raw response:', text);

        const res = JSON.parse(text);
        alert(res.message || 'Mensaje enviado correctamente.');
    } catch (err) {
        console.error('Error:', err);
        alert('Error al enviar el mensaje.');
    }
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