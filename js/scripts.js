 //validacion de formulario de registro
	let email, password;		
		$('#btn-registro').on("click", function(e){
       
  		  let nombre = $("#nombre").val(),
			apellido = $("#apellido").val(),
			email = $("#emailUsuario").val(),
			password = $("#passUsuario").val(),
			datosUsuario = `Nombre: ${nombre}, Apellido: ${apellido}, Email: ${email} , Pass: ${password}`;

  	 if(!nombre || !apellido || !email || !password || password.length < 6){

  	     e.preventDefault();

  	     $('#errorName').html('<p style="color: red;">El nombre es requerido</p>');
  	     $('#errorApellido').html('<p style="color: red;">El apellido es requerido</p>');
  	     $('#errorEmail').html('<p style="color: red;">El email es requerido.</p>');
  	     $('#errorPass').html('<p style="color: red;">La contraseña es requerida y debe tener mas de 5 caracteres</p>');
  	     
  	 } else{

  	 	$('#errorName').html('');
  	     $('#errorApellido').html('');
  	     $('#errorEmail').html('');
  	     $('#errorPass').html('');
  	 }

  });


// BOTÓN SCROLL
document.addEventListener("DOMContentLoaded", function (e) {
	window.addEventListener("scroll", function (e) { // () => {}
        console.log("Vertical: " + window.pageYOffset);

           	if(window.pageYOffset > 600) {
               document.querySelector(".btn-scroll-top").classList.remove('hidden');
            } else {
               document.querySelector(".btn-scroll-top").classList.add('hidden');
            }
    });
// Al hacer click al botón
    document.addEventListener("click", function (e) {
        if(e.target.matches(".btn-scroll-top")) {
            e.preventDefault();
            window.scrollTo({
                behavior: "smooth",
                top: 0
            });
        }
    });
});


//POPOVER(descripcion del producto)
$(function () {
  $('[data-toggle="popover"]').popover()
});

//ALERT DISMISS
$('.alert').alert()


//CARRUSEL DE PRODUCTOS

$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();


    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});