<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Navigation</li>

                <li class="">
                    <a href="{{ route('home') }}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span> Data Master </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.market.index') }}">Pasar</a></li>
                        <li><a href="{{ route('admin.typeprice.index') }}">Jenis Harga</a></li>
                        <li><a href="{{ route('admin.typecom.index') }}">Jenis Komoditas</a></li>
                        <li><a href="{{ route('admin.comcat.index') }}">Kategori Komoditas</a></li>
                        <li><a href="{{ route('admin.commodity.index') }}">Komoditas</a></li>
                        <li><a href="{{ route('admin.unit.index') }}">Satuan</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-wallet"></i> <span> Input Harga </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        @foreach (App\Models\TypePrice::all() as $typePrice)
                            <li><a href="{{ route('admin.price.index', $typePrice->slug) }}">Input {{ $typePrice->title }}</a></li>                            
                        @endforeach
                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>