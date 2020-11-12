$(document).ready(function(){
  $('.slick').slick({
	  dots: false,
	  infinite: true,
	  speed: 300,
	  slidesToShow: 6,
	  slidesToScroll: 6,
	  focusOnSelect:false,
	  draggable: false,
	  swipe: false,
	  touchMove: false,
	  useCSS: false,
	  useTransform: false,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 6,
	        slidesToScroll: 6,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 6,
	        slidesToScroll: 6
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 6,
	        slidesToScroll: 6
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});
});

const inputs = document.querySelectorAll(".form-input");

const errInputs = document.querySelectorAll(".form-input");



function addcl(){
	let parent = this.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}

function remer(){
	let parent = this.parentNode;
	if(this.value != ""){
		parent.classList.remove("err");
		parent.getElementsByClassName("form-label")[0].classList.remove("hidden");
		parent.getElementsByClassName("form-label-err")[0].classList.add("hidden");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

errInputs.forEach(input => {
	input.addEventListener("blur", remer);
});

