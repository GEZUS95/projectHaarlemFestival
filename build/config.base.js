const path = require('path')
const { SRC, DIST } = require('./paths')

module.exports = {
    entry: [
        path.resolve(SRC, '', 'js/index.js'),
        path.resolve(SRC, '', 'scss/main.scss'),
    ],
    module: {
        rules: [
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'file-loader',
                        options: { outputPath: '', name: 'main.css'}
                    },
                    'sass-loader'
                ]
            }
        ]
    },
    output: {
        path: DIST,
    }
}