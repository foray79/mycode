import './App.css';
/* import Board from './board';
import Live from './live'; */
import Test from './test';
import UrlViewer from './urlviewer';
function App() {
  const url= 'http://devfront.simsale.kr/v2/web/gnb_web.php?menu_id=GNB0008&dv_type=3';
  
  return (    
    <UrlViewer url={url}/>
  );
}

export default App;
 