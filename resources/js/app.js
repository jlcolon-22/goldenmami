require('./bootstrap');
import { createApp } from 'vue';
import { createPinia } from 'pinia';
const pinia = createPinia();
import Login from './component/auth/Login.vue'
import Register from './component/auth/Register.vue'
// ######################## EMPLOYEE #################################

import employeeDashboard from './component/employee/Dashboard.vue';
import employeeAttendance from './component/employee/Attendance.vue';
import employeeSetting from './component/employee/Setting.vue';


// ######################## ADMIN #################################


// Dashboard
import Dashboard from './component/admin/Dashboard.vue'
// Setting
import Setting from './component/admin/Setting.vue';
// menu admin
import menuCategory from './component/admin/menu/Category.vue'
import menuMenu from './component/admin/menu/Menu.vue'

// employee admin
import employeeEmployees from './component/admin/employee/Employees.vue';
import employeeAttendances from './component/admin/employee/Attendance.vue';
import employeeType from './component/admin/employee/Type.vue';

// inventory Admin
    // calasiao
    import inventoryCalasiao from './component/admin/inventory/calasiao/Calasiao.vue'
    // dagupan
    import inventoryDagupan from './component/admin/inventory/dagupan/Dagupan.vue';
    // lingayen
    import inventoryLingayen from './component/admin/inventory/lingayen/Lingayen.vue';
    // category
    import inventoryCategory from './component/admin/inventory/Category.vue';

// Customers
import customerCustomers from './component/admin/customer/Customer.vue';

// Event
import Event from './component/admin/event/Event.vue';

// reservation
import admin_reservation from './component/admin/reservation/Reserve.vue'

// ######################## CUSTOMER #################################
// Front end
import Menus from './component/pages/Menu.vue';
import Home from './component/pages/Home.vue';
import Reservation from './component/pages/Reservation.vue';
import Contact from './component/pages/Contact.vue';
import Cart from './component/asset/Cart.vue';
import My from './component/pages/My.vue';
import Reservation_list from './component/pages/Reservation_list.vue';


const app = createApp({});
app.component('Login',Login);
app.component('Register',Register);
app.component('menu-frontend',Menus);
app.component('home-frontend',Home);
app.component('reservation-frontend',Reservation);
app.component('contact-frontend',Contact);
app.component('cart-frontend',Cart);
app.component('my-frontend',My);
app.component('reservationlist-frontend',Reservation_list);

// admin only
app.component('Dashboard',Dashboard);
app.component('Setting',Setting);
app.component('menu-category',menuCategory);
app.component('menu-menu',menuMenu);
app.component('employee-employees',employeeEmployees);
app.component('employee-type',employeeType);
app.component('employee-admin-attendaance',employeeAttendances);
app.component('inventory-calasia',inventoryCalasiao);
app.component('inventory-dagupan',inventoryDagupan);
app.component('inventory-lingayen',inventoryLingayen);
app.component('inventory-category',inventoryCategory);
app.component('customer-customers',customerCustomers);
app.component('event-events',Event);
app.component('admin-reservation',admin_reservation);


app.component('employee-dashboard',employeeDashboard);
app.component('employee-attendance',employeeAttendance);
app.component('employee-setting',employeeSetting);

app.use(pinia)
app.mount('#app');
