<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li>
                <a href="{{route('home')}}"><i class="fa fa-home"></i> Əsas səhifə</a>
            </li>
            @role('admin')
            <li>
                <a href="{{route('user.index')}}"><i class="fa fa-user"></i> İstifadəçilər</a>
            </li>
            <li>
                <a href="{{route('product.index')}}"><i class="fa fa-cubes"></i> Məhsular</a>
            </li>
            <li>
                <a href="{{route('product-category.index')}}"><i class="fa fa-edit"></i> Məhsul kateqoriyaları</a>
            </li>
            <li>
                <a href="{{route('customer.index')}}"><i class="fa fa-users"></i> Müştərilər</a>
            </li>
            <li>
                <a href="{{route('sale.index')}}"><i class="fa fa-bookmark"></i>Kampaniyalar</a>
            </li>
            <li>
                <a href="{{route('order.index')}}"><i class="fa fa-cart-arrow-down"></i>Bütün sifarişlər</a>
            </li>
            <li>
                <a href="{{route('currentOrders')}}"><i class="fa fa-cart-arrow-down"></i>Prosesdə olan sifarişlər</a>
            </li>
            <li>
                <a href="{{route('general-cost.index')}}"><i class="fa fa-money"></i>Xərclər</a>
            </li>
            <li>
                <a href="{{route('workshop-debt.index')}}"><i class="fa fa-pie-chart"></i>Emalatxana hesabatı</a>
            </li>
            <li>
                <a href="{{route('customerPayment.index')}}"><i class="fa fa-usd"></i>Maliyyə hesabatı</a>
            </li>
            @endrole
            @role('sales')
            <li>
                <a href="{{route('product.index')}}"><i class="fa fa-cubes"></i> Məhsular</a>
            </li>
            <li>
                <a href="{{route('customer.index')}}"><i class="fa fa-users"></i> Müştərilər</a>
            </li>
            <li>
                <a href="{{route('sale.index')}}"><i class="fa fa-bookmark"></i>Kampaniyalar</a>
            </li>
            <li>
                <a href="{{route('order.index')}}"><i class="fa fa-cart-arrow-down"></i>Bütün sifarişlər</a>
            </li>
            <li>
                <a href="{{route('currentOrders')}}"><i class="fa fa-cart-arrow-down"></i>Prosesdə olan sifarişlər</a>
            </li>
            <li>
                <a href="{{route('general-cost.index')}}"><i class="fa fa-money"></i>Xərclər</a>
            </li>
            <li>
                <a href="{{route('customerPayment.index')}}"><i class="fa fa-usd"></i>Maliyyə hesabatı</a>
            </li>
            @endrole
            @role('workshop')
            <li>
                <a href="{{route('currentOrders')}}"><i class="fa fa-cart-arrow-down"></i>Prosesdə olan sifarişlər</a>
            </li>
            <li>
                <a href="{{route('workshop-debt.index')}}"><i class="fa fa-pie-chart"></i>Emalatxana hesabatı</a>
            </li>
            @endrole
        </ul>
    </div>
</div>


