import React from 'react';
import Cominovel from './Cominovel';
import { ConfigProvider } from 'antd';


const App: React.FC = () => {
  return (
    <ConfigProvider>
      <Cominovel />
    </ConfigProvider>
  );
}

export default App;
