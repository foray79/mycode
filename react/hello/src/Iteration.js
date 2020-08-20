import React,{Component}from 'react';
import {useState} from 'react';

class Iteration extends Component
{

	constructor(){
		super();
		console.log("start");

	const state = ([
			{id:1,text:'눈사람'},
			{id:2,text:'얼음'},
			{id:3,text:'눈'},
			{id:4,text:'바람'}
		]);
		console.log(state);
	}


	
	render()
	{
		/*
		const [name,setNames] = useState([
	{id:1,text:'눈사람'},
	{id:2,text:'얼음'},
	{id:3,text:'눈'},
	{id:4,text:'바람'},
	]);
*/
/*
const [inputText,setinputText] = useState('');
console.log(this.state);
const [nextId,setNextId] = useState(5);
*/
		
//	const nameList = names.map((name,index)=> <li key={index}> {name} </li>);
		return(
			<ul>nameList</ul>
			);
	}
}

export default Iteration;