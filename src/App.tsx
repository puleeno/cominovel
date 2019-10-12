import { ConfigProvider } from "antd";
import React from "react";
import Cominovel from "./Cominovel";

const App: React.FC = () => {
  return (
    <ConfigProvider>
      <Cominovel />
    </ConfigProvider>
  );
};

export default App;
