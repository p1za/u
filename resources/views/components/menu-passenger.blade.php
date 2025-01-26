<li>
    <a href="{{ route('passenger.bookings') }}" class="{{ request()->routeIs('passenger.bookings') ? 'mm-active' : '' }}">
        <div class="parent-icon">
            <i class='bx bx-calendar-check' ></i>
        </div>
        <div class="menu-title">Pesan Tiket</div>
    </a>
</li>
<li>
    <a href="{{ route('passenger.my-bookings') }}">
        <div class="parent-icon">
            <i class='bx bx-history' ></i>
        </div>
        <div class="menu-title">Riwayat Pemesanan</div>
    </a>
</li>
