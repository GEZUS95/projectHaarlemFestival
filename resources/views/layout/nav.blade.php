<nav class="layout-nav">
    <div class="layout-nav-logo">
        <a href="/" class="layout-nav-btn">Haarlem Festival</a>
    </div>

    <div class="layout-nav-links">
        @if(!\Matrix\Managers\AuthManager::boolLoggedIn())
            <div class="layout-nav-links-url">Login</div>
        @else
            <div class="layout-nav-links-url">Logout</div>
        @endif
    </div>

</nav>