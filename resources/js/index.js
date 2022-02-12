// import _ from 'lodash';
import SideNavigationLink from "./components/admin/SideNavigationLink";
import SideNavigationEvents from "./components/admin/SideNavigationEvents";
import EventSubNavigation from "./components/admin/EventSubNavigation";
import EventOverviewPage from "./components/admin/EventOverviewPage";
//
window.customElements.define('side-navigation-link', SideNavigationLink);
window.customElements.define('side-navigation-events', SideNavigationEvents);
window.customElements.define('event-sub-navigation', EventSubNavigation);
window.customElements.define('event-overview-page', EventOverviewPage);

//npm i -g webpack
//npm i -g webpack-cli