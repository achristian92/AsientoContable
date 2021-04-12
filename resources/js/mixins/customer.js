let customerID = document.head.querySelector('meta[name="customerID"]');

module.exports = {
    computed: {
        currentCustomerID() {
            return JSON.parse(customerID.content);
        },
        baseUrl() {
            if (process.env.MIX_APP_ENV === 'production')
                return process.env.MIX_APP_URL
            else
                return '/'
        }
    }
}
