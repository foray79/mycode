import React,{Component} from 'react'

class Scrollbox extends Component
{
	scrollToBottom=()=>{
		console.log("scrolltobottom");		
		const {scrollHeight,clientHeight} = this.box;

			console.log("scrollHeight :"+ scrollHeight);
			console.log("clientHeight : "+clientHeight);
		this.box.scrollTop = scrollHeight - clientHeight;
	}
	render(){
		const style={
			border:'1px solid balck',
			height:'300px',
			width:'300px',
			overflow:'auto',
			position:'relative'
		};

		const innerStyle={
			width:'100%',
			height:'650pc',
			background:'linear-gradient(white,black)'
		}

		return(
			<div style={style} ref={(ref)=>{this.box = ref}} >
				<div style={innerStyle} />
			</div>
			);
	}
}
export default Scrollbox