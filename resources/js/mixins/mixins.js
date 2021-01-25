module.exports = {
    computed: {
        baseUrl() {
            return window.location.origin
        },
    },
    filters: {
        toKebabCase(string) {
            if (string) {
                return string
                    .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                    .map(x => x.toLowerCase())
                    .join('-');
            }
        }
    },
    methods:{
        reload(timeToReload = 1500, path = null) {
            setTimeout(function() {
                return path !== null ? path : window.location.reload()
            }, timeToReload)
        },
        limitString(string, limit) {
            return string ? string.substring(0, limit) + '...' : ''
        },
        isNotEmpty(number) {
            return parseInt(number) !== null && parseInt(number) > 0
        },
        formatNumber(number) {
            return parseInt(number).toFixed().replace(/\d(?=(\d{3}))/g, '$&,')
        },
        isObject(value) {
            return value && typeof value === 'object' && value.constructor === Object;
        },
    },
};
