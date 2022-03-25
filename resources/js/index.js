// import _ from 'lodash';
import SideNavigationLink from "./admin/SideNavigationLink";
import SideNavigationEvents from "./admin/SideNavigationEvents";
import EventSubNavigation from "./admin/pages/EventSubNavigation";
import EventOverviewPage from "./admin/pages/EventOverviewPage";
import CreateProgramModal from "./admin/modals/CreateProgramModal";
import PaginatorComponent from "./admin/pages/PaginatorComponent";
import SubNavigation from "./admin/pages/SubNavigation";
import CreateLocationModal from "./admin/modals/CreateLocationModal";
import UpdateLocationModal from "./admin/modals/UpdateLocationModal";
import CreatePerformerModal from "./admin/modals/CreatePerformerModal";
import UpdatePerformerModal from "./admin/modals/UpdatePerformerModal";
import CreateRolesModal from "./admin/modals/CreateRolesModal";
import MultiSelect from "./admin/components/MultiSelect";
import UpdateRolesModal from "./admin/modals/UpdateRolesModal";
import CreateUsersModal from "./admin/modals/CreateUserModal";
import UpdateUserModal from "./admin/modals/UpdateUserModal";
import CreateEventModal from "./admin/modals/CreateEventModal";
import initAddEventBtn from "./admin/scripts/HandleSideNavigation";
import UpdateEventModal from "./admin/modals/UpdateEventModal";
import Navbar from "./admin/layout/Navbar";
import ProgramOverviewPage from "./admin/pages/ProgramOverviewPage";
import ProgramItemOverviewComponent from "./admin/components/ProgramItemOverviewComponent";
import CreateItemModal from "./admin/modals/CreateItemModal";
import UpdateItemModal from "./admin/modals/UpdateItemModal";
import UpdateProgramModal from "./admin/modals/UpdateProgramModal";
import BuyItemTicket from "./components/BuyItemTicket";
import BuyProgramTicket from "./components/BuyProgramTicket";

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
window.customElements.define('program-overview-page', ProgramOverviewPage)
window.customElements.define('program-item-overview-component', ProgramItemOverviewComponent)
window.customElements.define('create-item-modal', CreateItemModal)
window.customElements.define('update-item-modal', UpdateItemModal)
window.customElements.define('update-program-modal', UpdateProgramModal)
window.customElements.define('buy-item-ticket', BuyItemTicket)
window.customElements.define('buy-program-ticket', BuyProgramTicket)

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
