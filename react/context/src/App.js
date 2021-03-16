import React from 'react';
import ColorBox from './components/colorBox';
import {ColorProvider} from './context/color';
import CSelectColors from './components/CselecctColors';
const App = () => {
  return (
    <ColorProvider>
    <div>
      <CSelectColors />
      <ColorBox />
    </div>
    </ColorProvider>
  );
}

export default App;
