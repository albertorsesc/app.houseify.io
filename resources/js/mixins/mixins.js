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
            return string ? string.substring(0, limit) + '.' : ''
        },
        formatPhone(string) {
            let cleaned = ('' + string).replace(/\D/g, '');
            let match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);

            if (match) {
                return '(' + match[1] + ') ' + match[2] + '-' + match[3]
            };

            return string
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
