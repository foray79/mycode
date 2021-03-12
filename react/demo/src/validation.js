import React,{Component} from 'react';
import './validation.css';

class Validation extends Component{
    state = {
        password :"",
        clicked : false,
        validated : false
    }
    handleChange = (e) =>{
        this.setState({
            password : e.target.value
        });
    }
    handlebuttonClick = () =>{
        this.setState({
            clicked:true,
            validated : this.state.password === '000'            
        });
        if(this.state.password !== '000'  ){
            this.input.focus();          
        }
    }
    
    render() {
        return(
            <div>
                <input type="passwoord" value={this.state.password?? ""} 
                onChange={this.handleChange}
                className={this.state.clicked ? (this.state.validated ? 'success':'failure'):''}
                ref={(ref)=>this.input=ref} />
                <button onClick={this.handlebuttonClick} >검증하기</button>
            </div>
        );
    }    
}

export default Validation;