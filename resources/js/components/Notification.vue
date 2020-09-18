<template>
    <div style="margin-left:800px;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-2x" aria-hidden="true"></i>
                    <span class="badge badge-warning navbar-badge">{{notifications.length}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <tbody>
                        <tr v-for="notification in notifications" :key="notification.data">
                            <td>{{JSON.parse(notification.data).message}}</td>
                        </tr>
                        </tbody>
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                notifications: {},
            }
        },
        methods: {
            loadNotification() {
                axios.get('/notification').then(({data}) => (this.notifications = data.data));
            },
        },
        created() {

                 setInterval(()=>this.loadNotification(), 3000);
        },
    }
</script>

