<div class="partials-admin-layout-sidenav">
    <div class="partials-admin-layout-sidenav-title">Events</div>
    <div>
        <side-navigation-events
            titles="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_event_titles")}}"
        ></side-navigation-events>
        <div class="partials-admin-layout-sidenav-btn-add-events">
            <div class="partials-admin-layout-sidenav-btn-event-icon partials-admin-layout-sidenav-btn-events-plus"><i class="fa-solid fa-circle-plus"></i></div>
            <div class="partials-admin-layout-sidenav-btn-events-titles">Add Event</div>
        </div>
        <div class="partials-admin-layout-sidenav-title">Users</div>
        <div class="partials-admin-layout-sidenav-users-other">
            <side-navigation-link
                    href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_roles")}}"
                    link-name="Roles"
            ></side-navigation-link>
        </div>

        <div class="partials-admin-layout-sidenav-users-other">
            <side-navigation-link
                    href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_users")}}"
                    link-name="Users"
            ></side-navigation-link>
        </div>
        <div class="partials-admin-layout-sidenav-title">Other</div>
        <div class="partials-admin-layout-sidenav-users-other">
            <side-navigation-link
                    href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_performers")}}"
                    link-name="Performers"
            ></side-navigation-link>
        </div>
        <div class="partials-admin-layout-sidenav-users-other">
            <side-navigation-link
                    href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_locations")}}"
                    link-name="Locations"
            ></side-navigation-link>
        </div>

        <style>
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                padding: 12px 16px;
                z-index: 1;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }
        </style>
        <div class="dropdown">
            <span>Food Settings</span>
            <div class="dropdown-content">
                <div class="partials-admin-layout-sidenav-users-other">
                    <side-navigation-link
                            href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_restaurants")}}"
                            link-name="Restaurants"
                    ></side-navigation-link>
                </div>
                <div class="partials-admin-layout-sidenav-users-other">
                    <side-navigation-link
                            href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_restaurants")}}"
                            link-name="Restaurants Types"
                    ></side-navigation-link>
                </div>
                <div class="partials-admin-layout-sidenav-users-other">
                    <side-navigation-link
                            href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_restaurants")}}"
                            link-name="Sessions"
                    ></side-navigation-link>
                </div>
            </div>
        </div>

    </div>
</div>
