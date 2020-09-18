<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">dashboard Component</div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                notifications: [],

            }
        },
        methods: {
            loadNotification() {
                axios.get('/notification').then(({data}) => (this.notifications = data.data));
            },
        },
        created() {
            setInterval(() => this.loadNotification(), 3000);
        },
    }
</script>
