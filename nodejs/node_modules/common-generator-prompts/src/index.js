const parse = require('githuburl')
const git = require('simple-git/promise')().silent(true)

const NOOP = () => {}
const getGitUrl = () => git.listRemote(['--get-url'])
.then(url => url.trim())
.catch(NOOP)

module.exports = () => [
  {
    type: 'input',
    name: 'git',
    message: 'git repo',
    default: getGitUrl,
    filter (url) {
      const parsed = parse(url)

      // So that it will
      parsed.toString = () => parsed.ssh_clone_url
      return parsed
    }
  },
  {
    type: 'input',
    name: 'name',
    message: 'name',

    // By default, uses the
    default ({
      git: {
        repo
      }
    }) {
      return repo
    }
  },
  {
    type: 'input',
    name: 'description',
    message: 'description',
    default: 'This is an awesome project!'
  }
]
