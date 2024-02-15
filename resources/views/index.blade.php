
<!DOCTYPE html>

<!--
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin- in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../">
		<meta charset="utf-8" />
		<title id="ttl"></title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/brand/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/aside/light.css" rel="stylesheet" type="text/css" />

		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

		<link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<!-- <link rel="shortcut icon" href="assets/media/logos/bersii1.jpg" /> -->
		<link rel="shortcut icon" href="assets/media/logos/LOGO-small.png" />

		<script src="https://cdn.tiny.cloud/1/xs7sffcj92527m8lliue7twd0p61i3pib6pqydz8p2b7ychr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"metal": "#c4c5d6",
						"light": "#ffffff",
						"accent": "#00c5dc",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995",
						"focus": "#9816f4"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="assets/js/pages/dashboard.js" type="text/javascript"></script>

		<script>
			window.OVERRIDE_API_KEY = "SIDiVkui";
		</script>

		{{-- TinyMCE --}}
		<script src="https://cdn.tiny.cloud/1/xs7sffcj92527m8lliue7twd0p61i3pib6pqydz8p2b7ychr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

		{{-- CryptoJS --}}
		<script src="{{ asset('assets/plugins/crypto/crypto-core.min.js') }}"></script>
  		<script src="{{ asset('assets/plugins/crypto/crypto-md5.js') }}"></script>

		{{-- Cropper --}}
		<link href="{{ asset('assets/plugins/cropper/cropper.css') }}" rel="stylesheet"/>

		<!--end::Page Scripts -->
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="#">
					<img alt="Logo" src="assets/media/logos/LOGO-small.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<!-- <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button> -->
				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->

		<!-- begin:: Root -->
		<div class="kt-grid kt-grid--hor kt-grid--root">

			<!-- begin:: Page -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                    <!-- begin::Aside Brand -->
                    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                        <div class="kt-aside__brand-logo">
                            <a href="/">
                                <img alt="Logo" src="assets/media/logos/LOGO-small.png" style="width: 25%"/>
                            </a>
                        </div>
                        <div class="kt-aside__brand-tools">
                            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
                        </div>
                    </div>

                    <!-- end:: Aside Brand -->

                    <!-- begin:: Aside Menu -->
                    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                            {{-- <ul class="kt-menu__nav" style="padding-top: 0px;">
								
                                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a id="new-page-button" data-page="dashboard" data-name="Realtime Monitoring" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Dashboard</span></a></li>

								<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="produksi" data-name="Produksi" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Produksi</span></a></li>

                                <li class="kt-menu__section ">
                                    <h4 class="kt-menu__section-text">Administrasi</h4>
                                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                                </li>

								<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="konfigurasi" data-name="Konfigurasi" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">Konfigurasi</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="pembukuan" data-name="Pembukuan" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-book"></i><span class="kt-menu__link-text">Pembukuan</span></a></li>

                            </ul> --}}

							<?= $html; ?>

                        </div>
                    </div>

                    <!-- end:: Aside Menu -->

                </div>

                <!-- end:: Aside -->

				<!-- begin:: Wrapper -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->
						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout- ">
								{{-- <ul class="kt-menu__nav ">

									<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Pages</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>	
									</li>

									<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Reports</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									</li>

									<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Apps</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									</li>

								</ul>  --}}
								<?= $header; ?>
							</div>
						</div>

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">

							<!--begin: Quick Actions -->
							<!-- <div class="kt-header__topbar-item">
								<div class="kt-header__topbar-wrapper" id="kt_offcanvas_toolbar_quick_actions_toggler_btn">
									<span class="kt-header__topbar-icon"><i class="flaticon2-gear"></i></span>
								</div>
							</div> -->

							<!--end: Quick Actions -->

							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-offset="0px,0px">

									<!--use "kt-rounded" class for rounded avatar style-->
									<div class="kt-header__topbar-user kt-rounded-">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->nama }}</span>
										<?php 
											if(isset(Auth::user()->img) && Auth::user()->img !== ''){
												$setimg = 'uploads/users/'.Auth::user()->img;
											}else{
												$setimg = 'assets/media/users/default.jpg';
											}
										?>
										<img alt="Pic" src="<?= $setimg ?>" class="kt-rounded-" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--lg kt-badge--brand kt-hidden kt-badge--bold">S</span>
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-sm">
									<div class="kt-user-card kt-margin-b-40 kt-margin-b-30-tablet-and-mobile" style="background-image: assets/media/misc/head_bg_br.png">
										<div class="kt-user-card__wrapper">
											<div class="kt-user-card__pic">

												<!--use "kt-rounded" class for rounded avatar style-->
												<!-- <img alt="Pic" src="assets/media/users/300_21.jpg" class="kt-rounded-" /> -->
											</div>
											<!-- <div class="kt-user-card__details">
												<div class="kt-user-card__name">Alex Stone</div>
												<div class="kt-user-card__position">CTO, Loop Inc.</div>
											</div> -->
										</div>
									</div>
									<ul class="kt-nav kt-margin-b-10">
										<li class="kt-nav__item">
											<a href="custom/profile/account-settings.html" class="kt-nav__link">
												<span class="kt-nav__link-icon"><i class="flaticon2-gear"></i></span>
												<span class="kt-nav__link-text">Settings</span>
											</a>
										</li>
										<li class="kt-nav__separator kt-nav__separator--fit"></li>
										<li class="kt-nav__custom kt-space-between">
											<a href="#" target="_blank" class="btn btn-label-brand btn-upper btn-sm btn-bold">Sign Out</a>
										</li>
									</ul>
								</div>
							</div>

							<!--end: User Bar -->

							<!--begin:: Quick Panel Toggler -->
							<div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" title="Quick panel" data-placement="right">
								<span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
									<i class="flaticon-logout"></i>
								</span>
							</div>

							<!--end:: Quick Panel Toggler -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Subheader -->
						<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">Dashboard</h3>
									<span class="kt-subheader__separator kt-subheader__separator--v"></span>
									<div class="kt-subheader__breadcrumbs">
										
										<a href="#" class="kt-subheader__breadcrumbs-link">
											Dashboard </a>
										<span class="kt-subheader__breadcrumbs-separator newww"></span>
										<a href="#" class="kt-subheader__breadcrumbs-link endsst">
											
										</a>
										<span class="kt-subheader__breadcrumbs-separator pagel"></span>
										<a href="#" class="kt-subheader__breadcrumbs-link endsss">
											
										</a>

										<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
									</div>
								</div>
								<div class="kt-subheader__toolbar">
									<div class="kt-subheader__wrapper">
										<a href="#" class="btn btn-sm btn-elevate btn-brand" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="" data-placement="left">
											<span class="kt-opacity-7" id="kt_dashboard_daterangepicker_title">Today:</span>&nbsp;
											<span class="kt-font-bold" id="kt_dashboard_daterangepicker_date">Jan 11</span>
											<i class="flaticon-calendar-with-a-clock-time-tools kt-padding-l-5 kt-padding-r-0"></i>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="bersii-page-container">
							<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="target">

								{{-- <!--begin::Dashboard 4-->

								<!--begin::Row-->
								<div class="row">
									
									<div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
										<div id="target">

										</div>
									</div>
									
								</div>

								<!--end::Row-->

								<!--end::Dashboard 4--> --}}

							</div>
						</div>
						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
					<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__copyright">
								<?php echo date('Y') ?>&nbsp;&copy;&nbsp;<a href="https://modifwebsite.id" target="_blank" class="kt-link">MoWeb</a>
							</div>
							<div class="kt-footer__menu">
								<a href="https://modifwebsite.id" target="_blank" class="kt-footer__menu-link kt-link">Kontak</a>
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>

				<!-- end:: Wrapper -->
			</div>

			<!-- end:: Page -->
		</div>

		<!-- end:: Root -->

		<!-- begin:: Topbar Offcanvas Panels -->

		<!-- end:: Topbar Offcanvas Panels -->

		<!-- begin:: Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="la la-arrow-up"></i>
		</div>

		<script>
			var BASE_URL = '{{  url('') }}'
		</script>

		<!-- end:: Scrolltop -->

		<script src="assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/datatables/fnReloadAjax.js" type="text/javascript"></script>
		<script src="assets/plugins/custom/jstree/jstree.bundle.js?v=1.0.1" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/cropper/cropper.js') }}"></script>
		@include('javascript')

	</body>
	<!-- end::Body -->
</html>