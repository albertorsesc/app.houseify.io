module.exports = {
    methods: {
        // Property Features
        isPropertyFeatureNotEmpty(propertyFeature) {
            if (propertyFeature.hasOwnProperty('features') && Object.keys(propertyFeature.features).length > 0) {
                return this.isNotEmpty(propertyFeature.features.property_size) ||
                    this.isNotEmpty(propertyFeature.features.construction_size) ||
                    this.isNotEmpty(propertyFeature.features.level_count) ||
                    this.isNotEmpty(propertyFeature.features.room_count) ||
                    this.isNotEmpty(propertyFeature.features.bathroom_count) ||
                    this.isNotEmpty(propertyFeature.features.half_bathroom_count)
            }
            return false
        },
    },
}
