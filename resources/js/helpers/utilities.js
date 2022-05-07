import moment from "moment";

export default {
    formatDate(date) {
        if (!date)
            return '';

        return moment(date).format('DD/MM/YYYY')
    },
    formatMoney(amount, currency = 0) {
        if (!currency) {
            currency = {
                precision: 2,
                thousand_separator: ',',
                decimal_separator: '.',
            }
        }

        let { precision, decimal_separator, thousand_separator } = currency

        try {
            precision = Math.abs(precision)
            precision = isNaN(precision) ? 2 : precision

            const negativeSign = amount < 0 ? '-' : ''

            let i = parseInt(
                (amount = Math.abs(Number(amount) || 0).toFixed(precision))
            ).toString()
            let j = i.length > 3 ? i.length % 3 : 0


            return (
                negativeSign +
                (j ? i.substr(0, j) + thousand_separator : '') +
                i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousand_separator) +
                (precision
                    ? decimal_separator +
                    Math.abs(amount - i)
                        .toFixed(precision)
                        .slice(2)
                    : '')
            )
        } catch (e) {
            console.log(e)
        }
    },
    formatRound(number, decimals) {
        let numberRegexp = new RegExp('\\d\\.(\\d){' + decimals + ',}');
        if (numberRegexp.test(number))
            return Number(number.toFixed(decimals));
        else
            return Number(number.toFixed(decimals)) === 0 ? 0 : number;
    },
    baseUrl() {
        if (process.env.MIX_APP_ENV === 'production')
            return process.env.MIX_APP_URL
        else
            return '/'
    },
}
