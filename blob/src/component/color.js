import React,{useState,Fragment} from 'react'
import {ChromePicker  } from 'react-color' ;
import './board.css';

const Color=({color,setColor}) =>{
    //const [color,setColor] = useState('#fff');
    const [pickerView,setPickerView] = useState(false);
    const handleChange=(color,event  )=>{ 
        setColor(color.hex );
    }
    const showPicker=()=>{//색상 변경 이벤트
        setPickerView(view => !view);
    }
    const colorPicker=(color)=>{
        setColor(color.hex );
        setPickerView(false);
    }

    return(
        <Fragment>
            {pickerView ? 
            <div className="cover">
            <ChromePicker  color={color} onChange ={handleChange} onChangeComplete={colorPicker} disableAlpha={true} />
            </div>      
            : <div style={{backgroundColor : color,borderColor: "#000" ,borderStyle:'solid',borderWidth:1,height:20,width:20,}} onClick={showPicker}/>}
            
        </Fragment>
    );
}
export default Color

