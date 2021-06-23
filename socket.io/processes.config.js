module.exports = {
	apps: [{
		name: 'online-counsel',
		script: './index.js',
		instances: 2,
		exec_mode: 'cluster'
	}]
}
