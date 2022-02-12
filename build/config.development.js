const { merge } = require('webpack-merge')

module.exports = merge(require('./config.base.js'), {
    mode: 'development',
    watch: true,
    watchOptions: {
        aggregateTimeout: 300,
        poll: true
    },
    // All webpack configuration for development environment will go here
})