import React,{Component} from 'react'
import PropTypes from 'prop-types';


class Test1 extends Component {
state={
	number:0,
	fixnumber:10

};
render(){
	const {number,fixnumber} = this.state;
	return (
   <div>
      <h1>{number}</h1>
      <h2>바뀌지 않는값 : {fixnumber}</h2>
	  <button onClick={()=>{
		this.setState(prevState=>{
			return {
				number:prevState.number+1
			};
				console.log(prevState);
				
			});
	  }}>+1</button>

	  <button onClick={()=>{
		this.setState({number:0});
	  }}>reset</button>

	  <button onClick={()=>{
	
		this.setState(prevState=>({			
			number:prevState.number-1
		}));
	  },()=>{
		  console.log('방금 setState가 호출 되었습니다');
		 console.log(this.state);
	  }
	  }>-1</button>

    </div>
  );
}

}

export default Test1