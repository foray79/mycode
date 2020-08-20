import React from 'react';


class Detail extends React.Component{

	componentDidMount(){

		const {location,history} = this.props;
		if(location.state === undefined){
			history.push('/');
		}
	}

	render()
	{

		const {location } = this.props;
		console.log(location.state);
		
		if(location.state) {
			const {genres , poster, summary, title,year} = location.state;
			console.log(title);
			return(
				<>
				<span>{title}</span>
				<img src={poster} />
				</>
			);
		}else{
			return null;
		}
	}
}

export default Detail;