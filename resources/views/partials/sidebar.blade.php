<div class="search-popup">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>
	<!-- content -->
	<div class="search-content">
		<div class="text-center">
			<h3 class="mb-4 mt-0">Nhấn ESC để đóng</h3>
		</div>
		<!-- form -->
		<form class="d-flex search-form" action="" method="GET">
			<input class="form-control me-2" type="search" name="search" placeholder="Tìm kiếm và nhấn enter ..." aria-label="Search" 
			value="{{ request()->query('search') }}"
			>
			<button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
		</form>
	</div>
</div>

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>

	<!-- logo -->
	<div class="logo">
		<img src="{{ asset('images/logo.svg') }}" alt="Katen" />
	</div>
</div>