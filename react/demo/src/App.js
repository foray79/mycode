import React from 'react';
import './App.css' ;
import Validation from './validation';
import Scroll from './scroll';
import Hooks from './hooks/Hooks';
import Style from './style/style'
const Counter = () =>{
  const [value,setValue] = React.useState(0);
  console.log(value);
  return(
      <div>
          <p>현재 카운터 는<b>{value}</b>입니다.</p>
          <button onClick={() => setValue(value+1)}>+1</button>
          <button onClick={() => setValue(value-1)}>-1</button>
      </div>
  );
}

class App extends React.Component{
  
     render() {   
        
         return (    
           <>  
              <Counter />

               <Validation /> 
               <div className='hook_style'>
                 <Hooks />

                 <Style />
               </div>
               <div>                 
               <Scroll ref={(ref)=>this.scroll=ref}/>            
               <button onClick={()=>this.scroll.scrollTopBottom()}>맨밑으로</button>
               </div>
          </>               
         );
     }
    
  
}

export default App;
