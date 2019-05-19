const path           = require( 'path' );
var LiveReloadPlugin = require( 'webpack-livereload-plugin' );

const config = {
	entry: {
		frontend: './src/frontend/front-index.js',
		admin: './src/backend/back-index.js'
	},
	output: {
		filename: 'js/[name].js',
		path: path.resolve( __dirname, 'public' )
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader'
		}
		]
	},
	plugins: [
		new LiveReloadPlugin( {} )
	]
};

// Export the config object
module.exports = config;
