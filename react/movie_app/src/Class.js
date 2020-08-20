import React from 'react';

class App extends React.Component
{
	constructor(props){
		super(props);
		console.log("construtor");
	}
	componentDidMount(){
		console.log("component rendered");
	}
	componentDidUpdate(){
		console.log("component updateed");
	}
	componentWillUnmount(){
		console.log("component unmount");
	}
	state = {
		age:10,
		count:0,
	};
	add = ()=>{
		console.log("add");
		this.setState(current=>({count:current.count+ 1}));
	};
	minus = ()=>{
			console.log("minus");
			this.setState(current=>({count:current.count -1}));
	};
	reset= ()=>{
		console.log("reset");
		this.setState({count :0});
	};
	render(){
		console.log("render");
		return (
			<div>
			<h1> the number is {this.state.count}</h1>
			<button onClick={this.add}>Add</button>
			<button onClick={this.minus}>Minus</button>
			<button onClick={this.reset}>Rest</button>
			</div>
		);
	}
}

export default App;
