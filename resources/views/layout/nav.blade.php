<nav class="layout-nav">
    <div class="layout-nav-logo">
        <a href="/" class="layout-nav-btn">Haarlem Festival</a>
    </div>

    <div class="layout-nav-links">
        @if(!\Matrix\Managers\AuthManager::boolLoggedIn())
            <a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("login")}}" class="layout-nav-links-url">Login</a>
        @else
            <a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order")}}" class="layout-nav-links-url">Shopping cart</a>

            <form class="layout-nav-links-url" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("logout")}}" method="POST">
                <input type="submit" class="layout-nav-links-url" value="Logout">
            </form>
        @endif
    </div>

</nav>