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
//
window.customElements.define('side-navigation-link', SideNavigationLink);
window.customElements.define('side-navigation-events', SideNavigationEvents);
window.customElements.define('event-sub-navigation', EventSubNavigation);
window.customElements.define('event-overview-page', EventOverviewPage);
window.customElements.define('create-program-modal', CreateProgramModal);
window.customElements.define('paginator-component', PaginatorComponent);
window.customElements.define('admin-sub-navigation', SubNavigation);
window.customElements.define('create-location-modal', CreateLocationModal);
window.customElements.define('update-location-modal', UpdateLocationModal);

//npm i -g webpack
//npm i -g webpack-cli
