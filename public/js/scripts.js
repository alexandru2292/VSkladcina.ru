svg4everybody(); // support inline svg

$(document).ready(function() {
	
	
	var user = detect.parse(navigator.userAgent);
	$("html").addClass(user.browser.family);
	$("html").addClass(user.os.family);
	$("html").addClass(user.device.type);
	
	if ($('.scroll-pane').length){
		$('.scroll-pane').jScrollPane({
			 autoReinitialise: true
		 });
	}
	
	
	// window resize
	function windowSize(){
			var w = $(window).width();
			
			if ($('.categories__subcategories').length){
		
				var heightCategories = 0;

				$('.categories__subcategories').each(function() {
				
					if (heightCategories < $(this).height()){
						heightCategories = $(this).height();
						
					}
					
				});
				
				if (w >= 768){
					$(".categories").height(heightCategories); 
				}
				else{
					$(".categories").removeAttr("style");
				}
				
				
				
				
				
			}
			
			if ($("html").hasClass("Mobile")){
				if ($( ".datepicker" ).length){
					$( ".datepicker" ).datepicker( "destroy" ).attr("type", "date").removeAttr("readonly").css("width", "auto");
				}
				
			} 
			
			if (w >= 992){
				$(".sidebar-toggle__content").removeAttr("style");
				$(".sidebar-toggle__btn-toggle").addClass("active");
			}
			
			 var scrollPane = $('.scroll-pane');
			 if (scrollPane.length){
				 var api = scrollPane.data('jsp');
				api.reinitialise({
				 autoReinitialise: true
				});
			 }
			 
			
			
	}
	windowSize();
	$(window).on('resize', windowSize); 
	
	// select
	
	$('.selectpicker').selectpicker({
		mobile: true
	});
	
	
	// search clear
	$('.search__btn-clear').on('click', function(e) {
		var $this = $(this);
		$this.addClass("active");
		$this.closest(".search").find(".search__input").val("");
		setTimeout(function(){
			$this.removeClass("active");
		}, 300);
	});
	
	
	// fancybox
	
	$("[data-fancybox]").fancybox({
		 animationEffect: "fade",
		 buttons: [
			 "close"
		  ],
		 beforeShow : function( instance, current ) {
			$(".connection-btn").addClass("compensate-for-scrollbar");
		},
		 afterClose : function( instance, current ) {
			$(".connection-btn").removeClass("compensate-for-scrollbar");
		}
	});
	
	$('.select-category__link').fancybox({
		buttons: false,
	});
	
	
	// menu 
	 
	$('.menu__dropdown-link').on('click', function(e) {
		e.preventDefault();
		$(this).next().toggleClass("active");
		$(this).toggleClass("active");
	});
	
	// toggle menu
	 
	$('.header__menu-toggle').on('click', function(e) {
		e.preventDefault();
		$(".header__menu").toggleClass("active");
	});
	
	$('.header__menu-toggle-mobile').on('click', function(e) {
		e.preventDefault();
		$(".menu-mobile").addClass("active");
		$("body").addClass("overflow-hidden");
	});
	
	$('.menu-mobile__btn-close').on('click', function(e) {
		e.preventDefault();
		$(".menu-mobile").removeClass("active");
		$("body").removeClass("overflow-hidden");
	});
	
	// toggle filters
	 
	$('.filters-btn-toggle').on('click', function(e) {
		e.preventDefault();
		$(".filters").addClass("active");
		$("body").addClass("overflow-hidden");
	});
	
	$('.filters__btn-close').on('click', function(e) {
		e.preventDefault();
		$(".filters").removeClass("active");
		$("body").removeClass("overflow-hidden");
	});
	
	// tabs
	$('[data-toggle="tabs"] > li > a').on('click', function(e) {
		e.preventDefault();
		var tabIndex = $(this).parent().index(),
			 tabPane = $(this).closest('.tabs').children(".tab-content").children(".tab-pane");
		
		$(this).parent().siblings().removeClass("active");
		tabPane.removeClass("active");
		
		$(this).parent().addClass("active");
		tabPane.eq(tabIndex).addClass("active");
		
	});
	
	// top filters
	$('.top-filters__menu a').on('click', function(e) {
		$(this).parent().siblings().removeClass("active");
		$(this).parent().addClass("active");
		
		
	});
	
	// input answer 
	$('.comment-answer__input').on('focus', function(e) {
		$(this).addClass("comment-answer__input--active");
	});
	// input comment rating
	$('.rating__input').on('focus', function(e) {
		$(this).addClass("rating__input--active");
	});
	
	// messages menu 
	$('.message-menu__item').on('click', function(e) {
		e.preventDefault();
		
		
		//
		
		if (!$(e.target).hasClass("message-menu__item-btn-remove")){
			var tabIndex = $(this).index(),
			 tabPane = $(".tabs--messages").find(".tab-pane");
		
			$(this).siblings().removeClass("active");
			tabPane.removeClass("active");
			
			$(this).addClass("active");
			tabPane.eq(tabIndex).addClass("active");
			
			 if ($('.scroll-pane').length){
				var scrollPane = $('.scroll-pane');
				var api = scrollPane.data('jsp');
				api.reinitialise({
					autoReinitialise: true
				});
				 
			 }
			 
			 $(this).closest(".sidebar__box--panel").removeClass("active");
		}
		
	});
	
	
	var indexMsgRemove = 0;
	
	$('.message-menu__item-btn-remove').on('click', function(e) {
		indexMsgRemove = $(this).closest(".message-menu__item").index();
	});
	
	$('.btn-remove-message').on('click', function(e) {
		msgItem = $(".message-menu__item").eq(indexMsgRemove);
		tabItem = $(".tabs--messages .tab-pane").eq(indexMsgRemove);
		
		if (msgItem.hasClass("active")){
			msgItem.next().addClass("active");
			tabItem.next().addClass("active");
		}
		
		msgItem.remove();
		tabItem.remove();
		
		if (!$('.message-menu__item').length){
			$(".content-messages").addClass("hidden");
			$(".message-missing").removeClass("hidden");
		}
		
	});
	
	// categories menu 
	$('.categories__menu > li > a').on('click', function(e) {
		e.preventDefault();
		
		var w = $(window).width(),
			 $this = $(this);
		
		if (w <= 767){
			
		
			$this.parent().siblings().removeClass("active");
			
			if ($this.parent().hasClass("active")){
				$this.parent().removeClass("active");
			}
			else{
				$this.parent().addClass("active");
				setTimeout(function(){
					$(".fancybox-slide").animate({scrollTop: $this.position().top - 10}, 500);
				}, 50);
			}
		}
		
	});
	
	$('.categories__menu > li > a').on('mouseenter', function(e) {
		
		var w = $(window).width(),
			 $this = $(this);
		
		if (w > 767){
			$this.parent().siblings().removeClass("active");
			$this.parent().addClass("active");
		}
		
	});
	

	
	// datepicker
	if ($(".datepicker").length){
	$(".datepicker").each(function(){
		
			$.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
			
			$(this).datepicker({
				
				showOtherMonths: true,
				dateFormat: "dd.mm.yy",
				onSelect: function(dateText, inst) { 
				
					//
				}
			});
		});
	}
	$(".datepicker").on("focus", function(){
		$(this).parent().addClass("active");
	});
	$(".datepicker").on("blur", function(){
		$(this).parent().removeClass("active");
	});
	
	
	// toggle sidebar
	$(".sidebar-toggle__btn-toggle").on('click', function(e) {
		e.preventDefault();
		$(this).prev().slideToggle(300);
		$(this).toggleClass("active");
		
		
	});
	
	// toggle sidebar left panel
	$(".sidebar__btn-toggle").on('click', function(e) {
		e.preventDefault();
		$(this).parent().toggleClass("active");
		
		
	});
	
	// popup authorization
	if ($(".popup-authorization.active").length){
		$.fancybox.open({
			src  : '#popup-authorization',
			type : 'inline',
			opts : {
				 animationEffect: "fade",
				 buttons: [
					 "close"
				  ],
				 beforeShow : function( instance, current ) {
					$(".connection-btn").addClass("compensate-for-scrollbar");
				},
				 afterClose : function( instance, current ) {
					$(".connection-btn").removeClass("compensate-for-scrollbar");
				}
			}
		});
	}
	
	// ui slider
	if ($(".slider").length){
		 $( ".slider" ).each(function(){
			 var $this = $(this),
				  handle = $this.find(".slider__value span"),
				  sliderValue = parseInt($this.attr("data-value")),
				  sliderValueMin = parseInt($this.attr("data-value-min")),
				  sliderValueMax = parseInt($this.attr("data-value-max"));
				  
			 $this.slider({
				 range: "max",
				value: sliderValue,
				min: sliderValueMin,
				max: sliderValueMax,
				create: function() {
				  handle.text( $( this ).slider( "value" ) );
				},
				slide: function( event, ui ) {
				  handle.text( ui.value );
				}
			 });
		 });
	}
	
	
	// rating
	 $( ".stars--select .star-item" ).on("mouseenter", function(e){
		 var $this = $(this);
		 $this.addClass("star-item--hover");
		 $this.prevAll().addClass("star-item--hover");
	 });
	 $( ".stars--select .star-item" ).on("mouseleave", function(e){
		 var $this = $(this);
		 $this.removeClass("star-item--hover");
		 $this.siblings().removeClass("star-item--hover");
	 });
	
	 $( ".stars--select .star-item" ).on("click", function(e){
		 var $this = $(this);
		 $this.addClass("star-item--active");
		 $this.prevAll().addClass("star-item--active");
		 $this.nextAll().removeClass("star-item--active");
	 });
	 
	 
	 $( ".rating .checkbox" ).on("change", function(e){
		 var ratingStars = $(this).closest(".rating__row").find(".rating__stars");
		 if (!$(this).prop("checked")){
			 ratingStars.addClass("disabled");
		 }
		 else{
			 ratingStars.removeClass("disabled");
		 }
		 
	 });
	
	// spinner
	$( ".spinner" ).spinner({
		min: 1,
		classes: {
		 "ui-spinner": "highlight"
	  }
	});
	
	function checkSelect(){
		$(".form-show").find(".selectpicker-check").each(function(){
			var formHidden = $(this).closest(".form-show").next();
			formHidden.removeClass("show");
			 if(!$(this).find("option:selected:not(.bs-title-option)").length){
				 return false;
			 }
			formHidden.addClass("show");
		});
	};
	
	checkSelect();
	
	// check select category
	$(".selectpicker-check").on("change", function(){
		checkSelect();
	});
	
	// select description 
	function showSelectDesc(){
		$(".form-item .selectpicker").each(function(){
			
			 if($(this).find('option[data-description]').length){
				 $(this).closest(".bootstrap-select").next().remove();
			 }
			 
			 if($(this).find('option[data-description]:selected').length){
				 $(this).closest(".bootstrap-select").after('<div class="form-item__text">' + $(this).find('option').attr("data-description") + '</div>');
			 }
		});
	}
	
	showSelectDesc();
	
	$(".selectpicker").on("change", function(){
		showSelectDesc();
	});
	
	
	
	// click document
	
	$(document).on('click', function(e) {
	
		var menu = '.menu',
			 menuSubmenu = '.menu__submenu',
			 menuMobile = '.menu-mobile',
			 menuBtnToggle = '.menu__dropdown-link';
		
		var headerMenu = '.header__menu',
			 headerMenuBtnToggle = '.header__menu-toggle';
		
		var leftPanel = '.sidebar__box--panel';
			 
		if (!$(menu).is(e.target)
		&& $(e.target).closest(menu).length === 0
		&& !$(menuMobile).is(e.target)
		&& $(e.target).closest(menuMobile).length === 0
		&& !$(menuBtnToggle).is(e.target)
		&& $(e.target).closest(menuBtnToggle).length === 0){
			$(menuSubmenu + ", " + menuBtnToggle).removeClass("active");
		}
		
		if (!$(headerMenu).is(e.target)
		&& $(e.target).closest(headerMenu).length === 0 
		&& !$(headerMenuBtnToggle).is(e.target)
		&& $(e.target).closest(headerMenuBtnToggle).length === 0){
			$(headerMenu).removeClass("active");
		}
		
		if (!$(leftPanel).is(e.target)
		&& $(e.target).closest(leftPanel).length === 0){
			$(leftPanel).removeClass("active");
		}
		
	}); 
	
	
	// phone mask
	// $('.phone-mask').mask('0 (000) 000-00-00', {clearIfNotMatch: true});
	
	
	// validation
	
		jQuery.validator.setDefaults({
			messages: {
				 name: {
					 required: "Введите имя."
				 },
				 email: {
					 required: "Введите почту.",
					 email: "Не верно введена почта."
				 },
				 message: {
					 required: "Введите сообщение."
				 },
				 password: {
					 required: "Введите пароль."
				 },
				password_confirmation: {
					 required: "Введите пароль."
				 }
			 }
		});
	
	 $(".form-validate").each(function(){
		 
		 var $this = $(this);
		 
		 $this.validate({
			 /*submitHandler: function(form) {
				
			}*/
		 });
		 
	 });
	
	
	
	
});
