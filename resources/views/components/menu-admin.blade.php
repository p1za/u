<li>
    <a href="javascript:;" class="has-arrow" aria-expanded="true">
        <div class="parent-icon"><i class="bx bxs-plane-alt"></i></div>
        <div class="menu-title">Master Data</div>
    </a>
    <ul class="mm-collapse" style="">
        <li>
            <a href="{{ route('kota.index') }}" class="{{ request()->routeIs('kota.index') ? 'mm-active' : '' }}">
                <i class="bx bx-right-arrow-alt"></i>Master Kota
            </a>
        </li>
        <li>
            <a href="{{ route('airlines.index') }}"
                class="{{ request()->routeIs('airlines.index') ? 'mm-active' : '' }}">
                <i class="bx bx-right-arrow-alt"></i>Master Maskapai
            </a>
        </li>
        <li>
            <a href="{{ route('unit.index') }}" class="{{ request()->routeIs('unit.index') ? 'mm-active' : '' }}">
                <i class="bx bx-right-arrow-alt"></i>Master Unit Pesawat
            </a>
        </li>
        <li>
            <a href="{{ route('seats.index') }}" class="{{ request()->routeIs('seats.index') ? 'mm-active' : '' }}">
                <i class="bx bx-right-arrow-alt"></i>Master Kursi Pesawat
            </a>
        </li>
        <li>
            <a href="{{ route('payments.index') }}"
                class="{{ request()->routeIs('payments.index') ? 'mm-active' : '' }}">
                <i class="bx bx-right-arrow-alt"></i>Master Payments
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="{{ route('schedules.index') }}">
        <div class="parent-icon">
            <i class="bx bx-calendar"></i>
        </div>
        <div class="menu-title">Jadwal Penerbangan</div>
    </a>
</li>
<li>
    <a href="{{ route('bookings.index') }}">
        <div class="parent-icon">
            <i class="bx bx-receipt"></i>
        </div>
        <div class="menu-title">Data Pemesanan</div>
    </a>
</li>
