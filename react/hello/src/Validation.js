import React,{Component} from 'react'
import './validation.css'

class Validation extends Component
{
	
	state ={
		password:'',
		clicked:false,
		validated: false,
		texts:''
	}

	handleChange=(e)=>{
		this.setState({
			password:e.target.value			
		});
	}
	handleButtonClick=()=>{
		this.setState({
			clicked:true,
			validated:this.state.password === '000',
			texts : this.state.password ==='000' ? "성공": "실패"
		});
		this.input.focus();

	}
		render(){
			return (
			<div>
				
				<input type="password"
					values={this.state.password}
					onChange={this.handleChange}
					className={this.state.clicked? (this.state.validated ? 'success':'faliure') : ''}
					ref={(ref)=>this.input=ref}
				/>
				<button onClick={this.handleButtonClick}>검증하기</button>
					<span
					 className={this.state.clicked? (this.state.validated ? 'success':'faliure') : ''}>{this.state.texts}  </span>
			
			</div>
				
			);
		}
}


export default Validation