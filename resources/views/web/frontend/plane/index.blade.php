@extends('web.frontend.layout')

@section('title', 'Harga Tiket Pesawat Murah')

@push('stylesheets')
	<link rel="stylesheet" href="{{ url('plugin/select2/dist/css/select2.css') }}">
  <link rel="stylesheet" href="{{ url('plugin/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css') }}">
@endpush

@section("content")
  <div class="home-page">
		<div class="home-flight">
			<div class="overlay"></div>
			<!-- Banner -->
			<div class="banner bg-gradation-blue">
				<div class="home-slider">
					<div id="carouselHomepage" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselHomepage" data-slide-to="0" class="active"></li>
							<li data-target="#carouselHomepage" data-slide-to="1"></li>
							<li data-target="#carouselHomepage" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<a href="{{ url('/') }}"><img src="{{ url('img/banner-example.png') }}" class="d-block" alt=""></a>
							</div>
							<div class="carousel-item">
								<a href="{{ url('/') }}"><img src="{{ url('img/banner-example.png') }}" class="d-block" alt=""></a>
							</div>
							<div class="carousel-item">
								<a href="{{ url('/') }}"><img src="{{ url('img/banner-example.png') }}" class="d-block" alt=""></a>
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselHomepage" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselHomepage" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
      <!-- End of Banner -->

      <!-- Main Content -->
			<div class="container">
				<!-- Flight Form -->
				<div class="card flight-form p-4" id="flightForm">
					<form action="{{route('flight_search')}}">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12">
								<div class="row">
	
									<!-- Airport Inputs -->
									<div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3 form-group" id="containerInputBandara1">
										<label for="input-bandara-asal">Dari</label>
										<div class="input-group product-search-input-container">
											<img src="{{ url('img/icons/ic_pesawat_takeoff.png') }}" class="tm tm-pesawat-takeoff">
											<select name="origin" id="selectBoxKotaAsal" class="form-control product-search-input @error('origin') is-invalid @enderror" data-placeholder="Mau ke mana?">
												<option value=""></option>
												@foreach($cities as $city)
													<optgroup label="{{$city->name}}">
														@foreach($city->airports as $airport)
															<option value="{{$airport->iata_code}}" {{ old('origin') == $airport->iata_code ? 'selected' : '' }}>
																{{$airport->name}}
															</option>
														@endforeach
													</optgroup>
												@endforeach
											</select>
											@error('origin')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>

									<div class="reverse-button-container position-relative">
										<span><i class="fas fa-exchange-alt" id="switch-btn"></i></span>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-lg-0 mt-md-0 mt-2 mb-3 form-group" id="containerInputBandara2">
										<label for="input-bandara-tujuan">Ke</label>
										<div class="input-group product-search-input-container">
											<img src="{{ url('img/icons/ic_pesawat_landing.png') }}" class="tm tm-pesawat-landing">
											<select name="destination" id="selectBoxKotaTujuan" class="form-control product-search-input @error('destination') is-invalid @enderror" data-placeholder="Mau ke mana?">
												<option value=""></option>
												@foreach($cities as $city)
													<optgroup label="{{$city->name}}">
														@foreach($city->airports as $airport)
															<option value="{{$airport->iata_code}}" {{ old('destination') == $airport->iata_code ? 'selected' : '' }}>{{$airport->name}}</option>
														@endforeach
													</optgroup>
												@endforeach
											</select>
											@error('destination')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
											@if(session('error_message'))
												<small class="text-danger">
													{{ session('error_message') }}
												</small>
											@endif
										</div>
									</div>
                  <!-- End of Airport Inputs -->

									<!-- Flight Date Inputs -->
									<div class="col-lg-6 col-md-6 col-sm-12 mb-3 form-group" id="containerTanggalBerangkat">
										<label for="#input-tanggal-berangkat">Tanggal Berangkat</label>
										<div class="input-group product-search-input-container date">
											<img src="{{ url('img/icons/ic_kalender.png') }}" class="tm tm-kalender">
											<input type="text" class="form-control product-search-input @error('departure_date') is-invalid @enderror" name="departure_date" id="input-tanggal-berangkat" value="<?= strftime("%a, %d %b %Y"); ?>" autocomplete="off">
											@error('departure_date')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12 mb-3 form-group" id="containerTanggalPulang">
										<div class="custom-control custom-checkbox mb-2">
											<input type="checkbox" class="custom-control-input" name="trip" value="roundtrip" id="returnCheckbox">
											<label class="custom-control-label" for="returnCheckbox">Tanggal Pulang</label>
										</div>
										<div class="input-group product-search-input-container date" id="inputTanggalPulangContainer">
											<img src="{{ url('img/icons/ic_kalender.png') }}" class="tm tm-kalender">
											<input type="text" class="form-control product-search-input @error('arrival_date') is-invalid @enderror" name="arrival_date" id="input-tanggal-pulang">
											@error('arrival_date')
												<div class="invalid-feedback">{{$message}}</div>
											@enderror
										</div>
									</div>
                  <!-- End Flight Date Inputs -->
									<!-- Passenger Amount Inputs -->
									<div class="col-lg-6 col-md-6 form-group passenger-dropdown-container dropdown">
										<label>Penumpang</label>
										<div class="input-group">
											<button class="dropdown-toggle text-left form-control product-search-input" id="dropdownMenuButton" data-toggle="dropdown">
											</button>
											<div class="dropdown-menu shadow">
												<div class="dropdown-header">
													Penumpang
													<i class="fa fa-times"></i>
												</div>
												<div class="dropdown-item pb-0">
													<div class="row">
														<div class="col-5 passenger-type">
															<label for="adultPassenger">Dewasa</label>
														</div>
														<div class="col-7">
															<input type="number" name="adult" min="1" max="7" id="adultPassenger" value="1">
														</div>
													</div>
												</div>
												<div class="dropdown-divider"></div>
												<div class="dropdown-item pb-0">
													<div class="row">
														<div class="col-5 passenger-type">
															<label for="childPassenger">Anak</label>
														</div>
														<div class="col-7">
															<input type="number" name="child" id="childPassenger" min="0"
															max="6" value="0">
														</div>
													</div>
												</div>
												<div class="dropdown-divider"></div>
												<div class="dropdown-item pb-0">
													<div class="row">
														<div class="col-5 passenger-type">
																<label for="infantPassenger">Bayi</label>
														</div>
														<div class="col-7">
																<input type="number" name="infant" id="infantPassenger" min="0" max="4" value="0">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                  <!-- End of Passenger Amount Inputs -->

									<!-- Cabin Class Inputs -->
									<div class="col-lg-6 col-md-6 form-group">
										<label for="selectBoxKelasKabin">Kelas Kabin</label>
										<div class="input-group">
											<i class="tm tm-caret"></i>
											<select class="form-control product-search-input" name="class" id="selectBoxKelasKabin">
													<option>Ekonomi</option>
													<option>Premium Ekonomi</option>
													<option>Bisnis</option>
													<option>First</option>
											</select>
										</div>
									</div>
                  <!-- End of Cabin Class Inputs -->

									<!-- Search Button -->
									<div class="col-lg-12">
											<button type="submit" class="btn product-form-search-button w-100">Cari Penerbangan</button>
                  </div>
                  <!-- End of Search Button -->
								</div>
							</div>

              <!-- Flight Illustration -->
							<div class="col-lg-6 d-lg-inline-block d-none illustration-container">
								<div class="d-flex">
									<button data-target=""="#sidebar" class="btn text-decoration-none text-primary ml-auto" type="button" id="btnLastSearch">Pencarian terakhir</button>
								</div>
								<div class="row row-cols-1">
									<img src="{{ url('img/icons/aircraft-illustration.svg') }}" alt="ilustrasi pesawat" height="320px">
								</div>
              </div>
              <!-- End of Flight Illustration -->

						</div>
					</form>
				</div>
        <!-- End of Flight Form -->

				<!-- TripMate Partners Section -->
				<section class="tripmate-partners">
					<div id="partner-flight">
						<div class="text-center">
							<div class="text-airline-partners">Partner Maskapai</div>
						</div>
						<div class="partner-product-list row">
							<div class="col-lg-12 col-12">
								<div class="row justify-content-center">
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Citilink"><img src="{{ url('img/logo_partners/Citilink.png') }}"></a>
									</div>
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Garuda Indonesia"><img src="{{ url('img/logo_partners/GarudaIndonesia.png') }}"></a>
									</div>
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Batik Air"><img src="{{ url('img/logo_partners/BatikAir.png') }}"></a>
									</div>
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Wings Air"><img src="{{ url('img/logo_partners/WingsAir.png') }}"></a>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-12">
								<div class="row justify-content-center">
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Air Asia"><img src="{{ url('img/logo_partners/AirAsia.png') }}"></a>
									</div>
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Kalstar Aviation"><img src="{{ url('img/logo_partners/KalstarAviation.png') }}"></a>
									</div>
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Lion Air"><img src="{{ url('img/logo_partners/LionAir.png') }}"></a>
									</div>
									<div class="col-lg-auto col-md-auto col-3">
													<a href="#" alt="Tiket Pesawat Sriwijaya Air"><img src="{{ url('img/logo_partners/SriwijayaAir.png') }}"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
        <!-- End of TripMate Partners Section -->

        <!-- Divider -->
				<hr class="mx-auto">

        <!-- Smart Feature of TripMate -->
				<section class="book-cheap">
					<div class="text-book-cheap text-center">Pesan Tiket Pesawat Murah di TripMate</div>
					<div class="col-description row">
						<div class="col-lg-4 col-12 pr-0">
							<div class="d-flex">
								<img src="{{ url('img/icons/ic_reschedule.png') }}" alt="Smart Reschedule">
								<div class="text-bookcheap-title">
									Simple Reschedule
								</div>
							</div>
							<div class="text-bookcheap-description">
								Fitur Simple Reschedule TripMate akan memudahkan Anda melakukan pengajuan reschedule untuk penerbangan pilihan Anda.
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-lg-0 mt-4">
							<div class="d-flex">
								<img src="{{ url('img/icons/ic_refund.png') }}" alt="Smart Refund">
								<div class="text-bookcheap-title">
									Simple Refund
								</div>
							</div>
							<div class="text-bookcheap-description">
								Fitur Simple Refund memungkinkan Anda untuk mendapatkan pengembalian dana dengan mudah jika melakukan pembatalan tiket pesawat online. Simple refund dari TripMate akan memudahkan Anda untuk mendapatkan uang Anda kembali.
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="d-flex">
								<img src="{{ url('img/icons/ic_reschedule.png') }}" alt="Smart Reschedule">
								<div class="text-bookcheap-title">
									Smart Trip
								</div>
							</div>
							<div class="text-bookcheap-description">
								Dapatkan harga tiket pesawat murah untuk penerbangan pulang-pergi ke destinasi favorit Anda. Fitur Smart Trip dari TripMate membuat Anda makin mudah menemukan kombinasi tiket pesawat online PP tanpa harus melakukan pencarian dua kali.
							</div>
						</div>
					</div>
				</section>
        <!-- End of Smart Feature of TripMate -->

        <!-- Divider -->
				<hr class="mx-auto">

        <!-- Popular Flight Ticket -->
				<div class="home-popular">
					<div class="text-popular-title text-center mb-4">Tujuan Terpopuler</div>
					<div class="list-popular row">
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Surabaya</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Murah Ke Bali</a></div>
					</div>
				</div>
        <!-- End of Popular Ticket -->

        <!-- Popular Flight Routes -->
				<div class="home-popular mt-5">
					<div class="text-popular-title text-center mb-4">Rute Terpopuler</div>
					<div class="list-popular row">
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
						<div class="col-lg-4 col-md-4 col-auto"><a href="#">Tiket Pesawat Jakarta Bali</a></div>
					</div>
        </div>
        <!-- End of Popular Flight Routes -->

        <!-- Divider -->
				<hr class="mx-auto">
      </div>
      <!-- End of Main Content-->
		</div>
	</div>
@endsection

@push('scripts')
  <script src="{{ url('plugin/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
  <script src="{{ url('plugin/moment-js/moment-js.js') }}"></script>
  <script src="{{ url('plugin/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ url('plugin/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.id.min.js') }}"></script>
	<script src="{{ url('plugin/select2/dist/js/select2.min.js') }}"></script>
	<script>
		// Plugin Input Spinner
		let config = {
				incrementButton: "<i class='fa fa-plus'></i>",
				decrementButton: "<i class='fa fa-minus'></i>",
				buttonsOnly: true,
		};

		$("input[type='number']").inputSpinner(config);
		function formatBandara (bandara) {
			if (!bandara.id) {
				return bandara.text;
			}
			let $cities = $(
				`<i class="fa fa-city mr-2"></i><span>${bandara.text} </span><span class="dropdown-option-code ml-auto text-center">${bandara.id}</span>`
			);
			return $cities;
		};

		$("#selectBoxKotaAsal").select2({
			dropdownParent: $("#containerInputBandara1"),
			templateResult: formatBandara
		});

		$("#selectBoxKotaTujuan").select2({
			dropdownParent: $("#containerInputBandara2"),
			templateResult: formatBandara
		});

		console.log($("#selectBoxKotaTujuan"));
	</script>
@endpush