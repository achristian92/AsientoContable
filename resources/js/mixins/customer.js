let customerID = document.head.querySelector('meta[name="customerID"]');

module.exports = {
    computed: {
        currentCustomerID() {
            return JSON.parse(customerID.content);
        },

    }
}
