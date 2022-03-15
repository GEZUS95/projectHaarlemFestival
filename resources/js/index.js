// import _ from 'lodash';
import SideNavigationLink from "./components/admin/SideNavigationLink";
import SideNavigationEvents from "./components/admin/SideNavigationEvents";
import EventSubNavigation from "./components/admin/pages/EventSubNavigation";
import EventOverviewPage from "./components/admin/pages/EventOverviewPage";
import CreateProgramModal from "./components/admin/modals/CreateProgramModal";
import PaginatorComponent from "./components/admin/pages/PaginatorComponent";
import SubNavigation from "./components/admin/pages/SubNavigation";
import CreateLocationModal from "./components/admin/modals/CreateLocationModal";
import UpdateLocationModal from "./components/admin/modals/UpdateLocationModal";
import CreatePerformerModal from "./components/admin/modals/CreatePerformerModal";
import UpdatePerformerModal from "./components/admin/modals/UpdatePerformerModal";
import CreateRolesModal from "./components/admin/modals/CreateRolesModal";
import MultiSelect from "./components/admin/helpers/MultiSelect";
import UpdateRolesModal from "./components/admin/modals/UpdateRolesModal";
import CreateUsersModal from "./components/admin/modals/CreateUserModal";
import UpdateUserModal from "./components/admin/modals/UpdateUserModal";
import CreateEventModal from "./components/admin/modals/CreateEventModal";
import initAddEventBtn from "./components/admin/scripts/HandleSideNavigation";
import UpdateEventModal from "./components/admin/modals/UpdateEventModal";
import Navbar from "./components/admin/layout/Navbar";

/**
 * View Components
 */
window.customElements.define('side-navigation-link', SideNavigationLink);
window.customElements.define('side-navigation-events', SideNavigationEvents);
window.customElements.define('event-sub-navigation', EventSubNavigation);
window.customElements.define('event-overview-page', EventOverviewPage);
window.customElements.define('create-program-modal', CreateProgramModal);
window.customElements.define('paginator-component', PaginatorComponent);
window.customElements.define('admin-sub-navigation', SubNavigation);
window.customElements.define('create-location-modal', CreateLocationModal);
window.customElements.define('update-location-modal', UpdateLocationModal);
window.customElements.define('create-performer-modal', CreatePerformerModal);
window.customElements.define('update-performer-modal', UpdatePerformerModal);
window.customElements.define('create-role-modal', CreateRolesModal);
window.customElements.define('update-role-modal', UpdateRolesModal);
window.customElements.define('create-user-modal', CreateUsersModal);
window.customElements.define('update-user-modal', UpdateUserModal);
window.customElements.define('create-event-modal', CreateEventModal)
window.customElements.define('update-event-modal', UpdateEventModal)
window.customElements.define('nav-bar', Navbar)

/**
 * Helper Components
 */
window.customElements.define('multi-select', MultiSelect);

/**
 * Scripts!
 */
initAddEventBtn()

//npm i -g webpack
//npm i -g webpack-cli
