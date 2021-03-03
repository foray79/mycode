var winston = require('winston');


const logger = winston.createLogger({
  level: 'info',
  format: winston.format.json(),
  defaultMeta: { service: 'user-service' },
  transports: [
    //
    // - Write all logs with level `error` and below to `error.log`
    // - Write all logs with level `info` and below to `combined.log`
    //
    new winston.transports.File({ 
        filename: 'error.log', 
        level: 'error' ,
        format : winston.format.combine(
            winston.format.colorize(),
            winston.format.simple()
            
        )
                                }),
//    new winston.transports.File({ filename: 'combined.log' }),
  ],
});

logger.add(new winston.transports.Console({
    format: winston.format.simple(),
  }));

logger.error("test1");