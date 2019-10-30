import React from "react";
import { IntlProvider } from "react-intl";
import Cominovel from "./Cominovel";

interface CominovelWindowProps {
}

declare global {
  interface Window {
    Cominovel: CominovelWindowProps;
  }
}

const App: React.FC = () => {
  return (
    <IntlProvider locale="en">
      <Cominovel />
    </IntlProvider>
  );
};

export default App;
