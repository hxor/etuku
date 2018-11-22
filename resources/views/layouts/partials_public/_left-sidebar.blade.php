<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Navigation</li>

                <li class="">
                    <a href="{{ url('/') }}" class="waves-effect"><i class="ti-home"></i> <span> Beranda </span></a>
                </li>

                {{-- <li class="">
                    <a href="{{ url('/login') }}" class="waves-effect"><i class="ti-shift-right"></i> <span> Login </span></a>
                </li> --}}

                {{-- <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-wallet"></i> <span> Cari Harga </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        @foreach (App\Models\TypePrice::all() as $typePrice)
                            <li><a href="{{ route('admin.price.index', $typePrice->slug) }}">{{ $typePrice->title }}</a></li>                            
                        @endforeach
                    </ul>
                </li> --}}

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>