import { ConfigProvider } from "antd";
import { Locale } from 'antd/lib/locale-provider';
import React from "react";
import Cominovel from "./Cominovel";

interface CominovelWindowProps {
  languages: Locale,
}

declare global {
  interface Window {
    Cominovel: CominovelWindowProps,
  }
}

window.Cominovel = window.Cominovel || { languages: {}};

const App: React.FC = () => {
  return (
    <ConfigProvider locale={window.Cominovel.languages}>
      <Cominovel />
    </ConfigProvider>
  );
};

export default App;
