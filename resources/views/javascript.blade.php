<script>
    $(document).ready(function() {
		SUPER.set_role_access(<?php echo $roles?>);
		// Get the previous URL from localStorage
		var previousURL = localStorage.getItem('previousURL');
		// Get the current URL
		var currentURL = window.location.href;
		// Check if the page has already been loaded
		if (!localStorage.getItem('pageLoaded') || previousURL && previousURL === currentURL) {
			// Code to be executed for the first page load
			$(document).ajaxStart(function() {	
			});
			$(document).ajaxComplete(function() {
			  	// $('html, body').animate({scrollTop:0}, 'fast');
			});
			blockPage();
			$.ajax({
			    url: "{{ route('loadpage') }}",
                data: {
                    destination: 'dashboard',
                    "_token": "{{ csrf_token() }}",
                },
			    type: 'POST',
				success: function(data) {
					var base64 = data.base64;
        			var decoded = atob(base64);
				    $('.endsss').text('Dashboard');
					$('#ttl').text('Otomotif Solusi | Dashboard');
					$('.kt-subheader__title').text('Dashboard');
					$('#target').html(decoded);
					loadSidebar();
					unblockPage();
					$('html, body').animate({scrollTop:0}, 'fast');
				}
			});
			// Set a flag in localStorage to indicate that the page has been loaded
			localStorage.setItem('pageLoaded', 'true');
			localStorage.setItem('previousURL', currentURL);
		}
	});

	var role_access = [];

	function loadSidebar(element = null){
		blockPage();
		var page = '';
		var nama = '';
		var id = '';
		var startpage = '';
		if(element == null){
			page = 'dashboard';
			nama = 'Dashboard';
			id = 'A001';
			startpage = 'start';
		}else{
			page = element.getAttribute('data-page');
			nama = element.getAttribute('data-name');
			id = element.getAttribute('data-id');
			startpage = 'next';
		}
		event.preventDefault();
		console.log(id);
		$.ajax({
			url: "{{ route('sidebar_panel') }}",
			data: {
                menu_id: id,
				startpage: startpage,
                "_token": "{{ csrf_token() }}",
            },
			type: 'POST',
			success: function(data){
				var base64 = data.html;
				var base64_misc = data.misc;
				var decoded = atob(base64);
				var decoded_misc = atob(base64_misc);
				if(element !== null){
					$('#target').empty();
					// Pembatas atas
					$('.newww').show();
					$('.endsst').text(nama);
					$('.endsss').hide();
					$('.pagel').hide();

					$('#ttl').text('Otomotif Solusi | ' + nama);
					$('.kt-subheader__title').text(nama);
					$('#kt_aside_menu').empty();
					$('#kt_aside_menu').html(decoded);
					// var lists = data.list;
					// $.each(lists, function(index, value) {
					// 	// Create a button element for each item in the array
					// 	var button = $('<button class="btn btn-elevate btn-brand" style="margin-left: 2px !important">').text(value);
					// 	// Append the button to the container
					// 	$('#target').append(button);
					// });
					$('#target').html(decoded_misc);
					$('html, body').animate({scrollTop:0}, 'fast');
				}else{
					$('#kt_aside_menu').empty();
					$('#kt_aside_menu').html(decoded);
					$('.kt-subheader__title').text('Dashboard');

					$('.endsss').hide();
					$('.pagel').hide();
					$('.newww').hide();

					$('html, body').animate({scrollTop:0}, 'fast');
				}
				unblockPage();
			},
			error: function(xhr, status, error) {
                if (xhr.status === 419 || xhr.status === 401) {
                    // window.location.reload();
					Swal.fire({
						title: 'Gagal',
						text: 'Sesi telah berakhir',
						type: 'error',
					});
                    setLogout();
                }else if(xhr.status === 404){
					$('#target').empty();
					$('.endsss').text(nama);
					$('#ttl').text('Otomotif Solusi | ' + nama);
					var html = '<div class="kt-grid kt-grid--ver kt-grid--root"><div class="kt-error404-v1"><div class="kt-error404-v1__content"><div class="kt-error404-v1__title">404</div><div class="kt-error404-v1__desc"><strong>OOPS!</strong> Halaman tidak ditemukan.</div></div><div class="kt-error404-v1__image"><img src="theme/assets/media/misc/404-bg1.jpg" style="height: 100px;" class="kt-error404-v1__image-content" alt="" title="" /></div></div></div>';
					$('#target').html(html);
					$('html, body').animate({scrollTop:0}, 'fast');
					unblockPage();
				}else if(xhr.status === 502){
					window.location.reload();
				}
            }
		});
		var lis = document.querySelectorAll(".kt-menu__nav li");
		for (var i = 0; i < lis.length; i++) {
			lis[i].classList.remove("kt-menu__item--active");
			var parentMenu = lis[i].closest(".kt-menu__item");
			if (parentMenu && parentMenu.contains(element.parentNode)) {
				// Menu is a child of another menu, do not remove "open" and "here"
			} else {
				lis[i].classList.remove("kt-menu__item--open");
				lis[i].classList.remove("kt-menu__item--here");
			}
		}
		element.parentNode.classList.add("kt-menu__item--active");
	}

    function loadPage(element){
		blockPage();
        let page = element.getAttribute('data-page');
		let nama = element.getAttribute('data-name');
        event.preventDefault();
        var urls = '/'+page;
        console.log(page);
        $.ajax({
            url: "{{ route('loadpage') }}",
            data: {
                destination: page,
                "_token": "{{ csrf_token() }}",
            },
            type: 'POST',
            success: function(data) {
				var base64 = data.base64;
        		var decoded = atob(base64);
				$.when(function(){
					$('#target').empty();

					$('.newww').show();
					$('.endsss').show();
					$('.pagel').show();
					$('.endsss').text(nama);

					$('#ttl').text('Otomotif Solusi | ' + nama);
					$('.kt-subheader__title').text(nama);
					$('#target').html(decoded);
					$('html, body').animate({scrollTop:0}, 'fast');
				}()).then(function(){
					var container = $("#target");
					$.each($('[data-roleable=true]',container),function(i,v){
						if ($(v).data('role') != 'undefined' && $(v).data('role') != '') {
							var roles = $(v).data('role').split('|')
							var checkRole = true;
							$.each(roles, function(iR, vR) {
								if (SUPER.get_role_access(vR)) {
									checkRole = false;
								}
							});
							if (checkRole) {
								if ($(v).data('action') != 'undefined' && $(v).data('action') == 'hide') {
									$(v).hide()
								}else{
									$(v).remove()
								}
							}
						}
					})
				}()).then(function(){
					$("#target").css('visibility','visible');
					unblockPage();
				}())
            },
            error: function(xhr, status, error) {
                if (xhr.status === 419 || xhr.status === 401) {
                    // window.location.reload();
					Swal.fire({
						title: 'Gagal',
						text: 'Sesi telah berakhir',
						type: 'error',
					});
                    setLogout();
                }else if(xhr.status === 404){
					$('#target').empty();
					$('.endsss').text(nama);
					$('#ttl').text('Otomotif Solusi | ' + nama);
					var html = '<div class="kt-grid kt-grid--ver kt-grid--root"><div class="kt-error404-v1"><div class="kt-error404-v1__content"><div class="kt-error404-v1__title">404</div><div class="kt-error404-v1__desc"><strong>OOPS!</strong> Halaman tidak ditemukan.</div></div><div class="kt-error404-v1__image"><img src="theme/assets/media/misc/404-bg1.jpg" style="height: 100px;" class="kt-error404-v1__image-content" alt="" title="" /></div></div></div>';
					$('#target').html(html);
					$('html, body').animate({scrollTop:0}, 'fast');
					unblockPage();
				}else if(xhr.status === 502){
					window.location.reload();
				}
            }
        });
		var lis = document.querySelectorAll(".kt-menu__nav li");
		for (var i = 0; i < lis.length; i++) {
			lis[i].classList.remove("kt-menu__item--active");
			var parentMenu = lis[i].closest(".kt-menu__item");
			if (parentMenu && parentMenu.contains(element.parentNode)) {
				// Menu is a child of another menu, do not remove "open" and "here"
			} else {
				lis[i].classList.remove("kt-menu__item--open");
				lis[i].classList.remove("kt-menu__item--here");
			}
		}
		element.parentNode.classList.add("kt-menu__item--active");
    }

    function setLogout(){
		$(document).ajaxStart(function() {
		});
		$(document).ajaxComplete(function() {
			localStorage.removeItem('pageLoaded');
		});
		blockPage();
		$.ajax({
			url: '{{ route('logout') }}',
            data: {
                "_token": "{{ csrf_token() }}",
            },
			type: 'POST',
			success: function(response) {
				unblockPage();
				// window.location.href = "/index";
                window.location.href = "{{ url('/') }}";
			}
		});
	}

    $('.flaticon-logout').click(function(e) {
        swal.fire({
            title: 'Apa Anda yakin?',
            text: "Anda akan keluar dari aplikasi ini",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal',
        }).then(function(result) {
            if (result.value) {
                setLogout();
            }
        });
    });

	function blockPage(time = null){
		KTApp.blockPage({
			overlayColor: '#000000',
			type: 'v2',
			state: 'primary',
			message: 'Sedang memproses data, mohon menunggu...'
		});
	}

	function unblockPage(){
		KTApp.unblockPage();
	}

	$.fn.serializeObject = function(){
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};

	var SUPER = function(){
    
		return {

			destroyData : function(config){
				config = $.extend(true, {
					id      : null,
					route	: null,
					callback: function(res) {}
				}, config);
				var id = config.id;
				Swal.fire({
					title: 'Peringatan',
					text: 'Anda akan menghapus data. Anda yakin untuk menghapus ?',
					type: 'warning',
					confirmButtonText: '<i class="fa fa-check"></i> Ya',
					confirmButtonClass: 'btn btn-focus btn-success m-btn m-btn--pill m-btn--air',
					reverseButtons: false,
					showCancelButton: true,
					cancelButtonText: '<i class="fa fa-times"></i> Tidak',
					cancelButtonClass: 'btn btn-focus btn-danger m-btn m-btn--pill m-btn--air'
				}).then(function(result) {
					if (result.value === true) {
						blockPage();
						$.ajax({
							url: config.route,
							type: 'DELETE',
							data:{
								id: id,
							},
							headers: {
								'X-CSRF-TOKEN': '{{ csrf_token() }}'
							},
							success: function(lar){
								if(lar.success == true){
									Swal.fire({
										title: 'Sukses',
										text: 'Penghapusan data sukses !',
										type: 'success',
									});
									unblockPage();
								}else{
									Swal.fire({
										title: 'Batal',
										text: 'Penghapusan data gagal !',
										type: 'error',
									});
									unblockPage();
								}
								onRefresh();
							}
						});
					}else if(result.dismiss === 'cancel'){
						Swal.fire({
							title: 'Batal',
							text: 'Penghapusan data dibatalkan',
							type: 'error',
						});
					}else{
						Swal.fire({
							title: 'Batal',
							text: 'Penghapusan data gagal !',
							type: 'error',
						});
					}
				});
			},

			initChart : function(config) {

				config = $.extend(true, {
					el      : null,
					labels  : {},
					data    : {},
					naming  : null,
					// Setelan
					maximum : null,
					step : null,
					zero : true,
					callback: function(res) {}
				}, config);

				if (!document.getElementById(config.el)) {
					return;
				}
				var color = Chart.helpers.color;
				var barChartData = {
					labels: config.labels,
					datasets: [{
						label: config.naming,
						backgroundColor: color(KTApp.getStateColor('brand')).alpha(1).rgbString(),
						borderWidth: 0,
						data: config.data,
					}]
				};

				var ctx = document.getElementById(config.el).getContext('2d');
				var myBar = '';
				if(myBar){
					myBar.destroy();
					myBar = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: false,
							scales: {
								xAxes: [{
									categoryPercentage: 0.35,
									barPercentage: 0.70,
									display: true,
									scaleLabel: {
										display: false,
										labelString: 'Month'
									},
									gridLines: false,
									ticks: {
										display: true,
										beginAtZero: true,
										fontColor: KTApp.getBaseColor('shape', 3),
										fontSize: 13,
										padding: 10
									}
								}],
								yAxes: [{
									categoryPercentage: 0.35,
									barPercentage: 0.70,
									display: true,
									scaleLabel: {
										display: false,
										labelString: 'Value'
									},
									gridLines: {
										color: KTApp.getBaseColor('shape', 2),
										drawBorder: false,
										offsetGridLines: false,
										drawTicks: false,
										borderDash: [3, 4],
										zeroLineWidth: 1,
										zeroLineColor: KTApp.getBaseColor('shape', 2),
										zeroLineBorderDash: [3, 4]
									},
									ticks: {
										max: config.maximum,                            
										stepSize: config.step,
										display: true,
										beginAtZero: config.zero,
										fontColor: KTApp.getBaseColor('shape', 3),
										fontSize: 13,
										padding: 10
									}
								}]
							},
							title: {
								display: false
							},
							hover: {
								mode: 'index'
							},
							tooltips: {
								enabled: true,
								intersect: false,
								mode: 'nearest',
								bodySpacing: 5,
								yPadding: 10,
								xPadding: 10, 
								caretPadding: 0,
								displayColors: false,
								backgroundColor: KTApp.getStateColor('brand'),
								titleFontColor: '#ffffff', 
								cornerRadius: 4,
								footerSpacing: 0,
								titleSpacing: 0
							},
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 5,
									bottom: 5
								}
							}
						}
					});
				}else{
					myBar = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: false,
							scales: {
								xAxes: [{
									categoryPercentage: 0.35,
									barPercentage: 0.70,
									display: true,
									scaleLabel: {
										display: false,
										labelString: 'Month'
									},
									gridLines: false,
									ticks: {
										display: true,
										beginAtZero: true,
										fontColor: KTApp.getBaseColor('shape', 3),
										fontSize: 13,
										padding: 10
									}
								}],
								yAxes: [{
									categoryPercentage: 0.35,
									barPercentage: 0.70,
									display: true,
									scaleLabel: {
										display: false,
										labelString: 'Value'
									},
									gridLines: {
										color: KTApp.getBaseColor('shape', 2),
										drawBorder: false,
										offsetGridLines: false,
										drawTicks: false,
										borderDash: [3, 4],
										zeroLineWidth: 1,
										zeroLineColor: KTApp.getBaseColor('shape', 2),
										zeroLineBorderDash: [3, 4]
									},
									ticks: {
										max: config.maximum,                            
										stepSize: config.step,
										display: true,
										beginAtZero: config.zero,
										fontColor: KTApp.getBaseColor('shape', 3),
										fontSize: 13,
										padding: 10
									}
								}]
							},
							title: {
								display: false
							},
							hover: {
								mode: 'index'
							},
							tooltips: {
								enabled: true,
								intersect: false,
								mode: 'nearest',
								bodySpacing: 5,
								yPadding: 10,
								xPadding: 10, 
								caretPadding: 0,
								displayColors: false,
								backgroundColor: KTApp.getStateColor('brand'),
								titleFontColor: '#ffffff', 
								cornerRadius: 4,
								footerSpacing: 0,
								titleSpacing: 0
							},
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 5,
									bottom: 5
								}
							}
						}
					});
				}
			},

			set_role_access: function (data=[]) {
				role_access = data;
			},

			get_role_access: function (name=null) {
				if (name) {
					if (role_access) {
						return role_access.includes(name);
					}
					return false;
				}
				return role_access;
			},

			templateResult : function(state) {
				return (state.view?$(state.view):state.text);
			},

			ajaxCombo: function(config) {
				config = $.extend(true, {
						el      : null,
						limit   :30,
						url     : null,
						tempData: null,
						data    : {},
						clear   : true,
						wresult : 'none',
						tags    : false,
						displayField: null,
						callback: function(res) {}
					}, config);
				$(config.el).select2({
					dropdownCssClass : config.wresult,
					allowClear: config.clear,
					tags    : config.tags,
					delay   : 500,
					ajax    : {
						url     : config.url,
						dataType: 'json',
						type    : 'post',
						data: function (params) {
						return {
							q   : params.term, // search term
							page : params.page,
							limit : config.limit,
							fdata : config.data,
							"_token": "{{ csrf_token() }}",
						};
						}, 
						processResults: function (data, params) {
						params.page = params.page || 1;
						return {
							results: data.items,
							pagination: {
							more: (params.page * config.limit) < data.total_count
							}
						};
						},
						cache: true
					},
					templateResult : SUPER.templateResult,
					placeholder: 'ketik atau pilih data',
					minimumInputLength: 0,               
					templateSelection: function (data, container) {
						$(data.element).attr('data-temp', data.saved);
						$.each(config.tempData, function(i, v) {
							$(data.element).attr('data-'+v.key, v.val);                        
						})
						return data[config.displayField] || data.text;
					}
				});
			},

			createCombo: function(config) {
				config = $.extend(true, {
					el: null,
					valueField: null,
					valueGroup: null,
					valueAdd: null,
					selectedField: null,
					displayField: null,
					displayField2: null,
					displayField3: null,
					url: null,
					placeholder: '-Pilih-',
					optionCustom: null,
					grouped: false,
					withNull : true,
					data : null,
					chosen : false,
					sync: true,
					disableField: null,
					callback: function() {}
				}, config);

				if (config.url !== null){
					$.ajax({
						url: config.url,
						data : $.extend(
							config.data,
							{
								"_token": "{{ csrf_token() }}",
							}
						),
						type:'POST',
						async: config.sync,
						complete: function(response) {
							var html = (config.withNull === true) ? "<option value>"+config.placeholder+"</option>" : "";
							html += (config.optionCustom != null) ? "<option value='"+config.optionCustom.id+"'>"+config.optionCustom.name+"</option>" : "";
							var data = $.parseJSON(response.responseText);
							if (data.success) {
								$.each(data.data, function(i, v) {
									var selectedFix = '';
									var disable_field = '';
									if (config.disableField!=null) {
										if (v[config.disableField]) {
											disable_field = 'disabled';
										}
									}
									var sarr = Array.isArray(config.selectedField);
									if (sarr) {
										$.each(config.selectedField, function(isf, vsf) {
											if (vsf == v[config.valueField]) {
												selectedFix = 'selected';
											}
										})
									}else{
										if (Number.isInteger(config.selectedField)) {
											if (config.selectedField == i) {
												selectedFix = 'selected';
												disable_field = '';
											}
										}else{
											if (config.selectedField == v[config.valueField]) {
												selectedFix = 'selected';
												disable_field = '';
											}
										}
									}
									if (config.grouped) {
										if (config.displayField3!=null){
											html += "<option "+selectedFix+" value='" + v[config.valueField] + "' data-add='"+v[config.valueAdd]+"'  "+disable_field+" >" + v[config.displayField] + " - " + v[config.displayField2] + " ( "+ v[config.displayField3] +" ) " + "</option>";
										}else{
											html += "<option "+selectedFix+" value='" + v[config.valueField] + "' data-add='"+v[config.valueAdd]+"'  "+disable_field+" >" + v[config.displayField] + " - " + v[config.displayField2] + "</option>";
										}
									} else {
										var disable_field = '';
										if (config.disableField!=null) {
											disable_field = 'disabled';
										}
										html += "<option "+selectedFix+" value='" + v[config.valueField] + "' data-add='"+v[config.valueAdd]+"' "+disable_field+" >" + v[config.displayField] + "</option>";
									}
								});
								if (config.el.constructor === Array){
									$.each(config.el,function(i,v){
										$('#'+v).html(html);
									})
								}else{
									$('#' + config.el).html(html);
								}
								if (config.chosen){
									if (config.el.constructor === Array){
										$.each(config.el,function(i,v){
											$('#'+v).addClass(v);
											$('.'+v).select2({
												allowClear: true,
												dropdownAutoWidth : true,
												width: '100%',
												placeholder: config.placeholder,
											});
										})
									}else{
										$('#' + config.el).addClass(config.el);
										$('.'+ config.el).select2({
											allowClear: true,
											dropdownAutoWidth : true,
											width: '100%',
											placeholder: config.placeholder,
										});
									}
								}else{
									if (config.el.constructor === Array){
										$.each(config.el,function(i,v){
											$('#'+v).addClass(v);
											$('.'+v).select2({
												allowClear: true,
												dropdownAutoWidth : true,
												width: '100%',
											});
										})
									}else{
										$('#' + config.el).addClass(config.el);
										$('.'+ config.el).select2({
											allowClear: true,
											dropdownAutoWidth : true,
											width: '100%',
										});
									}
								}
							}
							config.callback(data);
						}
					});
				}
				else
				{
					var response = {success:false,message:'Url kosong'};
					config.callback(response);
				}
			},

			getDataFromTable: function(config){
				config = $.extend(true, {
					inline  : null,
					table   : null,
					multiple: false,
					callback: function(args){}
				}, config);
				var data = '';
				var multidata = [];

				if(config.inline){
					t_row = $(config.inline).parent().parent();
					data = $.parseJSON(atob($(t_row).find('input[name=checkbox]').data('record')));
				}else{                
					$("#"+config.table).find('input[name=checkbox]').each(function(key, value) {
						if ($(value).is(":checked")) {
							if(config.multiple){
								multidata.push($.parseJSON(atob($(value).data('record'))));
								console.log($.parseJSON(atob($(value).data('record'))));
							}else{
								console.log('apa');
								data = $.parseJSON(atob($(value).data('record')));
							}
						}
					});
				}
				if(config.multiple){
					console.log('ya');
					config.callback(multidata);
				}else{
					console.log(data);
					config.callback(data);
				}
			},

			switchForm: function(config){
				config = $.extend(true, {
					speed: 'fast',
					easing: 'swing',
					callback: function() {},
					tohide: 'table_data',
					toshow: 'form_data',
					animate: null,
				}, config);

				if (config.animate!==null)
				{
					if (config.animate==='fade')
					{
						$("." + config.tohide).fadeOut(config.speed, function() {
							$("." + config.toshow).fadeIn(config.speed, config.callback)
						});
					}
					else if (config.animate==='toogle')
					{
						$("." + config.tohide).fadeToggle(config.speed, function() {
							$("." + config.toshow).fadeToggle(config.speed, config.callback)
						});
					}
					else if (config.animate==='slide')
					{
						$("." + config.tohide).slideUp(config.speed, function(){
							$("." + config.toshow).slideDown(config.speed,config.callback);                
						});
					}
					else{
						$("." + config.tohide).fadeOut(config.speed, function() {
							$("." + config.toshow).fadeIn(config.speed, config.callback)
						});
					}
				}
				else
				{
					$("." + config.tohide).fadeOut(config.speed, function() {
						$("." + config.toshow).fadeIn(config.speed, config.callback)
					});
				}

				$('html,body').animate({
					scrollTop: 0 /*pos + (offeset ? offeset : 0)*/
				}, 'slow');
			},

			saveForm: function(config){
				config = $.extend(true, {
					element  : null,
					checker : null,
					add_route: null,
					update_route : null,
					callback: function(args){}
				}, config);
				var id = $('#'+config.checker).val();
				// Penentuan URL dan Tipe Protokol
				var alamat = '';
				var protocol = '';
				if(jQuery.isEmptyObject(id)){
					alamat = config.add_route;
					protocol = 'POST';
				}else{
					alamat = config.update_route;
					protocol = 'PUT';
				}
				// Konfirmasi
				Swal.fire({
					title: 'Peringatan',
					text: 'Anda akan melakukan penyimpanan/pengubahan data. Anda yakin untuk menyimpan ?',
					type: 'warning',
					confirmButtonText: '<i class="fa fa-check"></i> Ya',
					confirmButtonClass: 'btn btn-focus btn-success m-btn m-btn--pill m-btn--air',
					reverseButtons: false,
					showCancelButton: true,
					cancelButtonText: '<i class="fa fa-times"></i> Tidak',
					cancelButtonClass: 'btn btn-focus btn-danger m-btn m-btn--pill m-btn--air'
				}).then(function(result) {
					if (result.value === true) {
						blockPage();
						$.ajax({
							url: alamat,
							type: protocol,
							data: $('[name=' + config.element + ']').serializeObject(),
							headers: {
								'X-CSRF-TOKEN': '{{ csrf_token() }}'
							},
							success: function(lar){
								if(lar.success == true){
									Swal.fire({
										title: 'Sukses',
										text: 'Penyimpanan sukses !',
										type: 'success',
									});
									$('#'+config.element)[0].reset();
									onBack();
								}else{
									Swal.fire({
										title: 'Gagal',
										text: lar.message,
										type: 'error',
									});
									onRefresh();
								}
							}
						});
						unblockPage();
					}else if(result.dismiss === 'cancel'){
						Swal.fire({
							title: 'Batal',
							text: 'Penyimpanan dibatalkan',
							type: 'error',
						});
					}
				});
			},
		}

	}();

</script>