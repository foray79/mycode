[![Build Status](https://travis-ci.org/kaelzhang/common-generator-prompts.svg?branch=master)](https://travis-ci.org/kaelzhang/common-generator-prompts)
[![Coverage](https://codecov.io/gh/kaelzhang/common-generator-prompts/branch/master/graph/badge.svg)](https://codecov.io/gh/kaelzhang/common-generator-prompts)
<!-- optional appveyor tst
[![Windows Build Status](https://ci.appveyor.com/api/projects/status/github/kaelzhang/common-generator-prompts?branch=master&svg=true)](https://ci.appveyor.com/project/kaelzhang/common-generator-prompts)
-->
<!-- optional npm version
[![NPM version](https://badge.fury.io/js/common-generator-prompts.svg)](http://badge.fury.io/js/common-generator-prompts)
-->
<!-- optional npm downloads
[![npm module downloads per month](http://img.shields.io/npm/dm/common-generator-prompts.svg)](https://www.npmjs.org/package/common-generator-prompts)
-->
<!-- optional dependency status
[![Dependency Status](https://david-dm.org/kaelzhang/common-generator-prompts.svg)](https://david-dm.org/kaelzhang/common-generator-prompts)
-->

# common-generator-prompts

Common yeoman generator prompts, actually [inquirer](https://www.npmjs.com/package/inquirer) prompts, to handle package informations

## Install

```sh
$ npm i common-generator-prompts
```

## Usage

```js
prompting () {
  const promps = require('common-generator-prompts')().concat([
    // your other prompts
  ])

  this.prompt(prompts).then(props => {
    // To access props later use this.props.someAnswer;
    this.props = props
  })
}
```

`common-generator-prompts` handles

## License

MIT
