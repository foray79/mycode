import _ from 'lodash'

function component() {
     let element = document.createElement('div'); 

     element.innerHTML = _.join(['Hello', 'webpack'], ' '); 
     return element; 
} 


document.body.appendChild(component());
