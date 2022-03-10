new Vue({
    el: '#app',
    methods: {
        login() {
            location.href = '/dashboard';
        },

        //Ticket Events
        newTicket() {
            location.href = '/newticket';
        },

        ticketDetails(id) {
            location.href = '/ticket/' + id;
        },

        //User Events
        newUser() {
            location.href = '/newuser';
        },

        //Article Events
        newArticle() {
            location.href = '/newarticle';
        },

        //Category Events
        newCategory() {
            location.href = '/newcategory';
        },

        //Departement Events
        newDepartement() {
            location.href = '/newdepartement';
        },
    }
});