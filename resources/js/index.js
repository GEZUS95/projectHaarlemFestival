// import _ from 'lodash';
import SideNavigationLink from "./components/admin/SideNavigationLink";
import SideNavigationEvents from "./components/admin/SideNavigationEvents";
import EventSubNavigation from "./components/admin/EventSubNavigation";
import EventOverviewPage from "./components/admin/EventOverviewPage";
import CreateProgramModal from "./components/admin/modals/CreateProgramModal";
import PaginatorComponent from "./components/admin/PaginatorComponent";
import SubNavigation from "./components/admin/SubNavigation";
import CreateLocationModal from "./components/admin/modals/CreateLocationModal";
import UpdateLocationModal from "./components/admin/modals/UpdateLocationModal";
import CreatePerformerModal from "./components/admin/modals/CreatePerformerModal";
import UpdatePerformerModal from "./components/admin/modals/UpdatePerformerModal";
import CreateRolesModal from "./components/admin/modals/CreateRolesModal";
import MultiSelect from "./components/Helpers/MultiSelect";
import UpdateRolesModal from "./components/admin/modals/UpdateRolesModal";
import CreateUsersModal from "./components/admin/modals/CreateUserModal";
import UpdateUserModal from "./components/admin/modals/UpdateUserModal";


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


/**
 * Helper Components
 */
window.customElements.define('multi-select', MultiSelect);

//npm i -g webpack
//npm i -g webpack-cli
