let path = require('path')
let Uglify = require('uglifyjs-webpack-plugin')
let ExtractCss = require('extract-text-webpack-plugin')
let FolderCleaning = require('clean-webpack-plugin')
let ManifestPlugin = require('webpack-manifest-plugin')
let dev = process.env.NODE_ENV === 'dev'

let BrowserSyncPlugin = require('browser-sync-webpack-plugin')
let proxyUrl = 'http://wp35.local'

let config = {
    entry: [
        path.join(__dirname, './public/assets/scss/main.scss'),
        path.join(__dirname, './public/assets/scripts/main.js')
    ],
    output: {
        path: path.resolve('./public/dist'),
        filename: './[name].[hash:8].js'
    },
    watch: dev,
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: ['babel-loader']
            },
            {
                test: /\.css$/,
                use: ExtractCss.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1,
                                minimize: !dev,
                                sourceMap: dev
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: dev,
                                plugins: (loader) => [
                                    require('autoprefixer')({
                                        browsers: ['last 3 versions', 'safari >= 7', 'ie >= 7']
                                    })
                                ]
                            }
                        }
                    ]
                })
            },
            {
                test: /\.scss/,
                use: ExtractCss.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 2,
                                minimize: !dev,
                                sourceMap: dev
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: dev,
                                plugins: (loader) => [
                                    require('autoprefixer')({
                                        browsers: ['last 3 versions', 'ie >= 9']
                                    })
                                ]
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: dev
                            }
                        }
                    ]
                })
            },
            {
                test: /\.(woff2$|ebt|ttf|otf|eot|woff)(\?.*)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '/fonts/[name].[hash:8].[ext]'
                        }
                    }
                ]
            },
            {
                test: /\.(png|jpe?g|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '/images/[name].[ext]'
                        }
                    },
                    {
                        loader: 'img-loader',
                        options: {
                            enabled: !dev
                        }
                    }]
            },
            {
                test: /\.svg/,
                use: {
                    loader: 'svg-url-loader',
                    options: {}
                }
            }]
    },
    devtool: dev ? 'cheap-module-source-map' : false,
    plugins: [
        new ExtractCss({
            filename: './[name].[hash:8].css'
        }),
        new FolderCleaning(['dist'], {
            root: path.resolve('./public'),
            verbose: true,
            dry: false
        }),
        new ManifestPlugin()
    ]
}

if (!dev) {
    config.plugins.push(
        new Uglify({
            sourceMap: true
        })
    )
} else {
    config.plugins.push(
    )
}

module.exports = config
