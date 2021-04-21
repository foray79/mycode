module.exports={
  "apps" : [{
    "name"        : "lotto",
    "script"      : "./bin/www",
    "watch"       : true,
    "instances"  : 0,
    "exec_mode"  : "cluster",
    "env": {
      "NODE_ENV": "development",
      "PORT" : 3000
    },
    "env_production" : {
       "NODE_ENV": "production"
    }
  }]
}
