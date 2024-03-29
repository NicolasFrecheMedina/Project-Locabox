// Effet index
var timeout;
$('#container').mousemove(function(e){
  if(timeout) clearTimeout(timeout);
  setTimeout(callParallax.bind(null, e), 200);
  
});

function callParallax(e){
  parallaxIt(e, '.slide_one', -2);
  parallaxIt(e, '.slide_two', 1);
  parallaxIt(e, '.slide_three', 10);
}

function parallaxIt(e, target, movement){
  var $this = $('#container');
  var relX = e.pageX - $this.offset().left;
  var relY = e.pageY - $this.offset().top;
  
  TweenMax.to(target, 2, {
    x: (relX - $this.width()/2) / $this.width() * movement,
    y: (relY - $this.height()/2) / $this.height() * movement,
    ease: Power2.easeOut
  })
}

//Carousel

const slider = document.querySelector(".items");
		const slides = document.querySelectorAll(".item");
		const button = document.querySelectorAll(".button-actu");

		let current = 0;
		let prev = 4;
		let next = 1;

		for (let i = 0; i < button.length; i++) {
			button[i].addEventListener("click", () => i == 0 ? gotoPrev() : gotoNext());
		}

		const gotoPrev = () => current > 0 ? gotoNum(current - 1) : gotoNum(slides.length - 1);

		const gotoNext = () => current < 4 ? gotoNum(current + 1) : gotoNum(0);

		const gotoNum = number => {
			current = number;
			prev = current - 1;
			next = current + 1;

			for (let i = 0; i < slides.length; i++) {
				slides[i].classList.remove("active");
				slides[i].classList.remove("prev");
				slides[i].classList.remove("next");
			}

			if (next == 5) {
				next = 0;
			}

			if (prev == -1) {
				prev = 4;
			}

			slides[current].classList.add("active");
			slides[prev].classList.add("prev");
			slides[next].classList.add("next");
		}

// Effet logo localiser
$("#container2").mousemove(function(e) {
    parallaxIt(e, ".slide_four", -70);
    parallaxIt(e, "img2", -30);
  });
  
  function parallaxIt(e, target, movement) {
    var $this = $("#container2");
    var relX = e.pageX - $this.offset().left;
    var relY = e.pageY - $this.offset().top;
  
    TweenMax.to(target, 1, {
      x: (relX - $this.width() / 2) / $this.width() * movement,
      y: (relY - $this.height() / 2) / $this.height() * movement
    });
  }

//Compteur simulateur

let btn_plus= $('.plus');
btn_plus.click(function(e){
  e.preventDefault();
  let input = $(this).parent().find('.nb');
  // console.log(input);
  let nb = input.val();
  nb = parseInt(nb) + 1;
  input.val(nb);
  calcul();
})

let btn_moins= $('.moins');
btn_moins.click(function(e){
  e.preventDefault();
  let input = $(this).parent().find('.nb');
  // console.log(input);
  let nb = input.val();
  if (nb>0) {
    nb = parseInt(nb) - 1;
    input.val(nb);
  calcul();
  }
  
})


function calcul() {
  let total_surface=0;
  let total_volume=0;
  $('.nb').each(function(index) {
    let surface =  $(this).parent().attr('data-surface');
    let volume = $(this).parent().attr('data-volume');
    let nb = $(this).parent().find('.nb').val() ;
    // console.log(surface);
    // console.log(volume);
    surface = parseFloat(surface);
    volume = parseFloat(volume);
    total_surface = total_surface + (surface * nb);
    total_volume = total_volume + (volume * nb);
    let test_surface = $('#input_surface')
    //  console.log(test);
    test_surface.val(total_surface);

    let test_volume = $('#input_volume')
    //  console.log(test_volume);
    test_volume.val(total_volume);
  })
  console.log(total_surface);
  // console.log(total_volume);
}
