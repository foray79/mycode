import React from 'react';
import {Route,Link,Switch} from 'react-router-dom';
import About from './About';
import Home from './Home'
import Profiles from './profiles';
import History from './history';

const App =() =>{
  return (
    <div>
      <ul>
        <li>
          <Link to="/">홈</Link>
        </li>
        <li>
          <Link to="/about?detail=true">소개</Link>
        </li>
        <li>
          <Link to="/info">정보</Link>
        </li>
        <li>
          <Link to="/profiles">프로필</Link>
        </li>
        <li>
          <Link to="/history">history</Link>
        </li>
      </ul>
      <hr />
      <Switch>
      <Route path="/" component={Home} exact={true} />
      <Route path={["/about",'/info']} component={About} />
      <Route path="/profiles" component={Profiles} />
      <Route path="/history" component={History} />
      <Route render={({location})=>(
        <div>
          <h2>이페이지는 존재하지 않습니다.</h2>
          <p>{location.pathname}</p>
        </div>
      )} />
      </Switch>
    </div>    
  );
};

export default App;
